<?php

class Home_model extends Model {

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

    public function getLeavesDeatils($em) {
        $date = date("j-n-Y");

        $sth6 = $this->db->query("SELECT * FROM viv_emp_leaves_en, viv_emp_per_en WHERE viv_emp_leaves_en._emp_leaves_email = viv_emp_per_en._emp_per_email  ORDER BY _emp_leaves_applyedon DESC");
        // print_r($sth6->errorInfo());
        $res = $sth6->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getLeavesDeatilsByHr($em) {
        $date = date("j-n-Y");
//        $sth6 = $this->db->query("SELECT * FROM viv_emp_leaves_en WHERE _emp_leaves_manager_status = 1 ORDER BY _emp_leaves_manager_statuson DESC");
        $sth6 = $this->db->query("SELECT * FROM viv_emp_leaves_en, viv_emp_per_en WHERE viv_emp_leaves_en._emp_leaves_email = viv_emp_per_en._emp_per_email AND viv_emp_leaves_en._emp_leaves_manager_status = 1 ORDER BY _emp_leaves_applyedon DESC");
        // print_r($sth6->errorInfo());
        $res = $sth6->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function register() {
        if(trim($_POST['emp_email']) == ''){
            $err = "Sorry email requried!!";
            return $err;        
        }
        $emailvrfy = $this->db->prepare("SELECT * FROM new_emp WHERE emp_email = :email");
        $emailvrfy->execute(array(':email'=>$_POST['emp_email']));
        if ($emailvrfy->rowCount() > 0) {
            $res = "Email already registered";
            return $res;
        }
        $dob = strtotime($_POST['dob']);
        $dob = date("Y-m-d" ,$dob);
        $dob = strtotime($dob);
        $doj = strtotime($_POST['doj']);
        $doj = date("Y-m-d" ,$doj);
        $doj = strtotime($doj);
        $sth8 = $this->db->prepare("INSERT INTO new_emp(emp_name, emp_id, emp_email, password, phone_no, dob, fathername, mothername, age, bloodgroup, address, "
                . "            gender, spousename, emr_name, emr_relation, emr_phone, emr_email, emp_type, designation, department, bank_account, pf_account, pan, ifsc_code, basic_salarie, date_of_joining) "
                . "                VALUE(:emp_name, :emp_id, :emp_email, :password, :phone_no, :dob, :fathername, :mothername,"
                . "                      :age, :bloodgroup, :address, :gender, :spousename, :emr_name, :emr_relation, :emr_phone,"
                . "                      :emr_email, :emr_type, :designation, :department, :bank_acc, :pf_acc, :pan, :ifsc, :basic_sal, :date_of_joining)");
        $insert = $sth8->execute(array(':emp_name' => $_POST['emp_name'],
            ':emp_id' => $_POST['emp_id'],
            ':emp_email' => $_POST['emp_email'],
            ':password' => trim(md5($_POST['password'])),
            ':phone_no' => $_POST['emp_phno'],
            ':dob' => $dob,
            ':fathername' => $_POST['fathername'],
            ':mothername' => $_POST['mothername'],
            ':age' => $_POST['age'],
            ':bloodgroup' => $_POST['bloodgroup'],
            ':address' => $_POST['address'],
            ':gender' => $_POST['gender'],
            ':spousename' => $_POST['spousename'],
            ':emr_name' => $_POST['emr_name'],
            ':emr_relation' => $_POST['emr_relation'],
            ':emr_phone' => $_POST['emr_phone'],
            ':emr_email' => $_POST['emr_email'],
            ':emr_type' => $_POST['emptype'],
            ':designation' => $_POST['designation'],
            ':department' => $_POST['department'],
            ':bank_acc' => $_POST['bank_acc'],
            ':pf_acc' => $_POST['pf_acc'],
            ':pan' => $_POST['pan'],
            ':ifsc' => $_POST['ifsc'],
            ':basic_sal' => $_POST['basic_sal'],
            ':date_of_joining'=>$doj
        ));
        if ($insert == true) {
            $status = "Registerd sucessfully";
        } else {
            $status = "Somthiong wrong while adding Employee";
//            print_r($sth8->errorInfo());
        }
        return $status;
    }

    public function pdf() {
        require 'controllers/phpToPDF.php';
        $html = '<HTML><h2>PDF from HTML using phpToPDF</h2></HTML>';
        $folder = "/var/www/emp_mvc/uploads/kkk@gmail.com";
        $pdf_options = array("source_type" => 'html',
            "source" => $html,
            "action" => 'save',
            "save_directory" => $folder,
            "file_name" => 'my_filename1.pdf');
        $phptopdf = phptopdf($pdf_options);
        if ($phptopdf == true) {
            echo "ok";
        } else {
            echo "errrr";
        }
    }
    public function mpdf($em) {
        include 'mpdf/mpdf.php';
        $mpdf = new mPDF();
        $post = $_POST["slctd_emp"];
        //echo sizeof($post);
        for ($i = 0; $i < sizeof($post); $i++) {
            $email = $post[$i]['mail'];
            //$email = $_POST['mail'];
            // echo "hai $email"; 
            $file_name = $post[$i]['file_name'];
            $month = $post[$i]['month_slip'];
            $year = $post[$i]['year_slip'];
            $folder = APP_PATH."/uploads/$email";
            // $file = "/var/www/emp_mvc/uploads/$file_name";
            $total_ernings = $post[$i]['basic']+$post[$i]['hra']+$post[$i]['conveyance_allowance']+$post[$i]['Spcl_allowance'];
            $html = '<html><div style="background-image: url(/images/letter_head.png); background-position: center;
                     background-repeat: no-repeat;
                    background-size: 100% 100%;">
                     <div style="padding-top: 25%;
                    padding-bottom: 25%;"><h5 align="center">Payslip for the month of ' . $month . ' ' . $year . '</h5><h5 align="center">Financial Period '. $date = date("Y")-1 .'-' . $date = date("Y") . '</h5>
            <table align="center" border="1">
                    <tr><th colspan="4">Associate Information</th></tr>
                    <tr><td>Name</td>
                    <td>' . ($post[$i]['emp_name']) . '</td>
                    <td>PAN</td>
                    <td>' . ($post[$i]['pan']) . '</td></tr>
                    <tr><td>Designation</td>
                    <td>' . ($post[$i]['designation']) . '</td>
                    <td>Bank A/C</td>
                    <td>' . ($post[$i]['bank_a/c']) . '</td></tr>
                <tr><td>Gender</td>
                    <td>' . ($post[$i]['gender']) . '</td>
                    <td>IFSC Code</td>
                    <td>' . ($post[$i]['ifsc']) . '</td></tr>
                <tr><td>Date Of Joining</td>
                    <td>' . (date("j-M-Y", $post[$i]['doj'])) . '</td>
                    <td>Available Calender Days</td>
                    <td>' . ($post[$i]['available_days']) . '</td></tr>
                <tr><td>Date Of Birth</td>
                    <td>' . (date("j-M_Y", $post[$i]['dob'])) . '</td>
                    <td>Paid Days</td>
                    <td>' . ($post[$i]['paid_days']) . '</td></tr>
                <tr><td>PF A/C</td>
                    <td>' . ($post[$i]['pf_a/c']) . '</td>
                    <td>Loss Of Days</td>
                    <td>' . ($post[$i]['loss_of_days']) . '</td></tr>
            </table><br/>

            <table align="center" border="1" >
                <tr><th>Earnings</th>
                    <th>Amount</th>
                    <th>Deductions</th>
                    <th>Amount</th></tr>
                <tr><td>Basic</td>
                    <td>'. $post[$i]['basic']. '</td>
                    <td>TDS</td>
                    <td>' . ($post[$i]['tds']) . '</td></tr>
                <tr><td>HRA</td>
                    <td>' . ($post[$i]['hra']) . '</td>
                    <td>PF</td>
                    <td>' . ($post[$i]['pf']) . '</td></tr>
                <tr><td>Conveyance Allowance</td>
                    <td>' . ($post[$i]['conveyance_allowance']) . '</td>
                    <td>PT</td>
                    <td>' . ($post[$i]['pt']) . '</td></tr>
                <tr><td>Special Allowance</td>
                    <td>' . ($post[$i]['Spcl_allowance']) . '</td>
                    <td></td>
                    <td></td></tr>
                <tr><td><b>(A) Total Earnings</b></td>
                    <td>' . $total_ernings . '</td>
                    <td><b>(B) Total Deductions</b></td>
                    <td>' . ($total_ernings-$post[$i]['net']) . '</td></tr>
                <tr><td colspan="3" align="right"><b>Net Salary=(A)-(B)</b></td>
                    <td>' . ($post[$i]['net']) . '</td></tr>
            </table></div></div></html>';
            // $folder = "/var/www/Emp_mvc/uploads/";        
            $mpdf->WriteHTML($html);
            if (!file_exists($folder)) {
                mkdir($folder, 0777);
                // echo "Directory sucs";
            } else {
                // echo "Directory creation faild";
            }
            $final = "$folder/$file_name";
            
            $month_slip = trim($post[$i]['month_slip']);
            $year_slip = $post[$i]['year_slip'];
            $payslip_month_y = strtotime("1 $month_slip $year_slip");
            $payslip_ttl = $post[$i]['file_name'];
            $d = new DateTime();
            $d->setTimestamp($payslip_month_y);
            $d->format('U = Y-m-d H:i:s') . "\n";
            $id = md5($time . rand(21, 221) . '#$sr');
            $emp_payslip = $this->db->query("INSERT INTO viv_emp_payslip_en VALUES (".$this->db->quote($id)."," . $this->db->quote($email). "," . $this->db->quote($payslip_ttl) . "," .$this->db->quote($month_slip .$year_slip). "," . $this->db->quote(time()) . "," . $this->db->quote($_SESSION['loggedIn']).")");
            
            if($emp_payslip == true){
            $stmnt = $post[$i]['_statement_'];
            $stmnt_sts = $this->db->query("UPDATE viv_emp_stmnts_en SET _emp_stmnts_status =".$this -> db ->quote(2)." WHERE _emp_stmnts_email = " . $this -> db -> quote($email) . " and  _emp_stmnts_on = ". $this->db->quote($stmnt));
            $mpdf->output($final, 'F');
            $status = "Pay slip(s) genrated and its uploded to employee(s) desk";
            }else{
                $status = "Somthing went wrong while genrating payslip";
            }
            }
                           
            return $status;
        
    }
    
    
    public function bank_statement_model() {
        include 'mpdf/mpdf.php';
        $mpdf = new mPDF();
        $chq_no = $_POST['chq_no'];
        $post = $_POST["slctd_emp"];
        $total = 0;
        // making sum of selected employes max-pay  
        for ($i = 0; $i < sizeof($post); $i++) {
            $total = $total + $post[$i]['net'];
        }
        
        // HTML for bank statement pdf
        $email = Session::get('loggedIn');
        $month = $post[0]['month_slip'];
        $year = $post[0]['year_slip'];
        $folder = APP_PATH . "/uploads/$email/Bank_statments";
        $html_bnk_stmnt = '<html><div style="background-image: url(/images/letter_head.png); background-position: center; background-repeat: no-repeat; background-size: 100% 100%;"><div style="padding-top: 1%; padding-bottom: 25%;"></div>'
                . '<div style="padding-top: 5%; padding-bottom: 25%; padding-left: 12%; font-size: 0.8em;"><p align="right" style="padding-right: 21%;">DT:' . date("d-m-Y") . '.</p><p align="left">Ref: VIMPL: SAL: 2014-14:<br><br>'
                . 'To,<br>HDFC Bank LTD,<br>2-3-34/8 R, Devilal Complex,<br>Main Road, Uppal Kalan,<br>Hyderabad - 500039<br><br>Sub:Payment of salaries<br>Ref:Our account No. 10427630000537 dt: ' . date("d-m-Y") . '</p><div align="center">&&&&&&</div>'
                . '<p>Dear sir,<br>We are here with enclosing the Ch No. ' . ($chq_no) . ' dt.' . date("d-m-Y") . ' for Rs.' . $total . '-00 towards salaries<br> as per the statement give bellow:</p>'
                . '<div align="left" style="padding-left: 10%;"><table border="1" >
                      <tr><th>S NO</th>
                      <th>Name of the Employee</th>
                      <th>Account no</th>
                      <th>Salary</th></tr>';
        for ($i = 0; $i < sizeof($post); $i++) {
            $html_bnk_stmnt = $html_bnk_stmnt . '<tr><td>' . ($i + 1) . '</td>
                          <td>' . ($post[$i]['emp_name']) . '</td>
                          <td>' . ($post[$i]['bank_a/c']) . '</td>
                          <td>' . ($post[$i]['net']) . '</td></tr>';
        }
        $html_bnk_stmnt = $html_bnk_stmnt . '<tr><td></td><td>Total Ammount</td><td></td><td>' . $total . '</td></tr></table></div><br><br>'
                . '<p>Kindly do the needful.</br><br>Thanking you,<br>For VIVEN INFOMEDIA PVT. LTD.,<br><br>MANAGING DIRECTOR.</p></div></div><html>';
       
        // @Calling write html function for genrate pdf  
        $mpdf->WriteHTML($html_bnk_stmnt);
        
        // Create folder with name of email if not exists
        if (!file_exists($folder)) {
            mkdir($folder, 0777);
        }
        
        // Calling Create pdf function output()
        $rand = rand(1000, 10000);
        $filename = "$rand-Bank-statement-$month-$year.pdf";
        $final_bank = "$folder/$filename";
        
        
        for ($i = 0; $i < sizeof($post); $i++) {
            
            $statement = strtotime("$month $year");
            date('j M, Y h:i a', $statement);
            $email  = $post[$i]['mail'];
            $max_pay = $post[$i]['net'];
            $leaves = $post[$i]['loss_of_days'];
            
            // Checking employee statement is already exisits 
            // in revert case staement entry standby in tpaable 
            $check_stamnt = $this->db->query("SELECT * FROM viv_emp_stmnts_en WHERE _emp_stmnts_email = ".$this -> db -> quote($email)." and  _emp_stmnts_mnthyer = ".$this -> db -> quote($month .$year));
            if ($check_stamnt->rowCount() > 0) {
                // if statement exist just changeing the status of the statement
                $chng_status = $this->db->query("UPDATE viv_emp_stmnts_en SET _emp_stmnts_status =".$this -> db -> quote(1).", _emp_stmnts_maxpay = ". $this -> db -> quote($max_pay).", _emp_stmnts_leves = ". $this -> db -> quote($leaves)." WHERE _emp_stmnts_email = ".$this -> db -> quote($email)." and _emp_stmnts_mnthyer = ".$this -> db -> quote($month .$year));
                
            } else {
                
                // if not statement not exits making new entry
                $id = md5($time . rand(21, 221) . '#$sr');
                $user_statement = $this->db->query("INSERT INTO viv_emp_stmnts_en VALUES(" . $this->db->quote($id) . ",". $this->db->quote($email) . "," . $this->db->quote($statement) . "," . $this->db->quote($month. $year) . ",". $this->db->quote(1) . ","  . $this->db->quote(time()) . ",".
                                                                                             $this->db->quote($_SESSION['loggedIn']) ."," . $this->db->quote($max_pay) . "," . $this->db->quote($leaves).")");
            }
        }
        
        //bank statement for selected employess
        $stmnt_id = md5($time . rand(21, 221) . '#$sr');
        $stmenttodb = $this->db->query("INSERT INTO viv_bank_stmnt_en VALUES(" . $this->db->quote($stmnt_id) . "," . $this->db->quote($filename) . "," . $this->db->quote(time()). "," . $this->db->quote($_SESSION['loggedIn']).")");
        if($stmenttodb == true){
            $mpdf->output($final_bank, 'F');
            $status = [path => "$final_bank", filename => "$filename", sts => "Statements genarted sucessfully!!!"];
        }else{
            $status = [sts => "Somthing went wrong while genarting statement"];
        }
        return $status;
    }

//    public function paid_deatils($em) {
//        
//        $year = $_POST['year'];
//        $month = $_POST['month'];
//        $payslip_month_y = strtotime("1 $month $year");
//        $d = new DateTime();
//        $d->setTimestamp($payslip_month_y);
//        $d->format('U = Y-m-d H:i:s') . "\n";
//        $sth_paid_deatils = $this->db->prepare("SELECT * FROM new_emp WHERE emp_email NOT IN (SELECT email FROM slips WHERE month_of_payslip = :payslip_month_y)");
//        $insert = $sth_paid_deatils->execute(array(':payslip_month_y' => "$month$year"));
//        $res = $sth_paid_deatils->fetchAll(PDO::FETCH_ASSOC);
//        
////        $itm = $this->db->prepare("SELECT * FROM  new_emp");
////        $itm->execute();
////        $tm = $itm->fetchAll(PDO::FETCH_ASSOC);
////        $full_data = [];
////        var_dump(sizeof($tm));
////        foreach ($tm as $row){
////        $email = $row['emp_email'];
////        $item2 = $this->db->prepare("SELECT _email_, _statement_, _time_, _status_ FROM _user_statements_ WHERE _email_ = :email and _status_ = 1");
////        $item2->execute(array(':email'=>$email));
////        $data = $item2->fetchAll(PDO::FETCH_ASSOC);
//////        var_dump($data);
////        if(empty($data[0])){
////            array_push($full_data, $row);
////        }else{
////         $d = array_merge($row, $data[0]);
////         array_push($full_data, $d);
////        }
////        }
////        $res = $full_data;
//        //$result = print_r($res);
//        // return $payslip_month_y;
//        return $res;
//
//        // array('payslip_date:'=> $_POST['month'].$_POST['year'])
//    }

 public function paid_deatils($em){
        $year = $_POST['year'];
        $month = $_POST['month'];
        $itm = $this->db->query("SELECT * FROM  viv_emp_per_en, viv_emp_financial_en WHERE  viv_emp_per_en._emp_per_email = viv_emp_financial_en._emp_financial_email");
        $tm = $itm->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($tm);
        $full_data = [];
        $statement = strtotime("$month $year");
//         echo $month;
        date('j M, Y h:i a', $statement);
        foreach ($tm as $row){
        $email = $row['_emp_per_email'];
        $item2 = $this->db->query("SELECT * FROM viv_emp_stmnts_en WHERE _emp_stmnts_email =".$this -> db -> quote($email)." and _emp_stmnts_mnthyer = ".$this -> db -> quote($month. $year));
        $data = $item2->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($data);
        if(empty($data[0])){
            array_push($full_data, $row);
        }else{
         $d = array_merge($row, $data[0]);
         array_push($full_data, $d);
        }
        }
        
        $res = $full_data;
//        var_dump($res);
        return $full_data;
     
 }


 public function updates(){
        $post_new_updates = $this->db->prepare("INSERT INTO new_updates(new_update, time) VALUES(:update, :time)");
        $insert = $post_new_updates->execute(array(':update'=> $_POST['post'], ':time'=> time()));
        if($insert == true){
            $status_on = $this->db->prepare("UPDATE new_emp SET notice_alert = 1");
            $status_on->execute();
            $status = "New Update Posted Successfilly";
            return $status;
        }else{
            $status  = "Somthing wrong while posting new update";
            return $status;
        }
    }
     public function get_new_update(){
         $get_new_updates = $this->db->prepare("SELECT * FROM new_updates ORDER BY time DESC LIMIT 1");
         $insert = $get_new_updates->execute();
         $resp = $get_new_updates->fetchAll(PDO::FETCH_ASSOC);
         return $resp; 
     }
     
     public function get_statements(){
         $get_saatements = $this->db->prepare("SELECT * FROM viv_bank_stmnt_en ORDER BY _bank_stmnt_addedon DESC LIMIT 20");
         $get_saatements->execute();
         $result =  $get_saatements->fetchAll(PDO::FETCH_ASSOC);
         return $result;
     }


     public function empdocs() {
        $allowedExts = array("pdf", "png", "jpg", "jpeg", "JPG", "JPEG");
        $i = 1;
        if($_POST["eml"] == ''){
            $err = "Email cannot be empty";
            return $err;
        }
//        var_dump($_FILES);
        foreach ($_FILES as $file) {
           //echo $file["name"]; 
           $temp = explode(".", $file["name"]);
          $file["name"]; 
//          echo $_POST["doctype$i"];
        $email =  $_POST["eml"];
        $extension = end($temp);
        $folder = APP_PATH."/uploads/$email/docs/";
        if ((($file["type"] == "application/pdf") || ($file["type"] == "application/x-pdf") || ($file["type"] == "image/png") || ($file["type"] == "image/jpg") || ($file["type"] == "image/jpeg")|| ($file["type"] == "image/JPG") || ($file["type"] == "image/JPEG")) && ($file["size"] < 40000000) && in_array($extension, $allowedExts)) {
            if ($file["error"] > 0) {
                $mpty = "Selece max one file" .$file['error'];
                return $mpty;
            } else {
                 $name = $file["name"] . "<br>";
                 "Type: " . $file["type"] . "<br>";
                 "Size: " . ($file["size"] / 40000) . " kB<br>";
                 "Temp file: " . $file["tmp_name"] . "<br>";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777);
                }
                if (file_exists($folder . $file["name"])) {
                   echo $file["name"] . " already exists. ";
                } else {
                    $move = move_uploaded_file($file["tmp_name"], $folder . str_replace(" ", "-", $file["name"]));
                     $folder . $file["name"];
                }
                $scs = "Documents uploaded successfully!!";
                return $scs;
            }
        } else {
            $invalid =  'Invalid image format. Only pdf, jpg, jpeg, and png are allowed.';
                return $invalid; 
        }
        $i++;
        }
        
//        while($file != NULL ){
//          
//          $i++;    
//          if($i > 10)
//              break;
//        }
        
        
        
    }
    
