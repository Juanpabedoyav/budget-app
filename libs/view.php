<?php


class View{
    function __construct(){

    }

    function render($name , $data = []){
         $this->d = $data;
        require_once 'views/' .$name. '.php';
    }

    public function handleMessages(){
        if(isset($_GET['success']) && isset($_GET['error'])){

        }else if(isset($_GET['success'])){
            $this->handleSuccess();

        }else if(isset($_GET['error'])){
            $this->handleError();

        }
    }
    public function handleSuccess(){
        $hash = $_GET['success'];
        $success = new SuccessMessages();
            if($success->existKey($hash)){
                    $this->d['success'] = $success->get($hash);
            }
    }
    public function handleError(){
        $hash = $_GET['error'];
        $error = new ErrorMessages();
            if($error->existKey($hash)){
                    $this->d['error'] = $error->get($hash);

            }
    }
    public function showMessages(){
        $this->showErrors();
        $this->showSuccess();
    }
    
    public function showErrors(){
        if(array_key_exists('error', $this->d)){
          echo '<div class= "error">' . $this->d['error'] .'</div>' ;
        }
    }
  
    public function showSuccess(){
         if(array_key_exists('success', $this->d)){
             echo '<div class= "success">' . $this->d['success'] .'</div>' ;
           }
    }
}

?>