<?php 

class Login extends Controller{
    function __construct(){
      parent::__construct();
      error_log('Login::construct-> start login');
    }

    function render(){
      error_log('Login::render -> Loading login index ');
      $this->view->render('login/index');
    }
}  

?>