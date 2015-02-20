<?php

class Model {

    function __construct() {
       $this -> db = new PDO('mysql:host=localhost;dbname=G_dmp', 'root', 'dambo');
    }

}