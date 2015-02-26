<?php
class Customer_ticket extends Controller{
    
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
            $this -> view -> tickets_notfcn =  (new Tickets_model()) -> asgndTckts();
            $this->view->render('customer_ticket/index', CUST_MODULE);
    }
    // @adding new ticket
    public function addTicket(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
        require CUST_MODULE. '/models/customer_ticket_model.php';
        echo json_encode((new Customer_ticket_model()) -> addTicketEntry());
        }
        else {
            header("Location: /error");
        }
    }
    
    // @managers listing for asign managers
    public function gtassingees(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
        require CUST_MODULE. '/models/customer_ticket_model.php';
        echo json_encode((new Customer_ticket_model()) -> getAssinegees());
        }
        else {
            header("Location: /error");
        }
        
    }
    }
?>
