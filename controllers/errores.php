<?php 

class Errores extends Controller{

    function __construct(){
        parent::__construct();
       error_log('Errores::construct-> 404');
    }
    function render(){
        error_log('Errores::render-> render 404');
        $this->view->render('errores/index');
      }



}
?>