    public function profile_pic($email){
        $file = $_FILES['p-pic-change'];
        $allowedExts = array("png", "jpg", "jpeg", "JPG", "JPEG");
        $temp = explode(".", $file["name"]);
        $org_flnme = preg_replace('/\s+/', '_', $file["name"]);
        $extension = end($temp);
        $folder = UPLOADS."/$email/profile_pic/";
        if ((($file["type"] == "application/pdf") || ($file["type"] == "application/x-pdf") || ($file["type"] == "image/png") || ($file["type"] == "image/jpg") || ($file["type"] == "image/jpeg")|| ($file["type"] == "image/JPG") || ($file["type"] == "image/JPEG")) && ($file["size"] < 40000000) && in_array($extension, $allowedExts)) {
            if ($file["error"] > 0) {
                $mpty = "File format not supporting for this" .$file['error'];
                return $mpty;
            } else {
                 $name = $file["name"] . "<br>";
                 "Type: " . $file["type"] . "<br>";
                 "Size: " . ($file["size"] / 40000) . " kB<br>";
                 "Temp file: " . $file["tmp_name"] . "<br>";
                  $intial_folder = UPLOADS."/$email/";
                 if (!file_exists($intial_folder)) {
                    mkdir($intial_folder, 0777);
                }
                if (!file_exists($folder)) {
                    mkdir($folder, 0777);
                }
                    $finalname = UPLOADS."/$email/profile_pic/";
                    array_map('unlink', glob("$finalname/*"));
                    $move = move_uploaded_file($file["tmp_name"], $folder . str_replace(" ", "-", "$org_flnme"));
                     $folder . $file["name"];
                    
                
                $retrnimg = "/uploads/$email/profile_pic/$org_flnme";
                return $retrnimg;
            }
        } else {
            $invalid =  'Invalid image format. Only pdf, jpg, jpeg, and png are allowed.';
                return $invalid; 
        }
    }
    
