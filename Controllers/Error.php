<?php
class Errors extends Controllers{
    public function __construct()
    {
        parent::__construct();

    }
    public function notFound(){
        $data['tag_page'] = "Error";
        $data['page_title'] = "Página de Inicio funciaona";
        $data['page_name'] = "listo";
       $this->views->getView($this,"error", $data);
    }
}
$notFound = new Errors();
$notFound->notFound();
?>