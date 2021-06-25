<?php
    //Se crea un clase que abre la conexión mediante PDO y se asignan los datos del usuario de la base de datos y el nombre
    class Conecta{
        private $server = "mysql:host=localhost;dbname=contactos";
        private $username = "root";
        private $password = '';
        private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        public $conn;
        //Permite abrir la conexión
        public function open(){
            try{
                $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
                return $this->conn;
                echo "Satisfactorio";
            }catch(PDOException $e){
                echo "Ocurrió un error PDO en la conexión". $e->getMessage();
            }
        }
        //Cierra la conexión
        public function close(){
            $this->conn = null;
        }
    }
?>