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
        
        $result = array_merge($res1, $res2);

        return $result;
    }
    
    public function updtTicket(){
        
        if($_POST['tp'] === 'asgn'){
            $asgn2 = $_POST['asgn2'];
            $asgn1 = $_POST['asgn1'];
            $tck_id = $_POST['tckt_id'];
            $tckt_ownr = $_POST['ownr'];
            $updtAsgnee = $this -> db -> query("UPDATE viv_cust_servs_en SET _cust_servs_tckt_asigni = ". $this -> db -> quote($asgn2));
            if($updtAsgnee == true){
            $addHstry = $this -> db -> query("INSERT INTO viv_cust_servs_hstry_en (_servs_hstry_tckt_id, "
                                                                                . "_servs_hstry_tckt_ownr, "
                                                                                . "_servs_hstry_tckt_asgn1, "
                                                                                . "_servs_hstry_tckt_asgn2, "
                                                                                . "_servs_hstry_tckt_sts, "
                                                                                . "_servs_hstry_modifiedon, "
                                                                                . "_servs_hstry_modifiedby) VALUES (".$this -> db -> quote($tck_id).",".
                                                                                                                        $this -> db -> quote($tckt_ownr).",".
                                                                                                                        $this -> db -> quote($asgn1).",".
                                                                                                                        $this -> db -> quote($asgn2).",".
                                                                                                                        $this -> db -> quote(1).",".
                                                                                                                        $this -> db -> quote(time()).",".
                                                                                                                        $this -> db -> quote($_SESSION['loggedIn']).")");
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
    }
    
}