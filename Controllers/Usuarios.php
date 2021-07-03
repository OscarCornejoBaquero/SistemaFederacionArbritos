<?php
class Usuarios extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }
    public function usuarios(){
        $data['page_id'] = 4;
        $data['page_tag'] = "Usuarios - Sistema Federacion de Arbritos";
        $data['page_title'] = "Administracion de Usuarios ";
        $data['page_name'] = "usuario";
       $this->views->getView($this,"usuarios",$data);
       
    }

}
?>