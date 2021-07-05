<?php
class Roles extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }
    //Metodo de Llamada para el controlador 
    //Se asignan nombres base que se puede usar en toda vista
    public function roles(){
        $data['page_id'] = 3;
        $data['page_tag'] = "Roles de Usuario";
        $data['page_name'] = "rol_usuario";
        $data['page_title'] = " Roles Usuario <small> Federación </small>";
       $this->views->getView($this,"roles",$data);
    }
    //Metodo para obtener los roles 
    //Hace un llamado al modelo
    public function getRoles()
    {
        //Asignacion del los datos obtenidos 
        $arrData = $this->model->selectRoles();
        //Recorrido del array de datos recibidos de la base de datos. 
        for ($i=0; $i < count($arrData); $i++) { 
            //Validacion del estado del registro para mostrar el nombre en la tabla 
            if($arrData[$i]['status']==1){
                $arrData[$i]['status']= '<span class="badge badge-success">Activo</span>';
            }else{
                $arrData[$i]['status']= '<span class="badge badge-danger">Inactivo</span>';
            }
            
            //Accion para agregar los botones de accion a los registros de la tabla para poder ser utilizados. 
            $arrData[$i]['options']='<div class="text-center">
            <button class="btn btn-secondary btn-sm btnPermisosRol" rl="'.$arrData[$i]['id_rol'].'" title="Permisos"><i class="fas fa-key"></i> </button>
            <button class="btn btn-info btn-sm btnEditRol" rl="'.$arrData[$i]['id_rol'].'" title="Editar"><i class="fas fa-edit"></i> </button>
            <button class="btn btn-danger btn-sm btnDelRol" rl="'.$arrData[$i]['id_rol'].'" title="Eliminar"><i class="fas fa-trash-alt"></i> </button>            
            </div>';
        }
        //Impresion de los datos en formato JSON y mostrar en la tabla
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    //Se extrae los datos del modelo para la actualizacion del Rol
    public function getRol($id_rol)
    {
        //Convertimos lo que se recibe en un entero y se limpia 
        $intIdRol = intval((strClean($id_rol)));
        //Validamos si la variable es mayor a 0 y sera un ID valido 
        if($intIdRol > 0){
            //Se arma un arreglo para recibir los datos del rol 
            $arrData = $this->model->selectRol($intIdRol);
            //Si la respuesta es vacia se envia un error 
            //Caso contrario se envia el arreglo 
            if(empty($arrData)){
                $arrResponse = array('status' => false, 'msg' => 'Datos no Encontrados.');
            }else{
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            //se transforma el arreglo en un formato JSON para que se pueda manipular por AJAX
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //Hace el llamado al modelo para el ingreso
    public function setRol(){
        //Limpia el texto agregado en los inputs 
        //para eliminar espacios y caracteres no especiales 
        //Se asignan los valores dle metodo POST a variables locales
        $intId_Rol = intval($_POST['id_rol']);
        $strRol = strClean($_POST['txtNombre']);
        $strDescripcion = strClean($_POST['txtDescripcion']);
        $intStatus = intval($_POST['listStatus']);
        //Llamado al metodo insertar rol del modelo 
        $request_rol = $this->model->insertRol($strRol,$strDescripcion,$intStatus);
        
        //validacion de la respuesta obtenida
        if($request_rol > 0){
            //mensaje si la respuesta es positiva 
            $arrResponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente desde el crear');
        }else if($request_rol == 'exist'){
            //Mensaje si el rol es igual a otro 
            $arrResponse = array('status' => false, 'msg' => '¡Atención el Rol ya Existe!');
        }else{       
            //Mensaje de fallo 
            
            $arrResponse = array('status' => true, 'msg' => 'No es Posible Almcenar los Datos');
        }
        //Impresion de los datos en formato JSON y mostrar en la tabla
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editRol(){
        //Limpia el texto agregado en los inputs 
        //para eliminar espacios y caracteres no especiales 
        //Se asignan los valores dle metodo POST a variables locales
        $intId_Rol = intval($_POST['id_rol']);
        $strRol = strClean($_POST['txtNombre']);
        $strDescripcion = strClean($_POST['txtDescripcion']);
        $intStatus = intval($_POST['listStatus']);
        //Llamado al metodo insertar rol del modelo 
        $request_rol = $this->model->updateRol($intId_Rol, $strRol,$strDescripcion,$intStatus);
        
        //validacion de la respuesta obtenida
        if($request_rol > 0){
            //mensaje si la respuesta es positiva 
            $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados Correctamente');
        }else if($request_rol == 'exist'){
            //Mensaje si el rol es igual a otro 
            $arrResponse = array('status' => false, 'msg' => '¡Atención el Rol ya Existe!');
        }else{       
            //Mensaje de fallo 
            
            $arrResponse = array('status' => true, 'msg' => 'No es Posible Almcenar los Datos');
        }
        //Impresion de los datos en formato JSON y mostrar en la tabla
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function delRol(){
        if($_POST){
            $intId_Rol = intval($_POST['id_rol']);
            $request_Delete = $this->model->deleteRol($intId_Rol);
            $arrResponse = $this->respuestaArrayDel($request_Delete);
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

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