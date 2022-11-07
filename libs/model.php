<?php 

include_once 'libs/imodel.php';
class Model{
        function __construct(){
            $this->db = new DB();
            error_log('Model::Construct->load Dadabase ');

        }

        function query($query){
            return  $this->db->conexion()->query($query); 
        }
        function prepare($query){
            return  $this->db->conexion()->prepare($query); 
        }



}

?>