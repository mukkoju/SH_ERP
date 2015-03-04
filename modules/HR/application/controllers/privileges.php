<?php

class Privileges extends Controller {

    function __construct() {
        parent::__construct();
        
//        Session::init();
        $logged = Session::get('loggedIn');

        if ($logged == false) {
            Session::destroy();
            header('location: ../index');
            exit();
        }
     // echo "profile page";   
    }
    
public function index(){
    require EMP_MODULE. '/models/global_model.php';
    $this->view->user_details = (new Global_model()) -> getUserDetails($_SESSION['loggedIn']);
    $this->view->get_hldys = (new Global_model()) -> get_hldys();
    $this->view->chosen_hldys = (new Global_model()) -> get_chosen_hldys();
    
    require CUST_MODULE. '/models/tickets_model.php';
    $this -> view -> tickets_notfcn =  (new Tickets_model()) -> asgndTckts();
    if($_SESSION['loggedInLevel'] == 2 || $_SESSION['loggedInLevel'] == 0){
        header('location: ../error');
            return;
    }
    $this->view->render('privileges/index', HR_MODULE);
}

        
}