<?php
class Inicio extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function inicio(){
        $data['tag_page'] = "Inicio";
        $data['page_title'] = "Página de Inicio Correcto llamado";
        $data['page_name'] = "listo";
        
       $this->views->getView($this,"inicio",$data);
    }
}
?>