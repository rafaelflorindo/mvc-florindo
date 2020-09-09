<?php

//tratar rotas
include('IndexController.php');

if(!empty($_GET)){
    if(isset($_GET["metodo"]) && isset($_GET["controller"]) || isset($_GET["id"]))
        //print_r($_GET);
        $dados = array("controller"=>$_GET["controller"],"acao"=>$_GET["metodo"],"id"=>$_GET["id"]);
    (new IndexController($dados))->rota(); 
}