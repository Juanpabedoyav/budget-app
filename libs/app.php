<?php 

class App{

    function __construct(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
    

        if(empty($url[0])){
            error_log('APP::construct-> Dont exist controller load automatic login');
            $fileController = "controllers/login.php";
            require_once $fileController ;
            $controllerLogin = new Login();
            $controllerLogin->loadModel('login');
            $controllerLogin->render();
            return false;
        }
        $fileController = "controllers/". $url[0] . ".php";
            
        if(file_exists($fileController)){
            error_log('APP::construct->exist controller load '.$fileController);

          require_once $fileController;
           $controller = new $url[0];
          $controller->loadModel($url[0]);

            if(isset($url[1])){
                if(method_exists($controller, $url[1])){
                            if(isset($url[2])){
                                $nParam = sizeof($url) - 2;
                                $params = [];
                                for ($i=0; $i < $nParam ; $i++) { 
                                    array_push($nParam, $url[$i + 2]);
                                }
                                $controller->{$url[1]}($params);
                                error_log('APP::construct-> start methods more than two params after the controller');
                            
                            }else{
                                error_log('APP::construct-> start methods only one params after the controller');
                                $controller->{$url[1]}();
                            }
                }else{
                    $controller = new Errores();
                //errros 404 page
                }

            }else{
                error_log('APP::construct->dont exist method');
                $controller->render();
            }




        }else{
          //  $controller = new Errores();
                //errros 404 page
        }
    }



}

?>