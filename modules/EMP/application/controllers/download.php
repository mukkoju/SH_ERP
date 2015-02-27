<?php

  class Download extends Controller {

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
        $this->view->get_slips = (new Global_model()) -> getPaySlips($_SESSION['loggedIn']);
        $this->view->get_hldys = (new Global_model()) -> get_hldys();
        $this->view->chosen_hldys = (new Global_model()) -> get_chosen_hldys();
        require CUST_MODULE. '/models/tickets_model.php';
        $this -> view -> tickets_notfcn =  (new Tickets_model()) -> asgndTckts();
        $this->view->render('download/index', EMP_MODULE);
    }
    
    // @downloadling employee payslips by employee
    public function down_slips($file_name){
        $folder_name =  Session::get('loggedIn');
        $file_path= APP_PATH."/uploads/$folder_name/" .$file_name;
        echo "$file_path";
        require EMP_MODULE. '/models/download_model.php';
        (new Download()) -> down_slips($file_path, $file_name, "image/png");
//        $this->view->render('download/index');
    }
    // @downloadling bank statements by hr
    public function down_staments($file_name){
        $folder_name =  Session::get('loggedIn');
        $file_path= APP_PATH."/uploads/$folder_name/Bank_statments/" .$file_name;
//        echo "$file_path";
        require EMP_MODULE. '/models/download_model.php';
        (new Download_model()) -> down_slips($file_path, $file_name, "image/png");
        $this->view->render('download/index');
    }
    // @downloadling employee documents by hr
    public function down_docs($file_name){
        $filename = explode("&", $file_name);
        $folder_name =  Session::get('loggedIn');
        $file_path= APP_PATH."uploads/".$filename[0]."/docs/".$filename[1];
        echo "$file_path";
        require EMP_MODULE. '/models/download_model.php';
        (new Download()) -> down_docs($file_path, $filename[1], "image/png");
        $this->view->render('download/index');
    }
    
    
}