    public function set_user_lvl() {
        if ($_POST['eml'] == '') {
            $res = "User suspended";
            return $res;
        }
        $emilverfy = $this->db->prepare("SELECT * FROM new_emp WHERE emp_email = :email");
        $emlnot = $emilverfy->execute(array(':email' => $_POST['eml']));
        if ($emilverfy->rowCount() === 0) {
            $res = "Sorry this email is not registerd yet!!";
            return $res;
        }
        $user_level = $this->db->prepare("UPDATE new_emp SET user_level = :user_level WHERE emp_email = :email");
        $user_level->execute(array(':user_level' => $_POST['levl'], ':email' => $_POST['eml']));
        if ($user_level == true) {
            $res = "User level added successfully";
        } else {
            $res = "User level adding faild";
        }
        return $res;
    }

    public function change_pwd() {
        if ($_POST['eml'] == '') {
            $res = "User suspended";
            return $res;
        }
        $emilverfy = $this->db->prepare("SELECT * FROM new_emp WHERE emp_email = :email");
        $emlnot = $emilverfy->execute(array(':email' => $_POST['eml']));
        if ($emilverfy->rowCount() === 0) {
            $res = "Sorry this email is not registerd yet!!";
            return $res;
        }
        $user_level = $this->db->prepare("UPDATE new_emp SET password = :pwd WHERE emp_email = :email");
        $user_level->execute(array(':pwd' => trim(md5($_POST['pwd'])), ':email' => $_POST['eml']));
        if ($user_level == true) {
            $res = "Password changed successfully";
        } else {
            $res = "Password changing faild";
        }
        return $res;
    }
    
