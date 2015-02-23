<?php

class Customer_Ticket_model extends Model{
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function addTicketEntry(){

        $ttl = $_POST['ttl'];
        $desc = $_POST['desc'];
        $catg = $_POST['catg'];
        $sb_catg = $_POST['sb_catg'];
        $asgni = $_POST['asgni'];
        $time = time();
        $id = md5($time . rand(21, 221) . '#$sr');
        
        $addTicket = $this -> db -> query("INSERT INTO viv_cust_servs_en VALUES(".$this -> db -> quote($id).",".
                                                                                    $this -> db -> quote($_SESSION['loggedIn']).",".
                                                                                    $this -> db -> quote($ttl).",".
                                                                                    $this -> db -> quote($desc).",".
                                                                                    $this -> db -> quote($catg).",".
                                                                                    $this -> db -> quote($sb_catg).",".
                                                                                    $this -> db -> quote($asgni).",".
                                                                                    $this -> db -> quote(time()).",".
                                                                                    $this -> db -> quote(1).",".
                                                                                    $this -> db -> quote(time()).",".
                                                                                    $this -> db -> quote($_SESSION['loggedIn']).")");
        
        if($addTicket == true){
            $sts = "Ticket added successfully!!";
        }
        return $sts;
    }
    
    
    public function getAssinegees(){
        
        if ($_POST['asgns'] == 'mngr') {
            $getmngrs = $this->db->query("SELECT _emp_name, _emp_email FROM viv_emp_en WHERE _emp_level = 2");
            $res = $getmngrs->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } else if ($_POST['asgns'] == 'emps') {
            $getmngrs = $this->db->query("SELECT _emp_name, _emp_email FROM viv_emp_en");
            $res = $getmngrs->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
    }
    
}
