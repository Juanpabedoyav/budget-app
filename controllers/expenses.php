<?php 
class Expenses extends Controller{
        private $user;

        function __construct(){
            parent:: __construct();
        }

        function render(){
            $this->view->render('expenses/index');
        }

}


?>