    public function get_bdys(){
        $this_mnth = date("mY");
        $bdys = $this->db->prepare("SELECT emp_name, department, emp_email, dob FROM new_emp WHERE FROM_UNIXTIME(dob, '%m%Y') = $this_mnth");
        $bdys->execute();
        $deatils = $bdys->fetchAll(PDO::FETCH_ASSOC);
        var_dump($deatils);
        return $deatils;
        }
        
        public function edit_emp(){
            $emp_email = trim($_POST['emp_email']);
            $name = trim($_POST['edit_name']);
            $phno  = trim($_POST['edit_phone']);
            $addrs = trim($_POST['edit_address']);
            $desg = trim($_POST['edit_designation']);
            $ban_acc = trim($_POST['edit_bank_account']);
            $pf_acc = trim($_POST['edit_pf_account']);
            $pan = trim($_POST['edit_pan']);
            $ifsc = trim($_POST['edit_ifsc']);
            $salre = trim($_POST['edit_basic_salarie']);
            if($emp_email == ''|| $name == '' || $phno == '' ||$addrs  == ''|| $desg == ''
                  || $ban_acc == '' || $pf_acc == '' || $pan == '' || $ifsc == '' || $salre == ''){
                $status  =  "Somthiong wrong while updating details";
                return $status;
            }
            $edit_emp = $this->db->prepare('UPDATE new_emp SET emp_name = :name, phone_no = :ph_no, address = :addres, designation = :desg, bank_account = :bank_ac, pf_account = :pf_ac, pan = :pan, ifsc_code = :ifsc, basic_salarie  = :salarie  WHERE emp_email =  :emp_email');
            $edit_emp->execute(array(':emp_email'=> $emp_email, ':name'=>$_POST['edit_name'],
                                                               ':ph_no'=>$_POST['edit_phone'],
                                                               ':addres'=>$_POST['edit_address'],
                                                               ':desg'=>$_POST['edit_designation'],
                                                               ':bank_ac'=>$_POST['edit_bank_account'],
                                                               ':pf_ac'=>$_POST['edit_pf_account'],
                                                               ':pan'=>$_POST['edit_pan'],
                                                               ':ifsc'=>$_POST['edit_ifsc'],
                                                               ':salarie'=>$_POST['edit_basic_salarie']));
            if($edit_emp = true){
                $status = 'Updated successfully!!';
            }else{
                $status = 'Updating faild';
            }
            return $status;
        }
        
