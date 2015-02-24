<?php
class Tickets_model extends Model{
    
    function __construct() {
        parent::__construct();
    }
    
    // @get all tickets by manager
    public function getTickets(){
        $get_all_tickets = $this->db->query("SELECT * FROM viv_cust_servs_en, viv_emp_en WHERE viv_cust_servs_en._cust_servs_tckt_holder = viv_emp_en._emp_email ORDER BY _cust_servs_tckt_addedon DESC");
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
        $tck_id = $_POST['tckt_id'];
        
        
        // @UPDATE ASSIGNEE
        if($_POST['tp'] === 'asgn'){
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
            $addVote = $this -> db -> query("INSERT INTO viv_cust_servs_cmnts_en (_servs_cmnts_tckt_id,"
                                                                               . "_servs_cmnts_tckt_ownr,"
                                                                                . "_servs_cmnts_tckt_cmnt,"
                                                                                . "_servs_cmnts_tckt_cmntby,"
                                                                                . "_servs_cmnts_tckt_cmnton,"
                                                                                . "_servs_cmnts_modifidby,"
                                                                                . "_servs_cmnts_modifidon) VALUES (".$this -> db -> quote($tck_id).",".
                                                                                                                        $this -> db -> quote($tckt_ownr).",".
                                                                                                                        $this -> db -> quote($cmnt).",".
                                                                                                                        $this -> db -> quote($_SESSION['loggedIn']).",".
                                                                                                                        $this -> db -> quote(time()).",".
                                                                                                                        $this -> db -> quote($_SESSION['loggedIn']).",".
                                                                                                                        $this -> db -> quote(time()).")");
            if($addVote == true){
                
            }
        }
        
        // @close ticket
        else if($_POST['tp'] === 'clse'){
        $clse_tckt = $this -> db -> query("UPDATE viv_cust_servs_en SET _cust_servs_tckt_sts = 0 WHERE _Id_ = ".$this -> db -> quote($tck_id)); 
        if($clse_tckt == TRUE){
            $sts = "Ticket closed successfully!!";
        }else{
            $sts = "Somthing wrong while closing Ticket";
        }
        return $sts;
        }
        
        // @reopen ticket
        else if ($_POST['tp'] === 'ropn') {
            $reopen_tckt = $this->db->query("UPDATE viv_cust_servs_en SET _cust_servs_tckt_sts = 1 WHERE _Id_ = " . $this->db->quote($tck_id));
            if ($reopen_tckt == TRUE) {
                $sts = "Ticket reopen successfully!!";
            } else {
                $sts = "Somthing wrong while reopening Ticket";
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
    
}