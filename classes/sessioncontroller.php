<?php 
require 'classes/session.php';
require_once 'models/usermodel.php';

class SessionController extends Controller{

        private $userSession;
        private $username;
        private $userid;
        
        private $session;
        private $sites;

        private $user;


        function __construc(){
            parent:: __construc();
            $this->init();
        }

        function init(){
            $this->session = new Session();

            $json = $this->getJSONFileConfig();
            $this->sites = $json['sites'];
            $this->defaultSites = $json['default-sites'];
            
            $this->validateSession();
        }

        public function getUserSession(){
            return $this->userSession;
        }
    
        public function getUsername(){
            return $this->username;
        }
    
        public function getUserId(){
            return $this->userid;
        }
        private function getJSONFileConfig(){
            $string = file_get_contents('config/access.json');
            $json = json_decode($string, true);
        error_log('SESSIONCONTROLLER:: getJSONFileConfig => access' . $json);
                return $json;
        }


        public function validateSession(){
        error_log('SESSIONCONTROLLER:: validateSession' );
            // si la session existe
            if($this->existsSession()){
                $role = $this->getUserSessionData()->getRole();
             // Is a public session ?
                if($this->isPublic()){
                        $this->redirectDefaultSiteByRole($role);

                }else{
                    if($this->isAuthorized($role)){

                    }else{
                        $this->redirectDefaultSiteByRole($role);

                    }
                }
            }else{
                if($this->isPublic()){

                }else{
                    header('Location: ' . constant('URL') . '');
                    // don't exists session

                }

            }
        }

        public function existsSession(){
            if(!$this->session->exists()) return  false;
            if($this->session->getCurrentUser() === NULL) return  false;

          $userid = $this->session->getCurrentUser();
            if($userid) return true;

            return false;
        
        }

        public function getUserSessionData(){
            $id = $this->session->getCurrentUser();
             $this->user = new UserModel();
             $this->user->get($id);
             error_log('SESSIONCONTROLLER:: getUserSessionData' . $this->user->getUsename());
            return $this->user;

        }


        function isPublic(){
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/",'', $currentURL);

            for ($i=0; $i < sizeof($this->sites); $i++) {
                 if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){

                return true;
                 }

            }
            return false;
        }

        function getCurrentPage(){
            $actualLink = trim("$_SERVER[REQUEST_URI]");
            $url = explode('/', $actualLink);
            error_log('SESSIONCONTROLLER:: getCurrentPage' .  $url[2]);

            return $url[2];


        }

    private function  redirectDefaultSiteByRole($role){
        $url = '';
        for ($i=0; $i < sizeof($this->sites); $i++) {
            if($this->sites[$i]['role'] === $role){
                $url = '/expenses/' . $this->sites[$i]['site'];
                break;
            }
        }
        header('location:' . constant('URL'). $url);
    }
    private function isAuthorized($role){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/",'', $currentURL);

        for ($i=0; $i < sizeof($this->sites); $i++) {
             if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){

            return true;
             }

        }
        return false;

    }

    public function initialize($user){
        error_log("sessionController::initialize(): user: " . $user->getUsername());
        $this->session->setCurrentUser($user->getId());
        $this->authorizeAccess($user->getRole());
    }


    function authorizeAccess($role){
            switch($role){
                    case 'user':
                        $this->redirect($this->defaultSites['user'], []);

                    break;
                    case 'admin':
                        $this->redirect($this->defaultSites['admin'], []);

                    break;

            }
    }

    function logout(){
        $this->session->closeSession();
    }

}

?>