        public function updtae_close(){
            $status_off = $this->db->prepare("UPDATE new_emp SET notice_alert = 0 WHERE emp_email = :email");
            $status_off->execute(array(':email'=>$_POST['email']));
        }
        
        public function leaves_alert_close(){
            $status_off = $this->db->prepare("UPDATE new_emp SET leaves_alert = 0 WHERE emp_email = :email");
            $status_off->execute(array(':email'=>$_POST['email']));
        }
        
        public function bdy_alert_close(){
            $status_off = $this->db->prepare("UPDATE new_emp SET bdy_alert = 0 WHERE emp_email = :email");
            $status_off->execute(array(':email'=>$_POST['email']));
        }
    public function emp_ofcl_hldys(){
        $email = $_SESSION['loggedIn'];
        $ids = $_POST['slctd_hldys'];
        $length = explode(',', $ids);
        $length = sizeof($length);
        $time = time();
        $id = md5($time . rand(21, 221) . '#$sr');
        if($length > 10){
            $status = "You are not able to chose more then 10 holidays";
            return $status;
        }
        
        $check_emp_hlds = $this -> db -> query("SELECT * FROM viv_holidays_chosen_en WHERE _holidays_chosen_email =".$this -> db -> quote($email));
        
        if($check_emp_hlds -> rowCount() > 0){
        
            $update_hlds = $this->db->query("UPDATE viv_holidays_chosen_en SET _holidays_chosen_id =".$this -> db -> quote($ids).", _holidays_chosen_modifiedon = ".$this->db->quote(time())." WHERE _holidays_chosen_email =".$this->db->quote($email));
            if($update_hlds == true){
                $status = "You are Updated $length optional holidays!!!";
            }else{
                $status = "Somthing went wrong while updating holiday";
            }
            
        }else{
            
        $add_entry = $this->db->query("INSERT INTO viv_holidays_chosen_en VALUES(".$this -> db ->quote($id).",".$this -> db ->quote($ids).",".$this -> db -> quote($email).",".$this->db->quote(date("Y")).",".$this->db->quote(time()).",".$this->db->quote(time()).")");    
        
        if($add_entry == true){
                 $status = "You have Chosen $length optional holidays!!!";
        }else{
            $status = "Somthing went wrong while chosing holidays";
        }
        }
       
        return $status;
    }
    
