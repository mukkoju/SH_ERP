<?php
class Tickets_model extends Model{
    
    function __construct() {
        parent::__construct();
    }
    
    // @get all tickets by manager
    public function getTickets(){
        if(isset($_POST['pc'])){
            $pc = $_POST['pc']; 
        }else{
            $pc = 0; 
        }
        $get_all_tickets = $this->db->query("SELECT * FROM viv_cust_servs_en, viv_emp_en WHERE viv_cust_servs_en._cust_servs_tckt_holder = viv_emp_en._emp_email AND viv_cust_servs_en._cust_servs_tckt_sts = 1 ORDER BY _cust_servs_tckt_addedon DESC LIMIT $pc,15");
        $res = $get_all_tickets -> fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    // @selected ticket view
    public function viewTicket($tckt_id){
        
        $selct_tckt = $this -> db -> query("SELECT * FROM viv_cust_servs_en, viv_emp_en WHERE viv_cust_servs_en._Id_ = ". $this -> db -> quote($tckt_id)." AND viv_cust_servs_en._cust_servs_tckt_holder = viv_emp_en._emp_email");
        $res1 = $selct_tckt -> fetchAll(PDO::FETCH_ASSOC);
        
        $get_asgnNme = $this -> db -> query("SELECT _emp_name FROM viv_emp_en WHERE _emp_email =" . $this -> db -> quote($res1[0]['_cust_servs_tckt_asigni']));
        $res2 = $get_asgnNme -> fetchAll(PDO::FETCH_ASSOC);
        
        $get_tckt_cmnts = $this -> db -> query("SELECT viv_cust_servs_cmnts_en._servs_cmnts_tckt_cmnt,"
                                                    . " viv_cust_servs_cmnts_en._id_,"
                                                    . " viv_cust_servs_cmnts_en._servs_cmnts_tckt_cmntby,"
                                                    . " viv_cust_servs_cmnts_en._servs_cmnts_tckt_cmnton,"
                                                    . " viv_emp_en._emp_name FROM viv_cust_servs_cmnts_en"
                                                    . " JOIN viv_emp_en ON viv_emp_en._emp_email = viv_cust_servs_cmnts_en._servs_cmnts_tckt_cmntby"
                                                    . " WHERE viv_cust_servs_cmnts_en._servs_cmnts_tckt_id = ". $this -> db -> quote($tckt_id));
  
   $res3 = $get_tckt_cmnts -> fetchAll(PDO::FETCH_ASSOC);        
//        var_dump(array($res1,$res2,$res3));
        return array($res1,$res2,$res3);
    }
    
    public function updtTicket(){
        
        
        
        // @UPDATE ASSIGNEE
        if($_POST['tp'] === 'asgn'){
            $tck_id = $_POST['tckt_id'];
            $tckt_ownr = $_POST['ownr'];
            $asgn2 = $_POST['asgn2'];
            $asgn1 = $_POST['asgn1'];
            $updtAsgnee = $this -> db -> query("UPDATE viv_cust_servs_en SET _cust_servs_tckt_asigni = ". $this -> db -> quote($asgn2));
            if($updtAsgnee == true){
            $addHstry = $this -> db -> query("INSERT INTO viv_cust_servs_hstry_en (_servs_hstry_tckt_id, "
                                                                                . "_servs_hstry_tckt_ownr, "
                                                                                . "_servs_hstry_tckt_asgn1, "
                                                                                . "_servs_hstry_tckt_asgn2, "
                                                                                . "_servs_hstry_tckt_sts, "
                                                                                . "_servs_hstry_modifiedon, "
                                                                                . "_servs_hstry_modifiedby,"
                                                                                . "_servs_ntfcn_sts) VALUES (".$this -> db -> quote($tck_id).",".
                                                                                                                        $this -> db -> quote($tckt_ownr).",".
                                                                                                                        $this -> db -> quote($asgn1).",".
                                                                                                                        $this -> db -> quote($asgn2).",".
                                                                                                                        $this -> db -> quote(1).",".
                                                                                                                        $this -> db -> quote(time()).",".
                                                                                                                        $this -> db -> quote($_SESSION['loggedIn']).",".
                                                                                                                        $this -> db -> quote('unread').")");
            if ($addHstry == true) {
                    $sts = 'Ticket Reassigned succesfully!!';
                }else {
                    $sts = 'Somthing wrong please try agin please';
                }
            } else {
                $sts = 'Somthing wrong please try agin please';
            }
            return $sts;
        }
        
        // @ADD COMMENT
        else if($_POST['tp'] === 'cmnt'){
            $cmnt = $_POST['cmnt'];
            $tckt_ownr = $_POST['ownr'];
            $tck_id = $_POST['tckt_id'];
            $time = time();
            $id = md5($time . rand(21, 221) . '#$sr');
            $addCmnt = $this -> db -> query("INSERT INTO viv_cust_servs_cmnts_en (_id_, _servs_cmnts_tckt_id,"
                                                                               . "_servs_cmnts_tckt_ownr,"
                                                                                . "_servs_cmnts_tckt_cmnt,"
                                                                                . "_servs_cmnts_tckt_cmntby,"
                                                                                . "_servs_cmnts_tckt_cmnton,"
                                                                                . "_servs_cmnts_modifidby,"
                                                                                . "_servs_cmnts_modifidon) VALUES (".$this -> db -> quote($id).",".
                                                                                                                        $this -> db -> quote($tck_id).",".
                                                                                                                        $this -> db -> quote($tckt_ownr).",".
                                                                                                                        $this -> db -> quote($cmnt).",".
                                                                                                                        $this -> db -> quote($_SESSION['loggedIn']).",".
                                                                                                                        $this -> db -> quote(time()).",".
                                                                                                                        $this -> db -> quote($_SESSION['loggedIn']).",".
                                                                                                                        $this -> db -> quote(time()).")");
            if($addCmnt == true){
                $sts = array('sts' => 0, 'id' => $id, 'addedon' => time());
            }else{
                $sts = -0;
            }
            return $sts;
        }
        
        // @close ticket
        else if($_POST['tp'] === 'clse'){
        $tck_id = $_POST['tckt_id'];
        $clse_tckt = $this -> db -> query("UPDATE viv_cust_servs_en SET _cust_servs_tckt_sts = 0 WHERE _Id_ = ".$this -> db -> quote($tck_id)); 
        
        if($clse_tckt == TRUE){
            // if ticket closed returing 0
            $sts = 0;
        }else{
            // suspended
            $sts = -0;
        }
        return $sts;
        }
        
        // @reopen ticket
        else if ($_POST['tp'] === 'ropn') {
            $tck_id = $_POST['tckt_id'];
            $reopen_tckt = $this->db->query("UPDATE viv_cust_servs_en SET _cust_servs_tckt_sts = 1 WHERE _Id_ = " . $this->db->quote($tck_id));
            if ($reopen_tckt == TRUE) {
                // if opend ticket returing 1
                $sts = 1;
            } else {
                // suspended
                $sts = -0;
            }
            return $sts;
        }
        
        // @ update ticket title
        else if($_POST['tp'] === 'ttlupdt'){
            $tck_id = $_POST['tckt_id'];
            $nw_ttl = $_POST['ttl'];
            $ttlUpdt = $this -> db -> query("UPDATE viv_cust_servs_en SET _cust_servs_tckt_ttl = ". $this->db->quote($nw_ttl)." WHERE _Id_ = ". $this->db->quote($tck_id));
            if($ttlUpdt == true){
                $sts = 0;
            }else{
                $sts = -0;
            }
            return $sts;
        }
        
        // @ update ticket comment
        else if($_POST['tp'] === 'cmntupdt') {
            $nw_cmnt = $_POST['cmnt'];
            $cmnt_id = $_POST['cmntid'];
            $cmntUpdt = $this -> db -> query("UPDATE viv_cust_servs_cmnts_en SET _servs_cmnts_tckt_cmnt = ". $this->db->quote($nw_cmnt)." WHERE _id_ = ". $this->db->quote($cmnt_id));
            
            if($cmntUpdt == true){
                $sts = 0;
            }else{
                $sts = -0;
            }
            return $sts;
            
        }
    }
    
    
    public function asgndTckts(){
        $asgndByYou = $this -> db -> query("SELECT * FROM viv_cust_servs_hstry_en WHERE _servs_hstry_tckt_asgn2 = ".$this -> db -> quote($_SESSION['loggedIn'])." AND _servs_ntfcn_sts = 'unread'");
        $res = $asgndByYou -> fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    
    public function Notfcn(){
        $eml = $_SESSION['loggedIn'];
        $readNtfcn = $this -> db -> query("UPDATE viv_cust_servs_hstry_en SET _servs_ntfcn_sts = 'read' WHERE _servs_hstry_tckt_asgn2 = ".$this -> db ->quote($eml)." AND _servs_ntfcn_sts = 'unread'");
        if($readNtfcn == true){
            $sts = 0;
            return $sts;
        }
        
    }
    
    // @filtring tickets
    public function tcktFltrng(){
        
        
        // filter by assignee
        if($_POST['tp'] == 'asgne'){
            $slctd = $_POST['slctd'];
            $asgne = $this -> db -> query("SELECT viv_cust_servs_en.*, viv_emp_en._emp_name FROM viv_cust_servs_en, viv_emp_en WHERE _cust_servs_tckt_asigni  = ". $this -> db -> quote($slctd)." AND viv_cust_servs_en._cust_servs_tckt_holder = viv_emp_en._emp_email ORDER BY _cust_servs_tckt_addedon DESC");
            $res = $asgne -> fetchAll(PDO::FETCH_ASSOC);
            if ($asgne == true) {
                return $res;
            } else {
                return 0;
            }
        }
        
        // filter by category
        elseif ($_POST['tp'] == 'ctgry') {
            $slctd = $_POST['slctd'];
        $ctgry = $this -> db -> query("SELECT viv_cust_servs_en.*, viv_emp_en._emp_name FROM viv_cust_servs_en, viv_emp_en WHERE _cust_servs_tckt_catg  = ". $this -> db -> quote($slctd)." AND viv_cust_servs_en._cust_servs_tckt_holder = viv_emp_en._emp_email ORDER BY _cust_servs_tckt_addedon DESC");
            $res = $ctgry -> fetchAll(PDO::FETCH_ASSOC);
            if ($ctgry == true) {
                return $res;
            } else {
                return 0;
            }
        }
        
        // filter by sort
        elseif ($_POST['tp'] == 'sort') {
            $slctd = $_POST['slctd'];
            if ($slctd == 'Newest') {
                // seraching last weak tickets
                $week = strtotime("-1 week");
                $newest = $this->db->query("SELECT viv_cust_servs_en.*, viv_emp_en._emp_name FROM viv_cust_servs_en, viv_emp_en WHERE _cust_servs_tckt_addedon  >= " . $this->db->quote($week)." AND viv_cust_servs_en._cust_servs_tckt_holder = viv_emp_en._emp_email ORDER BY _cust_servs_tckt_addedon DESC");
                $res = $newest->fetchAll(PDO::FETCH_ASSOC);
                if ($newest == true) {
                    return $res;
                } else {
                    return 0;
                }
            }
            else if ($slctd == 'Oldest') {
                // seraching last weak tickets
                $week = strtotime("-1 week");
                $newest = $this->db->query("SELECT viv_cust_servs_en.*, viv_emp_en._emp_name FROM viv_cust_servs_en, viv_emp_en WHERE viv_cust_servs_en._cust_servs_tckt_addedon  <= " . $this->db->quote($week)." AND viv_cust_servs_en._cust_servs_tckt_holder = viv_emp_en._emp_email ORDER BY _cust_servs_tckt_addedon DESC");
                $res = $newest->fetchAll(PDO::FETCH_ASSOC);
                if ($newest == true) {
                    return $res;
                } else {
                    return 0;
                }
            }
        }
         // @ getting graph data
            else if ($_POST['tp'] == 'anlytcs') {
//                // @ this week data
//                $thiWeek = strtotime("-1 week");
//                $thisWeek = $this -> db -> query("SELECT COUNT( * ) ,  _cust_servs_tckt_sts FROM  viv_cust_servs_en WHERE _cust_servs_tckt_addedon > $thiWeek GROUP BY _cust_servs_tckt_sts");
//                $res = $thisWeek -> fetchAll(PDO::FETCH_ASSOC);
                
                // @ last week data
                $lstWeek = strtotime("-1 week");
                $lastWeek = $this -> db -> query("SELECT COUNT( * ) ,  _cust_servs_tckt_sts FROM  viv_cust_servs_en WHERE _cust_servs_tckt_addedon > $lstWeek GROUP BY _cust_servs_tckt_sts");
                $res1 = $lastWeek -> fetchAll(PDO::FETCH_ASSOC);
//                return $res1; 
                
                // @ last month data
                $lstMonth = strtotime("-1 month");
                $lastMonth = $this -> db -> query("SELECT COUNT( * ) ,  _cust_servs_tckt_sts FROM  viv_cust_servs_en WHERE _cust_servs_tckt_addedon > $lstMonth GROUP BY _cust_servs_tckt_sts");
                $res2 = $lastMonth -> fetchAll(PDO::FETCH_ASSOC);
//                return $res2;
                
                // @ last year data
                $lstYear = strtotime("-1 year");
                $lastYear = $this -> db -> query("SELECT COUNT( * ) ,  _cust_servs_tckt_sts FROM  viv_cust_servs_en WHERE _cust_servs_tckt_addedon > $lstYear GROUP BY _cust_servs_tckt_sts");
                $res3 = $lastYear -> fetchAll(PDO::FETCH_ASSOC);
                $res3;
                
//                var_dump(array('lastweek' => $res1, 'lastmonth' => $res2, 'lastyear' => $res2));
                
                
                return array('lastweek' => ['pending' => $res1[1]['COUNT( * )'], 'closed' => $res1[0]['COUNT( * )'], 'total' =>$res1[0]['COUNT( * )']+$res1[1]['COUNT( * )'] ],
                             'lastmonth' => ['pending' => $res2[1]['COUNT( * )'], 'closed' => $res2[0]['COUNT( * )'], 'total' =>$res2[0]['COUNT( * )']+$res2[1]['COUNT( * )']],
                             'lastyear' => ['pending' => $res3[1]['COUNT( * )'], 'closed' => $res3[0]['COUNT( * )'], 'total' =>$res3[0]['COUNT( * )']+$res3[1]['COUNT( * )']]);
                
            }
            
            
        }

    
}