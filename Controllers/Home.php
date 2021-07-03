<?php
class Home extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }
    public function home(){
        $data['tag_page'] = "Home";
        $data['page_title'] = "Página prueba pepa";
        $data['page_name'] = "home";
       $this->views->getView($this,"home",$data);
       
    }

}
?>