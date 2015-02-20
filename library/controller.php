<?php
//require_once LIBRARY.'/Mem_cached.php';
class Controller{
    function __construct() {
        $this->view = new View();
     //   echo "main controller";
    }
public function loadModel($name)
{
    $path = MODULES. 'models/' . $name .'_model.php';
    if (file_exists($path)){
        require MODULES. 'models/' . $name . '_model.php';
        $modelName = $name.'_model';
        $this->model = new $modelName();
    }
}
public function globalModel(){
    require MODULES. 'models/global_model.php';
    $this->global = new Global_model();
}

}