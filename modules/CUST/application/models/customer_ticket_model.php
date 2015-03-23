<?php

class Customer_Ticket_model extends Model{
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function addTicketEntry(){
        $time = time();
        $id = md5($time . rand(21, 221) . '#$sr');
        $ttl = $_POST['ttl'];
        $desc = $_POST['desc'];
        $catg = $_POST['catg'];
        $sb_catg = $_POST['sb_catg'];
        $asgni = $_POST['asgni'];
        if($asgni == ''){
            $asgni = $_SESSION['loggedIn'];
        }else{
            $asgni = $_POST['asgni'];
        }
        if(!empty($_POST['atchmnts'])){
        $atchmt = $_POST['atchmnts'];
        $atchmt = explode(',', $atchmt);
//      var_dump($atchmt);
        for($i=0; $i<sizeof($atchmt); $i++){
            $atchmnt = $this -> db -> query("INSERT INTO viv_cust_servs_atchmnts_en(_cust_servs_atchmnts_nme, _cust_servs_atchmnts_tcktid, _cust_servs_atchmnts_addedon, _cust_servs_atchmnts_addedby) VALUES(".$this -> db -> quote($atchmt[$i]).",".
                                                                                            $this -> db -> quote($id).",".
                                                                                            $this -> db -> quote(time()).",".
                                                                                            $this -> db -> quote($_SESSION['loggedIn']).")");
        }                                                                                   
        }
        
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
            $sts = ['sts'=> 1, 'tckt_id'=> $id];
        }else{
            $sts = ['sts'=> 0];
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
    
    
    // @adding attachment for ticket creating
    public function tickt_attachmt() {
        $file = $_FILES['tckt-attcmnt'];
        $allowedExts = array("png", "jpg", "jpeg", "JPG", "JPEG", "pdf", "x-pdf");
        $temp = explode(".", $file["name"]);
        $rnd1 = rand(10, 99);
        $rnd2 = rand(10, 99);
        $rnd3 = rand(10, 99);
        $rnd4 = rand(10, 99);
        $org_flnme = preg_replace('/\s+/', '_', $file["name"]);
        $org_flnme = "$rnd1$rnd2$rnd3$rnd4-$org_flnme";
        $extension = end($temp);
        $folder = UPLOADS . "/multimedia/";
        if ($file["error"] > 0) {
            $invalid = 'Unable to upload this file.';
            return $invalid;
        } else {
            if ((($file["type"] == "application/pdf") || ($file["type"] == "application/x-pdf") || ($file["type"] == "image/png") || ($file["type"] == "image/jpg") || ($file["type"] == "image/jpeg") || ($file["type"] == "image/JPG") || ($file["type"] == "image/JPEG")) && ($file["size"] < 40000000) && in_array($extension, $allowedExts)) {
                $move = move_uploaded_file($file["tmp_name"], $folder . str_replace(" ", "-", "$org_flnme"));
                $folder . $file["name"];
            $retrnimg = [UPLOADS . "/multimedia/$org_flnme", $org_flnme];
                return $retrnimg;
            } else {
                $invalid = 'This file format is not supported. Only pdf, jpg, and png are allowed.';
                return $invalid;
            }
        }
    }

}
