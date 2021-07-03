<?php
class Login extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function login(){
        $data['tag_page'] = "grupo 2";
        $data['page_title'] = "Página prueba pepa";
        $data['page_name'] = "Login";
       $this->views->getView($this,"login",$data);
    }

}
?>