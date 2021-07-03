<?php

class Conexion{
    private PDO $conect;

    public function __construct()
    {
        $connectionString = "mysql:host=".DB_SERVIDOR.";dbname=".DB_BASE_DATOS.";.DB_CHARSET.";
        try {
            //code... 
            $this->conect = new PDO($connectionString, DB_USUARIO, DB_PASSWORD);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            //throw $th;
            $this->conect = 'Error de conexión';
            echo "ERROR: ". $e->getMessage();
        }
    }
    public function conect(){
        return $this->conect;
    }
}
?>