    public function get_directory_list(){
        if($_POST['dprtmt'] == 'All'){
            $details = $this->db->prepare("SELECT viv_emp_per_en._emp_per_name, viv_emp_per_en._emp_per_email, viv_emp_per_en._emp_per_phone, viv_emp_rol_en._emp_rol_department FROM viv_emp_per_en, viv_emp_rol_en WHERE viv_emp_per_en._emp_per_email = viv_emp_rol_en._emp_rol_email");
            $details->execute(array(':departmnt'=>$_POST['dprtmt']));
            $res = $details->fetchAll(PDO::FETCH_ASSOC);
        }else{
        $details = $this->db->prepare("SELECT viv_emp_per_en._emp_per_name, viv_emp_per_en._emp_per_email, viv_emp_per_en._emp_per_phone, viv_emp_rol_en._emp_rol_department FROM viv_emp_per_en, viv_emp_rol_en WHERE viv_emp_per_en._emp_per_email = viv_emp_rol_en._emp_rol_email AND _emp_rol_department = :departmnt");
        $details->execute(array(':departmnt'=>$_POST['dprtmt']));
        $res = $details->fetchAll(PDO::FETCH_ASSOC);
    }
    return $res;
    }
    public function cancel_payslip_model(){
        $email = $_POST['email'];
        $update = $this->db->query("UPDATE viv_emp_stmnts_en SET _emp_stmnts_status =".$this->db->quote(0)." WHERE _emp_stmnts_email =".$this -> db -> quote($email));
        if($update){
            $sts = "Succesfully discarded!!";
        }
        return $sts;
    }
    
