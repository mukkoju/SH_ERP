<?php

class View {

    function __construct() {
        
    }

    public function render($file_name, $module, $request) {
        if($file_name === 'index/index'){
            require $module . '/views/' . $file_name . '.php';
        }
        
        else if($file_name === 'error/index'){
            require $module . '/views/' . $file_name . '.php';
        }
        
        else{
            if($request === 'notajax'){
	require EMP_MODULE. '/layout/header.php';
            }
        require $module . '/views/' . $file_name . '.php';
        if($request === 'notajax'){
	require EMP_MODULE. '/layout/footer.php';
        }
        }
    }

}
