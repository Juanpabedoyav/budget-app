<?php 
require_once 'models/usermodel.php';
class Signup extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->render('login/signup', []);

    }

    function newUser(){
        if($this->existPost(['username','password'])){

           $username = $this->getPost('username');
           $password = $this->getPost('password');

           if($username === '' || empty($username) || $password === '' || empty($password)){
                $this->redirect('signup', ['error' => ErrorMessages:: ERROR_SIGNUP_NEWUSER_EMPTY]);
           }
           $user = new UserModel();
           $user->setUsername($username);
           $user->setPassword($password);
           $user->setRole('user');

        if($user->exist($username)){
                 $this->redirect('signup', ['error' => ErrorMessages:: ERROR_SIGNUP_NEWUSER_EXIST]);
        }else if($user->save()){
                $this->redirect('', ['success' => successMessages:: SUCCESS_SINGUP_NEWUSER]);

        }else{
            $this->redirect('signup', ['error' => ErrorMessages:: ERROR_SIGNUP_NEWUSER]);
        }


        }else{
                $this->redirect('signup', ['error' => ErrorMessages:: ERROR_SIGNUP_NEWUSER]);
        }


    }
}


?>