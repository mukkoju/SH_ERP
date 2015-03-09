<?php

class Index_model extends Model {

    function __construct() {
        parent::__construct();
        // echo "in index_model";
    }

    public function signup() {
        $sth1 = $this->db->prepare("INSERT INTO user(firstname, lastname, username, email, password) VALUES (:firstname, :lastname, :username, :email, :password)");
        $insert = $sth1->execute(array(
                            ':firstname' => $_POST['firstname'],
                            ':lastname' => $_POST['lastname'],
                            ':username' => $_POST['username'],
                            ':email' => $_POST['email'],
                            ':password' => md5($_POST['password'])));
        
        if($insert == true){
            
        header('location: ../home');
        exit();
        }
        else
        {
            
            echo "somthing went wrong";
            // echo "\nPDO::errorInfo():\n";
            print_r($sth1->errorInfo());
        }
    }

    public function run($em, $pw) {
        
        $sth = $this->db->query("SELECT * FROM viv_emp_en WHERE _emp_email =".$this->db->quote($em)." AND _emp_pw = ".$this->db->quote(md5($pw)));
//        $sth->execute(array(
//           ':email' => $em,
//           ':password' => md5($pw)));
           $row = $sth->rowCount();
           $result = $sth->fetchAll(PDO::FETCH_ASSOC);
           

        if ($row > 0) {
            // setting session varible for loggedIn user email and Id 
            Session::set('loggedIn', $em);
            Session::set('loggedInId', $result[0]['_emp_id']);
            Session::set('loggedInLevel', $result[0]['_emp_level']);
            
            // setting session varibles for loggedIn user basic details
            $getUserdtls = $this->db->query("SELECT _emp_per_name, _emp_per_dob, _emp_per_phone, _emp_per_sex FROM viv_emp_per_en WHERE _emp_per_email =".$this->db->quote($em));
            $userdtls = $getUserdtls->fetchAll(PDO::FETCH_ASSOC);
            Session::set('loggedInName', $userdtls[0]['_emp_per_name']);
            Session::set('loggedInPhone', $userdtls[0]['_emp_per_phone']);
            Session::set('loggedInSex', $userdtls[0]['_emp_per_sex']);
            Session::set('loggedInDob', $userdtls[0]['_emp_per_dob']);
            
            // setting session varibles for loggedIn user roles
            $getUserDesg = $this->db->query("SELECT _emp_rol_designation, _emp_rol_department FROM viv_emp_rol_en WHERE _emp_rol_email =".$this->db->quote($em));
            $userrols = $getUserDesg->fetchAll(PDO::FETCH_ASSOC);
            Session::set('loggedInDesignation', $userrols[0]['_emp_rol_designation']);
            Session::set('loggedInDepartment', $userrols[0]['_emp_rol_department']);
            
            // recording login location and ip address
            $eserver = $this -> db -> quote($_SERVER['REMOTE_ADDR']);
            if(0){
              $remote = geoip_record_by_name("202.133.59.131");  
            }
            else{
//                $remote = geoip_record_by_name($_SERVER['REMOTE_ADDR']);
                $remote = 'Hyderabad';
            }
            
        //  $loc = $this -> db -> quote($remote['city']. '/'. $remote['country_name']);
            $loc = $this -> db -> quote('hyderabad/India');
            $record = $this->db->query("INSERT INTO viv_lgn_rec_en ( _lgn_email,
                                          _lgn_ip,
                                          _lgn_loc,
                                          _lgn_time ) VALUES(".$this -> db -> quote($em).",".$eserver.",".$loc.",".time().")");
            } else {
            $err = "Incorect email or password";
            return $err;
                   }
    }
    public function forgetpwd(){
        $frgt = $this->db->prepare("SELECT emp_email FROM new_emp WHERE emp_email = :emil");
        $frgt->execute(array(':emil'=>$_POST['email']));
        $row = $frgt->rowCount();
        if($row > 0){
            $t = 'Email reset link emailed successfully';
            return $t;
        }else{
            $res = -1;
            return $res;
        }
    }
    

}