    public function revert_back(){
        $email = $_POST['_email_'];
        $statement = $_POST['_statement_'];
        $update = $this->db->query("UPDATE viv_emp_stmnts_en SET _emp_stmnts_status = ".$this->db->quote(0)." WHERE _emp_stmnts_email = ".$this -> db -> quote($email)." and _emp_stmnts_on = ".$this -> db -> quote($statement));
        if($update == true){
            $sts = "reverted successfully";
        }
        else{
            $sts = "Somthing worng while reverting";
        }
        return $sts;
    }
    public function export_xl(){
        //Enter the headings of the excel columns
            $contents="id,name,Basic pay,leaves,titles,status\n";
            $contents.="1,";
            $contents.="Jeswanth reddy HR ,";
            $contents.="50000,";
            $contents.="2,";
            $contents.="46774";
            // remove html and php tags etc.
            $contents = strip_tags($contents);
            //header to make force download the file
            header("Content-Disposition: attachment; filename=xl".date('d-m-Y').".xls");
            print $contents;
    }
    public function file_download(){
    $file = APP_PATH."/uploads/hr@saddahaq.com/download.jpg"; 
    header("Content-Description: File Transfer"); 
    header("Content-Type: application/octet-stream"); 
    header("Content-Disposition: attachment; filename=\"$file\""); 
    readfile ($file); 
    }
    
