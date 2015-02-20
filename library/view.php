<?php

class View {

    function __construct() {
        
    }

    public function render($file_name, $module) {
        require EMP_MODULE. '/layout/header.php';
        require $module . '/views/' . $file_name . '.php';
        require EMP_MODULE. '/layout/footer.php';
    }

}
