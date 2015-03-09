<?php

class Salaries extends Controller{
    function __construct() {
        parent::__construct();
        // sessions area
//        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ../index');
            exit();
        }
//        if($_SESSION['loggedIn'] !== HR){
//            header('location: ../error');
//            return;
//        }
    }
    public function index(){
        require EMP_MODULE. '/models/global_model.php';
        $this->view->all_user_details = (new Global_model()) -> getAllUserDetails();
        $this->view->user_details = (new Global_model()) -> getUserDetails($_SESSION['loggedIn']);
        $this->view->get_hldys = (new Global_model()) -> get_hldys();
        $this->view->chosen_hldys = (new Global_model()) -> get_chosen_hldys();
        require CUST_MODULE. '/models/tickets_model.php';
        $this -> view -> tickets_notfcn =  (new Tickets_model()) -> asgndTckts();
        if($_SESSION['loggedInLevel'] == 2 || $_SESSION['loggedInLevel'] == 0){
        header('location: ../error');
            return;
    }
    // @Checking url come form ajax or not
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
        $this->view->render('salaries/index', HR_MODULE, 'ajax');
    }else{
        $this->view->render('salaries/index', HR_MODULE, 'notajax');
    }
    }
}

?>