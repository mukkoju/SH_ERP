<?php //

 class Bootstrap {

    function __construct() {
        $url = strtolower(trim($_SERVER['REQUEST_URI'], '/'));
        $url = explode('/', $url);

        if (empty($url[0]) || $url[0] === 'index') {
            require EMP_MODULE . '/controllers/index.php';
            (new Index())->index(EMP_MODULE);
        } else {
            
            if ($url[0] === 'home') {
                require EMP_MODULE . '/controllers/home.php';
                
                switch ($url[1]) {
                    case 'index':
                        (new Home())->index();
                        break;
                    case 'register':
                        (new Home())->register();
                        break;
                    case 'pdf':
                        (new Home())->pdf();
                        break;
                    case 'due_deatils':
                        (new Home())->due_deatils();
                        break;
                    case 'postupdate':
                        (new Home())->postupdate();
                        break;
                    case 'getupdates':
                        (new Home())->getupdates();
                        break;
                    case 'empdocs':
                        (new Home())->empdocs();
                        break;
                    case 'bank_statement':
                        (new Home())->bank_statement();
                        break;
                    case 'get_statements':
                        (new Home())->get_statements();
                        break;
                    case 'profile_pic':
                        (new Home())->profile_pic();
                        break;
                    case 'set_user_lvl':
                        (new Home())->set_user_lvl();
                        break;
                    case 'change_pwd':
                        (new Home())->change_pwd();
                        break;
                    case 'get_bdys':
                        (new Home())->get_bdys();
                        break;
                    case 'edit_emp':
                        (new Home())->edit_emp();
                        break;
                    case 'updtae_close':
                        (new Home())->updtae_close();
                        break;
                    case 'leaves_alert_close':
                        (new Home())->leaves_alert_close();
                        break;
                    case 'bdy_alert_close':
                        (new Home())->bdy_alert_close();
                        break;
                    case 'selctd_hldys':
                        (new Home())->selctd_hldys();
                        break;
                    case 'get_directory_list':
                        (new Home())->get_directory_list();
                        break;
                    case 'cancel_payslip':
                        (new Home())->cancel_payslip();
                        break;
                    case 'revert':
                        (new Home())->revert();
                        break;
                    case 'export':
                        (new Home())->export();
                        break;
                    case 'file_dwnld':
                        (new Home())->file_dwnld();
                        break;
                    case 'srch':
                        (new Home())->srch();
                        break;
                    case 'get_levs_srch':
                        (new Home())->get_levs_srch();
                        break;
                    case 'get_hldy_usr':
                        (new Home())->get_hldy_usr();
                        break;   
                    default:
                        (new Home())->index();
                }
            }
            else if($url[0] === 'download'){
                require EMP_MODULE . '/controllers/download.php';
                switch ($url[1]){
                case 'down_staments':
                        (new Download()) -> down_staments($url[2]);
                        break;
                    case 'down_slips':
                        (new Home()) -> down_slips($url[2]);
                        break;
                    case 'down_docs':
                        (new Download())-> down_docs($url[2]);
                        break;
                    case 'index':
                        (new Download())->index();
                        break;
                default:
                        (new Download())->index();
                }
            }
            else if($url[0] === 'leaves'){
                require EMP_MODULE . '/controllers/leaves.php';
                
                switch ($url[1]){
                    case 'index':
                        (new Leaves()) ->index();
                        break;
                    case 'apply':
                        (new Leaves()) -> apply();
                        break;
                    case 'hr_approve':
                        (new Leaves()) -> hr_approve();
                        break;
                    case 'hr_reject':
                        (new Leaves()) -> hr_reject();
                        break;
                    case 'manger_status':
                        (new Leaves()) -> manger_status();
                        break;
                    default:
                        (new Leaves())->index();    
                }
            }
            else if($url[0] === 'login'){
                require EMP_MODULE . '/controllers/index.php';
                (new Index()) -> login();
            }
            else if($url[0] === 'logout'){
                require EMP_MODULE . '/controllers/home.php';
                (new Home()) -> logout();
            }
            // HR_module routing
            else if($url[0] === 'salaries'){
                require HR_MODULE . '/controllers/salaries.php';
                (new Salaries()) -> index();
            }
            else if($url[0] === 'emp_data'){
                require HR_MODULE . '/controllers/emp_data.php';
                (new Emp_data()) -> index();
            }
            else if($url[0] === 'privileges'){
                require HR_MODULE . '/controllers/privileges.php';
                (new Privileges()) -> index();
            }
            
            // @CUST_module routing
            else if($url[0] === 'customer_ticket'){
                require CUST_MODULE . '/controllers/customer_ticket.php';

                switch ($url[1]){
                    case 'add_ticket':
                       (new Customer_ticket()) -> addTicket();
                        break;
                    case 'gtassingees':
                       (new Customer_ticket()) -> gtassingees();
                        break;
                    default:
                     (new Customer_ticket()) -> index();
    
                }
                }
                else if($url[0] === 'tickets'){
                    require CUST_MODULE . '/controllers/tickets.php';
                    
                    switch ($url[1]){
                        case 'index':
                       (new Tickets()) ->index();
                        break;
                    case 'view':
                       (new Tickets()) -> view($url[2]);
                        break;
                    case 'updt':
                       (new Tickets()) -> updt();
                        break;
                    case 'ntf':
                       (new Tickets()) -> ntf();
                        break;
                    case 'fltr':
                       (new Tickets()) -> fltr();
                        break;
                    case 'lodmre':
                       (new Tickets()) -> lodmre();
                        break;
                    default:
                     (new Tickets()) -> index();
    
                }
                    
                }
            
            else{
                require EMP_MODULE. '/controllers/error.php';
                (new Error());
            }
        }













































//        // Checking url[0] is empty or not
//        if (empty($url[0]) || $url[0] === 'index') {
//            require 'controllers/index.php';
//            $controller = new Index();
//            $controller->index();
//            return false;
//        }
//        // @url[1] is is our controller then requring the controller
//        $file = MODULES. '/'. $url[0] . '/controllers/' . $url[0] . '.php';
//        if (file_exists($file)) {
//            require $file;
//        } else {
//            require 'controllers/error.php';
//            $error = new Error();
//            return false;
//        }
//        $controller = new $url[0];
//        // $controller->index();
//        
//        $controller->loadModel($url[0]);
//        $controller->globalModel();
//        
//        
//
//        if (isset($url[2])) {
//            if (method_exists($controller, $url[1])) {
//                $controller->{($url[1])}($url[2]);
//            } else {
//                echo "errrrrrr";
//            }
//        } else {
//            if (isset($url[1])) {
//                if (method_exists($controller, $url[1])) {
//                    $controller->{($url[1])}();
//                } else {
//                    echo "404 page";
//                }
//            } else {
//                $controller->index();
//                
//            }
//        }
    }
}
