<?php 

class Tickets extends Controller{
    
    function __construct() {
        parent::__construct();
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
            $this -> view -> get_tickets = (new Tickets_model()) -> getTickets();
            $this->view->render('tickets/index', CUST_MODULE);
    }
    
    public function view($tckt_id){
            require EMP_MODULE. '/models/global_model.php';
            $this->view->user_details = (new Global_model()) -> getUserDetails($_SESSION['loggedIn']);
            $this->view->all_user_details = (new Global_model()) -> getAllUserDetails();
            $this->view->get_hldys = (new Global_model()) -> get_hldys();
            $this->view->chosen_hldys = (new Global_model()) -> get_chosen_hldys();
            require CUST_MODULE. '/models/tickets_model.php';
            $this->view->viewTicket = (new Tickets_model()) -> viewTicket($tckt_id);
            $this-> view -> render('ticket_view/index', CUST_MODULE);
    }
    
    // @update ticket ttl or desc or catgoy or assignee
    public function updt(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
        require CUST_MODULE. '/models/tickets_model.php';
         echo (new Tickets_model()) -> updtTicket();
        }else {
            header("Location: /error");
        }
    }
    
}


?>