<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ../index');
            exit();
        }
    }
    
    public function index() {
        require  EMP_MODULE. '/models/global_model.php';
          $this->view->user_details = (new Global_model()) -> getUserDetails($_SESSION['loggedIn']);
          $this->view->all_user_details = (new Global_model()) -> getAllUserDetails();
          $this->view->emp_per_details = (new Global_model()) -> getEmpPerDetails($_SESSION['loggedIn']);
          $this->view->all_user_details = (new Global_model()) -> getAllUserDetails();
          $this->view->all_user_details = (new Global_model()) -> getAllUserDetails();
          $this->view->chosen_hldys = (new Global_model())-> get_chosen_hldys();
          $this->view->get_hldys = (new Global_model()) -> get_hldys();
          
          require  EMP_MODULE. '/models/home_model.php';
          $this->view->getLeavesDeatils =  (new Home_model()) -> getLeavesDeatils($_SESSION['loggedIn']);
          $this->view->getLeavesDeatilsByHr =  (new Home_model()) -> getLeavesDeatilsByHr($_SESSION['loggedIn']);
          
          require CUST_MODULE. '/models/tickets_model.php';
          $this -> view -> tickets_notfcn =  (new Tickets_model()) -> asgndTckts();   
          
          $this->view->render('home/index', EMP_MODULE);
    }
public function logout(){
    Session::destroy();
    header('location: ../index');
    exit();
}

// @new Employee Register
public function register(){
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> new_emp();
    }
 else {
    header("Location: error");    
    }
}

// @Genarte payslip
public function pdf(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> mpdf($_SESSION['loggedIn']);
}

// @selected month due employess list
public function due_deatils(){
    require EMP_MODULE. '/models/home_model.php';
    echo json_encode((new Home_model()) -> paid_deatils($_SESSION['loggedIn']));
}

// @posting new update 
public function postupdate(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> updates();
}

// @get new updates wich not seen by the emp
public function getupdates(){
    require EMP_MODULE. '/models/home_model.php';
         echo json_encode((new Home_model()) -> get_new_update());
}  
 
public function empdocs(){
    require EMP_MODULE. '/models/home_model.php';
         echo (new Home_model()) -> empdocs();
}
     
// @genrating bankstaement for selected employess for submiting bank     
public function bank_statement(){
    require EMP_MODULE. '/models/home_model.php';
    echo json_encode((new Home_model()) -> bank_statement_model());
}


public function get_statements(){
    require EMP_MODULE. '/models/home_model.php';
    echo json_encode((new Home_model()) -> get_statements());
}

// @profile pic uploading
public function profile_pic(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> profile_pic($_SESSION['loggedIn']);
}

// @setting user level this is a HR privilage
public function set_user_lvl(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> set_user_lvl();
}

// @chaning user password this is a HR privilage
public function change_pwd(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> change_pwd();
}

// @get birthdays list by every day
public function get_bdys(){
    require EMP_MODULE. '/models/home_model.php';
    echo json_encode((new Home_model()) -> get_bdys());
}

// @edit employee details emp privilages
public function edit_emp(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> edit_emp();
}

// @update notification close stataus updated in database 
public function updtae_close() {
    require EMP_MODULE. '/models/home_model.php';
    echo  $this->model->updtae_close();
}

// @leaves notification close status updated in database 
// for only MANAGER and HR
public function leaves_alert_close() {
    require EMP_MODULE. '/models/home_model.php';
    echo  (new Home_model()) -> leaves_alert_close();
}

// @birthday notification close status updated in database 
public function bdy_alert_close() {
    require EMP_MODULE. '/models/home_model.php';
    echo  (new Home_model()) -> bdy_alert_close();
}

// @get selected holidays for this year by emp
public function selctd_hldys(){
    require EMP_MODULE. '/models/home_model.php';
        echo  (new Home_model()) -> emp_ofcl_hldys();
    }
    
 // @getting basic info of all employes sort by department (employees directoy)    
public function get_directory_list(){
    require EMP_MODULE. '/models/home_model.php';
        echo  json_encode((new Home_model()) -> get_directory_list());
}

// @cancel pay_slip if bank not approved the statement or another case 
public function cancel_payslip(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> cancel_payslip_model();
}

// @revert back the pay after compleete the salriey process
public function revert(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> revert_back();
}

// @ Selected employes details export to XL after compleeting satement genrating process 
public function export(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> export_xl();
}

// @downloading employee documents privilage only HR
public function file_dwnld(){
    require EMP_MODULE. '/models/home_model.php';
    echo (new Home_model()) -> file_download();
}

public function srch(){
    require EMP_MODULE. '/models/home_model.php';
    echo json_encode((new Home_model()) -> search());
}
public function get_levs_srch(){
    require EMP_MODULE. '/models/home_model.php';
    echo json_encode((new Home_model()) -> levs_by_srch());
}
public function get_hldy_usr(){
    require EMP_MODULE. '/models/home_model.php';
  echo json_encode((new Home_model()) -> user_hlday());  
}
}
