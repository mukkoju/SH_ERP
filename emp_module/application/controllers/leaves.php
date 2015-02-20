<?php

class Leaves extends Controller {

    function __construct() {
        parent::__construct();
        // saessions area
//        Session::init();
        $logged = Session::get('loggedIn');

        if ($logged == false) {
            Session::destroy();
            header('location: ../index');
            exit();
        }
    }
  
    public function index(){
        require EMP_MODULE. '/models/global_model.php';
        $this->view->user_details = (new Global_model()) -> getUserDetails($_SESSION['loggedIn']);
        $this->view->emp_per_details = (new Global_model()) -> getEmpPerDetails($_SESSION['loggedIn']);
        $this->view->getTakenLeaves = (new Global_model()) -> getUserLeaves($_SESSION['loggedIn']);
        $this->view->get_hldys = (new Global_model()) -> get_hldys();
        $this->view->chosen_hldys = (new Global_model()) -> get_chosen_hldys();
        $this->view->render('leaves/index', EMP_MODULE);
    }
    
    public function apply(){
        require EMP_MODULE. '/models/leaves_model.php';
        echo (new Leaves_model()) -> leaves_apply();
        
    }
    
    public function hr_approve(){
    require EMP_MODULE. '/models/leaves_model.php';
        echo (new Leaves_model()) -> approve();
    }
    public function hr_reject(){
    require EMP_MODULE. '/models/leaves_model.php';
        echo (new Leaves_model()) -> reject();
    }
    
    public function manger_status(){
    require EMP_MODULE. '/models/leaves_model.php';
        echo (new Leaves_model()) -> manger_status();   
    }
    
    
    
}