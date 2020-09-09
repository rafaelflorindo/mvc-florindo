
<?php
require_once(__DIR__ . '/config.php');
session_start();

if (!isset($_SESSION['user'])){
    $dados = array("controller"=>"ControllerLogin","acao"=>"logar");
    (new IndexController($dados))->rota(); 
}
else{
    include('view/Home.php');
}
    
?>