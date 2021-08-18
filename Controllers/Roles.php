<?php
class Roles extends Controllers implements Crud{
    public function __construct()
    {
        parent::__construct();
    }
    //Controlador para crear la vista 
    public function roles(){
        $data['page_id'] = 3;
        $data['page_tag'] = "Roles de Usuario";
        $data['page_name'] = "rol_usuario";
        $data['page_title'] = " Roles Usuario <small> Federación </small>";
       $this->views->getView($this,"roles",$data);
    }

    #----------------- seccion ingresos ---------------------#
    /*
    En esta primera seccion se van a establecer las funciones Generales 
    las cuales van a permitir Agregar Acciones, Obtener todos los registros,
    Obterner 1 registro y Agregar 1 registro     
    */

    //Funcion para agregar los botones a la tabla 
    public function addAcciones($arrData){
        for ($i=0; $i < count($arrData); $i++) { 
            //Validacion del estado del registro para mostrar el nombre en la tabla 
            $arrData = $this->changeEtiquetas($i,$arrData);
            //Accion para agregar los botones de accion a los registros de la tabla para poder ser utilizados. 
            $arrData[$i]['options']='<div class="text-center">
            <button class="btn btn-secondary btn-sm btnPermisosRol" rl="'.$arrData[$i]['id_rol'].'" title="Permisos"><i class="fas fa-key"></i> </button>
            <button class="btn btn-info btn-sm btnEditRol" rl="'.$arrData[$i]['id_rol'].'" title="Editar"><i class="fas fa-edit"></i> </button>
            <button class="btn btn-danger btn-sm btnDelRol" rl="'.$arrData[$i]['id_rol'].'" title="Eliminar"><i class="fas fa-trash-alt"></i> </button>            
            </div>';
        }
        return $arrData;
    }

    //Funcion de prueba para tutoria 
    public function tutoria()
    {
        echo "funcion de prueba ";
    }

    //Funcion para Consultar un Rol Unico 
    public function getIndividual($id_rol)
    {
        //Convertimos lo que se recibe en un entero y se limpia 
        $intIdRol = intval((strClean($id_rol)));
        //Validamos si la variable es mayor a 0 y sera un ID valido 
        if($intIdRol > 0){
            //Se arma un arreglo para recibir los datos del rol 
            $arrData = $this->model->selectRol($intIdRol);
            //Se llama a la funcion para que agregue la respuesta
            $arrResponse = $this->addRespuesta($arrData);
            //se transforma el arreglo en un formato JSON para que se pueda manipular por AJAX
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //Funcion para Consultar todos los ROLES
    public function getAll()
    {
        //Asignacion del los datos obtenidos 
        $arrData = $this->model->selectRoles();
        //Recorrido del array de datos recibidos de la base de datos. 
        $arrData = $this->addAcciones($arrData);
        //Impresion de los datos en formato JSON y mostrar en la tabla
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    //Funcion para Agregar un nuevo RoL
    public function setRegistro(){
        $intId_Rol = intval($_POST['id_rol']);
        $strRol = strClean($_POST['txtNombre']);
        $strDescripcion = strClean($_POST['txtDescripcion']);
        $intStatus = intval($_POST['listStatus']);
        //Llamado al metodo insertar rol del modelo 
        $request_rol = $this->model->insertRol($strRol,$strDescripcion,$intStatus);
        //validacion de la respuesta obtenida
        $arrResponse = $this->respuestasOperaciones($request_rol,$intId_Rol);
        //Impresion de los datos en formato JSON y mostrar en la tabla
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    //Funcion para editar un Rol
    public function editRegistro(){
        $intId_Rol = intval($_POST['id_rol']);
        $strRol = strClean($_POST['txtNombre']);
        $strDescripcion = strClean($_POST['txtDescripcion']);
        $intStatus = intval($_POST['listStatus']);
        //Llamado al metodo insertar rol del modelo 
        $request_rol = $this->model->updateRol($intId_Rol, $strRol,$strDescripcion,$intStatus);
        //validacion de la respuesta obtenida
        $arrResponse = $this->respuestasOperaciones($request_rol,$intId_Rol);
        //Impresion de los datos en formato JSON y mostrar en la tabla
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    //Funcion para Eliminar un ROL 
    public function delRegistro(){
        if($_POST){
            $intId_Rol = intval($_POST['id_rol']);
            $request_Delete = $this->model->deleteRol($intId_Rol);
            $arrResponse = $this->respuestaArrayDel($request_Delete);
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    #----------------- seccion funciones de validacion ---------------------#
    /*
    Estas funciones sirven para cumplir con los principios SOLID de segmentacion de operaciones 
    por funciones. 
    */
    //Funcion de Respuestas a las operacione de Insertar y Actualizar 
    public function respuestasOperaciones($request_rol, $tipoOperacion)
    {
        if($request_rol > 0){
            //mensaje si la respuesta es positiva 
            if($tipoOperacion == 0){
                $arrResponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente');
            }else{
                $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados Correctamente');
            }
        }else if($request_rol == 'exist'){
            //Mensaje si el rol es igual a otro 
            $arrResponse = array('status' => false, 'msg' => '¡Atención el Rol ya Existe!');
        }else{       
            //Mensaje de fallo 
            $arrResponse = array('status' => true, 'msg' => 'No es Posible Almcenar los Datos');
        }
        return $arrResponse; 
    }

    //Funcion para cambiar el valor de Status por un mensaje 
    public function changeEtiquetas($i, $arrData){
        if($arrData[$i]['status']==1){
            $arrData[$i]['status']= '<span class="badge badge-success">Activo</span>';
        }else{
            $arrData[$i]['status']= '<span class="badge badge-danger">Inactivo</span>';
        }
        return $arrData;
    }
   
    //Funcion para la respuesta del query de consulta general
    public function addRespuesta($arrData)
    {
        if(empty($arrData)){
            $arrResponse = array('status' => false, 'msg' => 'Datos no Encontrados.');
        }else{
            $arrResponse = array('status' => true, 'data' => $arrData);
        }
        return $arrResponse;
    }
   
    //Funcion para la respuesta de esta1do de Eliminacion 
    public function respuestaArrayDel($request_Delete){
        if($request_Delete == 'ok'){
            $arrResponse = array('status' => true, 'msg' => 'Se ha Eliminado el ROL.');
        }else  if($request_Delete == 'exist'){
            $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol Asociado a Usuarios.');
        }else{
            $arrResponse = array('status' => false, 'msg' => 'Error al Eliminar el Rol.');
        }
        return $arrResponse;
    }
}
?>