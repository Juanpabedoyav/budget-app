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

        function existPost($params){
            foreach ($params as $param) {
                if(!isset($_POST[$param])){
                    error_log('CONTROLLER:: existPost => dont exist' . $param);
                    return false;
                }
            }
            return true;
        }
        
        function existGet($params){
            foreach ($params as $param) {
                if(!isset($GET[$param])){
                    error_log('CONTROLLER:: existGet =>  dont exist' . $param);
                    return false;
                }
            }
            return true;
        }
        
        function getGet($name){
            return $_GET[$name];
        }
  
        function getPost($name){
            return $_POST[$name];
        }

        function redirect($route, $mensajes){
            $data = [];
            $params = '';
            foreach ($mensajes as $key => $mensaje) {
                array_push($data, $key. '='. $mensaje);
            }
            $params = join('&', $data);
            if($params !== ''){
                $params = '?' . $params;
            }
        
            header('Location: ' . constant('URL') . '/'.$route . $params);
        }







}


?>