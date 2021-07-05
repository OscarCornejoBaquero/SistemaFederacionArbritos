//Script para las funcionabilidad del controlador ROL
//Variable general para la tabla ROL
var tableRoles;

document.addEventListener('DOMContentLoaded', function(){
    //Consulta de Roles a Tabla
    tableRoles =$('#tableRoles').dataTable({
    "aProcessing":true,
    "aServerSide":true,
    //esta propiedad permite cambiar el lenguaje de la tabal en español
    "language":{
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    //Ajax que permite agregar a la variable URL la url del Modelo que se hace el trabajo 
    //con la base de datos
    "ajax":{
        "url": " "+base_url+"Roles/getRoles",
        "dataSrc":""
    },
    //Definicion de las columnas de la tabla donde se mostraran los datos
    "columns":[
        {"data":"id_rol"},
        {"data":"nombre_rol"},
        {"data":"descripcion_rol"},
        {"data":"status"},
        {"data":"options"},
        
    ],
    //Configuracion adicional de la tabla
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]
    });

    //Metodo para creacion de un Nuevo Rol 
    //Variable para seleccionar el Formulario de donde provienen los datos 
    var formRol = document.querySelector("#formRol");
    //Funcion que captura los datos del formulario
    formRol.onsubmit = function(e){
        //Accion que previene que la página se recarge al momento de dar clic en submit
        e.preventDefault();
        //Asignación de los datos a las variables para su uso en la funcion
        var intId_rol = document.querySelector('#id_rol').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strDescripcion = document.querySelector('#txtDescripcion').value;
        var intStatus = document.querySelector('#listStatus').value;
        //Validacion para que los datos no lleguen vacios
        if(strNombre == '' || strDescripcion == '' || intStatus == ''){
            //Mensjae de alerta en un modal de error 
            sweetAlert("Atención", "Todos los campos son obligatorios", "error");
            return false;
        }
        //Asignacion del tipo de navegador en la variable request 
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        //Variable ajax con URl que obtiene el query realizado 
        if(intId_rol>0){
            var ajaxUrl = base_url+'Roles/editRol';
        }
        if(intId_rol==0){
            var ajaxUrl = base_url+'Roles/setRol';
        }
        
        
        
        var formData = new FormData(formRol);
        //Captura de los datos usando el metodo POST
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            //Validacion para conocerl el estado del ingreso por medio de los estados request 
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                //validacion si la data se ejecuto de manera correcta
                if(objData.status){
                    //llamado al modal para enviar mensaje de informacion
                    $('#modalFormRol').modal("hide");
                    formRol.reset();
                    sweetAlert("Roles de Usuario", objData.msg, "success");
                    //funcion que permite recargar la tabla usando ajax para que cuando de clic en OK 
                    //en el modal se actualice la carga de forma automatica sin la necesidad de 
                    //actualzar el navegador. 
                    tableRoles.api().ajax.reload(function(){
                        fntEditRol();
                        fntDelRol();
                        //fntPermiso();
                    });
                }else{
                    //Mensaje de error en caso de fallo en el query
                    sweetAlert("Error", objData.msg,"error");
                }

            }
            
        }
    }

});
//Metodo que permite abrir el modal para ingreso de datos de un nuevo rol 
$('#tableRoles').DataTable();
function openModal(){

    document.querySelector('#id_rol').value=""; 
    document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info","btn-success");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol"; 
    document.querySelector('#formRol').reset(); 
    $('#modalFormRol').modal('show');
}
//Se agrega el evento windows load para agregar la funcion fntEditRol al momento de cargar 
//la pagina 

window.addEventListener("load", function() {
    setTimeout(() => { 
        fntEditRol();
        fntDelRol();
    }, 500);
  }, false);

//Metodo para dar una accion al boton editar rol 
function fntEditRol(){
    //Selecciona Todos los elementos que tengan la clase btnEditRol (Se puede cambiar para seleccionar otro
    //Elemento)
    var btnEditRol = document.querySelectorAll(".btnEditRol");
    //Se recorre por medio de un for Each la variable que se envia por parametro
    btnEditRol.forEach(function(btnEditRol){
        //Se agrega un evento listener click y ejecuta la funcion 
        btnEditRol.addEventListener('click', function(){
            //Muestra la funcion por medio de esta funcion de boostrap
            document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
            document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-success","btn-info");
            document.querySelector('#btnText').innerHTML = "Actualizar";

            //Acciones para capturar el ID 
            var id_rol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ?new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxetUser = base_url+'Roles/getRol/'+id_rol;
            request.open("GET",ajaxetUser,true);
            request.send();

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        document.querySelector('#id_rol').value=objData.data.id_rol; 
                        document.querySelector('#txtNombre').value=objData.data.nombre_rol; 
                        document.querySelector('#txtDescripcion').value=objData.data.descripcion_rol; 
                        if(objData.data.status == 1){
                            var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                        }else{
                            var optionSelect = '<option value="1" selected class="notBlock">Inactivo</option>';
                        }
                        var htmlSelect = `${optionSelect}
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                        `;
                        document.querySelector('#listStatus').innerHTML = htmlSelect;
                        $('#modalFormRol').modal('show');
                    }else{
                        sweetAlert("Error", objData.msg,"error");
                    }
                }
            }
            $('#modalFormRol').modal('show');
        });
    });
}

function fntDelRol(){
    var btnDelRol = document.querySelectorAll(".btnDelRol");
    btnDelRol.forEach(function(btnDelRol){
        btnDelRol.addEventListener('click',function(){
            var id_rol = this.getAttribute("rl");
            sweetAlert(
                {
                    title: "Eliminar Rol", 
                    text: "Realmente desea Eliminar el ROL",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Si, Eliminar",
                    cancelButtonText: "No, Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function(isConfirm){
                    if(isConfirm){
                        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                        var ajaxUrl = base_url+'Roles/delRol/';
                        var strData = "id_rol="+id_rol;
                        
                        request.open("POST",ajaxUrl,true);
                        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        request.send(strData);
                        
                        request.onreadystatechange = function(){
                            
                            if(request.readyState == 4 && request.status == 200){
                                var objData = JSON.parse(request.responseText);
                                if(objData.status){
                                    sweetAlert("Eliminar", objData.msg,"success");
                                    tableRoles.api().ajax.reload(function(){
                                        fntEditRol();
                                        fntDelRol();
                                    });
                                }else{
                                    sweetAlert("Atención!", objData.msg,"error");
                                }
                            }
                        }
                    }
                });    
        });
    });
}
