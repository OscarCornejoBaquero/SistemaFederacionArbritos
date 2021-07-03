<?php
    class RolesModel extends Mysql{
        public function __construct()
        {
           parent::__construct();
        }
        //Metodo para consultar todos los roles 
        public function selectRoles()
         {
             //creacion del query para solicitar los datos
             $sql = "SELECT * FROM rol WHERE status !=0";
             //Llamado al metodo select_all donde se ejecuta la consulta a la base de datos 
             //en la clase Mysql 
             $request = $this->select_all($sql);
             return $request;
         }
         //Metodo para consultar un rol 
         public function selectRol(int $id_rol)
         {
             //creacion del query para solicitar los datos
             $sql = "SELECT * FROM rol WHERE id_rol = $id_rol";
             //Llamado al metodo select donde se ejecuta la consulta a la base de datos 
             //en la clase Mysql 
             $request = $this->select($sql);
             return $request;
         }
         //Metodo para insertar un rol individual 
         public function insertRol(string $rol, string $descripcion, int $status)
         {
             $return ="";
             //creacion del query para validar si el rol existe o no 
             $sql = "SELECT * FROM rol WHERE nombre_rol = '$rol'";
             $request = $this->select_all($sql);
             //Si el rol no existe la variable request estara vacia 
             if(empty($request)){
                 //Creacion del query para ingresar los datos 
                 $query_insert= "INSERT INTO rol(nombre_rol,descripcion_rol,status) VALUES (?,?,?)";
                 //Asignacion de los datos al array para su ingreso 
                 $arrData = array($rol,$descripcion,$status);
                 //Llamado al metodo insert enviando el query y los datos 
                 $request_insert = $this->insert($query_insert,$arrData);
                 //se regrese al valor obtenido por el insert 
                 $return = $request_insert;
             }else{
                 //Enviar el mensaje exist para que s emuestre el mdoal de existe el rol 
                 $return = "exist";
             }
             return $return;
         }
    }
?>