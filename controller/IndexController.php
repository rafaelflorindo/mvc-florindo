<?php
class IndexController{
    private $controller;

    public function __construct(array $controller)
    {
        $this->controller = $controller;
    }
    public function rota(){
        if($this->controller["controller"] == "ControllerLogin" &&
        $this->controller["acao"] == "logar"){
           (new ControllerLogin())->logar();
           
        }elseif($this->controller["controller"] == "ControllerLogin" &&
        $this->controller["acao"] == "listarUsuario"){
           include('ControllerLogin.php');
           (new ControllerLogin())->listarUsuario();
        }
        elseif($this->controller["controller"] == "ControllerLogin" &&
        $this->controller["acao"] == "alterarUsuario"){
           include('ControllerLogin.php');
           (new ControllerLogin())->alterarUsuario($this->controller["id"]);
        }
    }
        
}


















//https://www.devmedia.com.br/conceito-de-mvc-e-sua-funcionalidade-usando-o-php/22324
//https://tableless.com.br/entendendo-o-padrao-mvc-na-pratica/


//ver este link
//https://www.youtube.com/watch?v=MfZrnQprZ2U