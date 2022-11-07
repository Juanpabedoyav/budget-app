<?php 

class ErrorMessages{
 //ERROR_CONTroller_methOD_ACTION
    const ERROR_ADMIN_NEWCATEGORY_EXIST = '202cb962ac59075b964b07152d234b70';
    const ERROR_SIGNUP_NEWUSER = '3a3f958cc901152633d9117f908c03cd';
    const ERROR_SIGNUP_NEWUSER_EMPTY = 'aa6ecd289609bd0120bddded2ad9c33f';
    const ERROR_SIGNUP_NEWUSER_EXIST = 'f9dceafabc63486331cc418cb9e49680';
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = 'f4c50efef916a0f4a51bc35eca80baff';
    const ERROR_LOGIN_AUTHENTICATE_DATA = '2bfc3390ec2c90600f2910527f21091d'; 
    const ERROR_LOGIN_AUTHENTICATE = 'd4e970f0da1539ab5c953dc97d7a8bdd'; 

    private $errorList = [];

    function __construct(){
       $this->errorList = [
            ErrorMessages:: ERROR_ADMIN_NEWCATEGORY_EXIST => 'El nombre de la categoria ya existe',
            ErrorMessages:: ERROR_SIGNUP_NEWUSER => 'Hubo un error al intentar procesar la solicitud',
            ErrorMessages:: ERROR_SIGNUP_NEWUSER_EMPTY => 'Llena los campos de usuario y/o password',
            ErrorMessages :: ERROR_SIGNUP_NEWUSER_EXIST => 'El usuario ya existe',
            ErrorMessages :: ERROR_LOGIN_AUTHENTICATE_EMPTY => 'Llena los campos de usuario y/o password',
            ErrorMessages :: ERROR_LOGIN_AUTHENTICATE_DATA => 'Nombre de usuario y/o password incorrecto',
            ErrorMessages :: ERROR_LOGIN_AUTHENTICATE => 'No se puede procesar la solicitud. Ingresa usuario y password',

        ];
   
    }

    public function get($hash){
        return $this->errorList[$hash];
    }

public function existKey($key){

    if(array_key_exists($key, $this->errorList)){
     return true; 
    }else{ 
    return false;
    }

    }


}
?>