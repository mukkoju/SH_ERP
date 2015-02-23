<?php

class View {

    function __construct() {
        
    }

    public function render($file_name, $module) {
        if($file_name === 'index/index'){
            require $module . '/views/' . $file_name . '.php';
        }
        
        else if($file_name === 'error/index'){
            require $module . '/views/' . $file_name . '.php';
        }
        
        else{
        require EMP_MODULE. '/layout/header.php';
        require $module . '/views/' . $file_name . '.php';
        require EMP_MODULE. '/layout/footer.php';
        }
    }

}
