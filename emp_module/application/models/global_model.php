<?php

class Global_model extends Model {

    function __construct() {
        parent::__construct();
        
    }

    public function getUserDetails($em) {
        $sth = $this->db->prepare("SELECT * FROM viv_emp_en WHERE _emp_email = :email");
        $sth->execute(array(
            ':email' => $em));
           $row = $sth->rowCount();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $res;   
    }
    
    public function getEmpPerDetails($em){
//        echo $em;
        $emp_per = $this->db->prepare("SELECT * FROM viv_emp_per_en WHERE _emp_per_email =".$this-> db -> quote($em));
        $emp_per->execute();
        $res = $emp_per->fetchAll(PDO::FETCH_ASSOC);
        return $res; 
    }
    
    public function getAllUserDetails() {
        $sth10 = $this->db->prepare("SELECT * FROM new_emp");
        $sth10->execute();
           $row = $sth10->rowCount();
        $res = $sth10->fetchAll(PDO::FETCH_ASSOC) ;   
        return $res;   
    }
    
    public function getPaySlips($em){
        $sth = $this->db->query("SELECT * FROM viv_emp_payslip_en WHERE _emp_payslip_email =".$this -> db -> quote($em)." ORDER BY _id_ DESC");
        $row = $sth->rowCount();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $res;   
    }
    
     public function getUserLeaves($em){
        $getUserLeaves = $this->db->query("SELECT * FROM viv_emp_leaves_en WHERE _emp_leaves_email =".$this->db->quote($em)." ORDER BY _emp_leaves_applyedon DESC");
        $result = $getUserLeaves->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get_hldys(){
//        $itm = $this->db->prepare("SELECT * FROM  new_emp");
//        $itm->execute();
//        $tm = $itm->fetchAll(PDO::FETCH_ASSOC);
//        $full_data = [];
//        var_dump(sizeof($tm));
//        foreach ($tm as $row){
//        $email = $row['emp_email'];
//        $item2 = $this->db->prepare("SELECT _email_, _statement_, _time_, _status_ FROM _user_statements_ WHERE _email_ = :email and _status_ = 1");
//        $item2->execute(array(':email'=>$email));
//        $data = $item2->fetchAll(PDO::FETCH_ASSOC);
////        var_dump($data);
//        if(empty($data[0])){
//            array_push($full_data, $row);
//        }else{
//         $d = array_merge($row, $data[0]);
//         array_push($full_data, $d);
//        }
//      
//        }
////        var_dump($full_data);
//        //var_dump($full_data[0]);
        
            $get_hldys = $this->db->prepare("SELECT * FROM viv_holidays_en");
            $get_hldys->execute();
            $deatils = $get_hldys->fetchAll(PDO::FETCH_ASSOC);
            return $deatils;
        }
        
        public function get_chosen_hldys(){
            $em = $_SESSION['loggedIn'];
            $getUserhldys = $this->db->query("SELECT * FROM viv_holidays_chosen_en WHERE _holidays_chosen_email = ".$this->db->quote($em)." and _holidays_chosen_year = ".$this->db->quote(date("Y")));
            $holidayList = $getUserhldys->fetchAll(PDO::FETCH_ASSOC);
            return $holidayList;
        }
}

