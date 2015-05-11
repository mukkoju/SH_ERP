<?php

class Model {

    function __construct() {
       $this -> db = new PDO('mysql:host=localhost;dbname=SH_ERP', 'root', 'vivenfarms');
    }

}