<?php


class View{
    function __construct(){

    }

    function render($name , $data = []){
         $this->d = $data;
         $this->handleMessages();
        require_once 'views/' .$name. '.php';
    }

   

}

?>