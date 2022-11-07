<?php 

    class DB{
        private $host;
        private $user;
        private $password;
        private $db;
        private $charset;

        public function __construct(){
            $this->host = constant('HOST');
            $this->user = constant('USER');
            $this->password = constant('PASSWORD');
            $this->db = constant('DB');
            $this->charset = constant('CHARSET');
        }

        public function conexion(){  
            try{
                $conection = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
                //echo $conection ==='mysql:host=localhost;dbname=encuesta';
                $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false];          
                $pdo = new PDO($conection, $this->user, $this->password, $options);
                return $pdo;
                error_log('conexion succesfull');
            }catch(PDOException $e){
                print_r("Error connection" . $e->getMessage());
            }

        }
    }





?>