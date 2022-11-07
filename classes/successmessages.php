<?php 


class SuccessMessages{
    const SUCCESS_ADMIN_NEWCATEGORY_EXIST = '236ba46e8d55889af2cf6901cd34ed26';
    const SUCCESS_SINGUP_NEWUSER = 'dfdfsfasdfdsaf78988998978fasdfasdfasd'; 

    private $successList = [];
    function __construct(){
        $this->successList = [
            successMessages:: SUCCESS_ADMIN_NEWCATEGORY_EXIST => 'El nombre de la categoria ya existe',
            successMessages:: SUCCESS_SINGUP_NEWUSER => 'Nuevo usuario Registrado',

       ];
   
   
    }
    public function get($hash){ 
        return $this->successList[$hash];
    }

    }



}





?>