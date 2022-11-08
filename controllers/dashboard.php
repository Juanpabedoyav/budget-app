<?php

class Dashboard extends Controller{

    function __construct(){
        parent::__construct();
    error_log('Dashboard::construnct-> start Dashboard');
    }

    function render(){
       
         error_log('Dashboard::render-> start render Dashboard ');
       
        $this->view->render('dashboard/index');
    }

  

}

?>