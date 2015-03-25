<?php 

  class Emp_data extends Controller {

      function __construct() {
          parent::__construct();
//          Session::init();
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
            $this->view->all_user_details = (new Global_model()) -> getAllUserDetails();
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
                $this->view->render('emp_data/index', HR_MODULE, 'ajax');
            }else{
                $this->view->render('emp_data/index', HR_MODULE, 'notajax');
            }
        }
        public function mail(){
            $mail = mail("radhasatish143@gmail.com","My subject","hi this is my first mail");
            if($mail == true){
                echo "sucess";
            }  else {
               echo "not send";    
            }
        }
                
}