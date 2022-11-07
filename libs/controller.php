<?php 

class Controller{
        function __construct(){
            $this->view = new View();

        }

        function loadModel($model){
            $url = 'models/' . $model .'model.php';

            if(file_exists($url)){
                require_once $url;
                error_log('Controller::loadModel->loadModel '.$url);
                $ModelName = $model.'Model';
                $this->model = new $ModelName();
            }

        }
      
}


?>