    public function search(){
        $name = $_POST['kwd'];
        $search = $this->db->prepare("SELECT emp_name, emp_email, id FROM new_emp WHERE emp_name like '%".$name."%'");
        $search->execute();
        $res = $search->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    public function levs_by_srch(){
        $get_lvs = $this->db->prepare("SELECT hldys_list FROM new_emp WHERE emp_email = :email");
        $get_lvs->execute(array(':email' => $_POST['email']));
        $lvs = $get_lvs->fetchAll(PDO::FETCH_ASSOC);
        $lvs = $lvs[0]['hldys_list'];
        $lvs = str_replace(",", '", "', $lvs);
        $lvs = "/$lvs/";
        $lvs = str_replace("/", '"', $lvs);
        $get_ful_lvs = $this->db->prepare("SELECT * FROM holidays_list WHERE h_id IN ($lvs)");
        $get_ful_lvs->execute();
        $res = $get_ful_lvs->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    public function user_hlday(){
        $lv_id = $_POST['key'];
        $full_data = [];
        $all = $this->db->prepare("SELECT * FROM new_emp");
        $all->execute();
        $res = $all->fetchAll(PDO::FETCH_ASSOC);
        for($i=0; $i<sizeof($res); $i++){
        $temp = $res[$i]['hldys_list'];
        $name = $res[$i]['emp_name'];
        $str = explode(',', $temp);
        $index = array_search($lv_id, $str);
        if($index >= 0 && $index !== false){
            array_push($full_data, $name);
        }
        }
        return $full_data;
        
    }
    // New employee registration
    public function new_emp() {
        $dob = strtotime($_POST['dob']);
        $dob = date("Y-m-d" ,$dob);
        $dob = strtotime($dob);
        $doj = strtotime($_POST['doj']);
        $doj = date("Y-m-d" ,$doj);
        $doj = strtotime($doj);
        $emp_email = $_POST['emp_email'];
        $emp_id = $_POST['emp_id'];
        $emp_name = $_POST['emp_name'];
        $emp_phno = $_POST['emp_phno'];
        $emptype = $_POST['emptype'];
        $emp_branch = $_POST['empbranch'];
        $password = $this->genratePassword(8);
        $age = date('Y', time())-date('Y', $dob);
        $gender = $_POST['gender'];
        $spousename = $_POST['spousename'];
        $mothername = $_POST['mothername'];
        $fathername = $_POST['fathername'];
        $bloodgroup = $_POST['bloodgroup'];
        $department = $_POST['department'];
        $designation = $_POST['designation'];
        $address = $_POST['address'];
        $emr_email = $_POST['emr_email'];
        $emr_name = $_POST['emr_name'];
        $emr_phone = $_POST['emr_phone'];
        $emr_relation = $_POST['emr_relation'];
        $bank_acc = $_POST['bank_acc'];
        $basic_sal = $_POST['basic_sal'];
        $ifsc = $_POST['ifsc'];
        $pan = $_POST['pan'];
        $pf_acc = $_POST['pf_acc'];
        $addedon = time();
        $addedby = $_SESSION['loggedIn'];
        $time = time();
        $id = md5($time . rand(21, 221) . '#$sr');
        $status = 0;
        $emp = $this->db->query("INSERT INTO viv_emp_en(_id_, _emp_name, _emp_id, _emp_email, _emp_pw, _emp_branch,  _emp_addedby, _emp_addedon) VALUE(" . $this->db->quote($id) . "," .
               $this->db->quote($emp_name) . "," . $this->db->quote($emp_id) . "," . $this->db->quote($emp_email) . "," . $this->db->quote(md5($password)) . "," . $this->db->quote($emp_branch) . "," . $this->db->quote($addedby) . "," . $this->db->quote($addedon) . ")");

        if ($emp == true) {
            $emp_per = $this->db->query("INSERT INTO viv_emp_per_en VALUES(" . $this->db->quote($id) . "," .
                       $this->db->quote($emp_email) . "," . $this->db->quote($emp_name) . "," . $this->db->quote($gender) . "," . $this->db->quote($spousename) . "," . $this->db->quote($dob) . "," .
                       $this->db->quote($emp_phno) . "," . $this->db->quote($fathername) . "," . $this->db->quote($mothername) . "," . $this->db->quote($address) . "," . $this->db->quote($age) . "," .
                       $this->db->quote($bloodgroup) . "," . $this->db->quote($status) . "," . $this->db->quote($addedby) . "," . $this->db->quote($addedon) . "," . $this->db->quote($addedby) . "," . $this->db->quote($addedon) . ")");


            if ($emp_per == true) {
                $emp_rol = $this->db->query("INSERT INTO viv_emp_rol_en VALUES(" . $this->db->quote($id) . "," .
                           $this->db->quote($emp_email) . "," . $this->db->quote($designation) . "," . $this->db->quote($emptype) . "," . $this->db->quote($department) . "," . $this->db->quote($addedby) . "," . $this->db->quote($addedon) . "," . $this->db->quote($addedby) . "," . $this->db->quote($addedon) . ")");

                if ($emp_rol == true) {
                    $emp_emer = $this->db->query("INSERT INTO viv_emp_emer_en VALUES(" . $this->db->quote($id) . "," .
                                $this->db->quote($emp_email) . "," . $this->db->quote($emr_name) . "," . $this->db->quote($emr_email) . "," . $this->db->quote($emr_phone) . "," . $this->db->quote($emr_relation) . "," . $this->db->quote($addedby) . "," . $this->db->quote($addedon) . "," . $this->db->quote($addedby) . "," . $this->db->quote($addedon) . ")");

                    if ($emp_emer == true) {
                        $emp_financial = $this->db->query("INSERT INTO viv_emp_financial_en VALUES(" . $this->db->quote($id) . "," .
                                         $this->db->quote($emp_email) . "," . $this->db->quote($bank_acc) . "," . $this->db->quote($pf_acc) . "," . $this->db->quote($pan) . "," . $this->db->quote($ifsc) . "," .
                                         $this->db->quote($basic_sal) . "," . $this->db->quote($doj) . "," . $this->db->quote($addedby) . "," . $this->db->quote($addedon) . "," . $this->db->quote($addedby) . "," . $this->db->quote($addedon) . ")");
                        if ($emp_financial == true) {
                            
                            // password sending to registerd email address
                            $subject = 'Welcome to saddahaq';
                            $to = $emp_email;
                            $mail = '<html><body><table cellspacing = "0" cellpadding = "0" style = "padding:10px 10px;background:#eee;width:100%;font-family:arial"><tbody><tr><td><table align = "center" cellspacing = "0" style = "max-width:650px;min-width:320px"><tbody><tr><td style = "text-align:left;padding-bottom:14px"><img align = "left" style = "width: 200px;" alt = "Saddahaq" src = "https://tt.saddahaq.com/public/global/Images/lp_logo.png"></td></tr><tr><td align = "center" style = "background:#fff;border:1px solid #e4e4e4;padding:50px 30px"><table align = "center"><tbody><tr><td style = "color:#666;text-align:left"><table align = "center" style = "margin:auto"><tbody><tr><td style = "text-align:center;padding-bottom:5px"></td></tr><tr><td style = "color:#005f84; font-size:16px;font-weight:bold;text-align:center;font-family:arial">Congratulations Welcome to SaddaHaq family</td></tr></tbody></table><p style = "font-size:16px;margin-bottom:0">Login using this credentials</p><p style = "font-size:16px;margin-top:5px">Email: ' . $emp_email . '</p><p style = "font-size:16px;margin-top:5px">Password: ' . $password . '</p><table align = "center" style = "margin:auto;width:100%"><tbody><tr><td style = "color:#666;font-size:16px;padding-bottom:30px;text-align:left;font-family:arial"><div style = "font-style:italic;padding-bottom:15px;font-family:arial;line-height:20px;text-align:left"></div></td></tr></tbody></table><table align = "center" style = "margin:auto"><tbody><tr><td style = "background-color:white;border:1px solid #028a25;border-radius:3px;text-align:center"><a href = "' . LIVE . '" style = "padding:16px 20px;display:block;text-decoration:none;color:#333;font-size:16px;text-align:center;font-family:arial;font-weight:bold" target = "_blank">LOGIN</a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td></td></tr></tbody></table></body></html>';
                            $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                            mail($to, $subject, $mail, $headers);
                            $sts = '{"success":1, "msg": "New Employee added successfully && Password sent to given email"}';
                            return $sts;
                        } else {
                            $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_en WHERE _id_ = " . $this->db->quote($id));
                            $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_per_en WHERE _id_ = " . $this->db->quote($id));
                            $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_rol_en WHERE _id_ = " . $this->db->quote($id));
                            $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_emer_en WHERE _id_ = " . $this->db->quote($id));
                            $sts = '{"success":0, "msg": "Somthing worng while addinng employee"}';
                            return $sts;
                        }
                    } else {
                        $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_en WHERE _id_ = " . $this->db->quote($id));
                        $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_per_en WHERE _id_ = " . $this->db->quote($id));
                        $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_rol_en WHERE _id_ = " . $this->db->quote($id));
                        $sts = '{"success":0, "msg": "Somthing worng please try again"}';
                        return $sts;
                    }
                } else {
                    $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_en WHERE _id_ = " . $this->db->quote($id));
                    $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_per_en WHERE _id_ = " . $this->db->quote($id));
                    $sts = '{"success":0, "msg": "Somthing worng please try again"}';
                    return $sts;
                }
            } else {
                $emp_per_dlt = $this->db->query("DELETE FROM viv_emp_en WHERE _id_ = " . $this->db->quote($id));
                $sts = '{"success":0, "msg": "Somthing worng please try again"}';
                return $sts;
            }
        } else {
            $emp_dlt = $this->db->query("DELETE FROM viv_emp_en WHERE _id_ = " . $this->db->quote($id));
            $sts = '{"success":0, "msg": "This email is already registered"}';
//            var_dump($this -> db -> errorInfo());
            return $sts;
        }
    }
    
    function genratePassword($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }

}
