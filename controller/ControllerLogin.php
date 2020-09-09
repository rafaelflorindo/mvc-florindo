<?php

//require_once('../config.php');
class ControllerLogin{
    
    public function __construct()
    {
    
    }
    public function logar(){
       
        $fileName = 'public/html/formularioAutenticar.html';

        if(file_exists($fileName)){
            require($fileName);
            
            if(!empty($_POST)){
                if(!empty($_POST['login']) && !empty($_POST['password'])){
                    if(isset($_POST['login']) && isset($_POST['password'])){
                        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
                        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
                        
                        require('model/Usuario.php');     
                        $user = new Usuario();     
                        $results = $user->login($login, $password);
                        $_SESSION['user'] = $results;
                        header('location: index.php');
                    }
                }
            }
        }
     }
     public function inserir(){
       
        $fileName = 'public/html/formularioCadastro.html';

        if(file_exists($fileName)){
            require($fileName);
            
            if(!empty($_POST)){
                if(!empty($_POST['login']) && !empty($_POST['password'])){
                    if(isset($_POST['login']) && isset($_POST['password'])){
                        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
                        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
                        
                        require('model/Usuario.php');     
                        $user = new Usuario($login, $password);     
                        $results = $user->insert();
                        echo $results;
                        exit;
                        header('location: index.php');
                    }
                }
            }
        }
     }
    public function listarUsuario(){
        
        require('../model/Usuario.php');     
        $sql = new Sql();
    
        $usuario = $sql->select("SELECT * FROM dbusuario");
       
        $fileName1 = '../public/html/listarUsers.php';
        if(file_exists($fileName1)){
            require($fileName1);
            json_encode($usuario);
        }
        
    }
    public function alterarUsuario($id){
        require('../model/Usuario.php');     
        
        $fileName = '../public/html/formularioAlterar.php';

        if(file_exists($fileName)){
            $usuario = new Usuario();
            $usuario->loadById($id);
            require($fileName);
                       
            if(!empty($_POST)){
                if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['id'])){

                    if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['id'])){
 
                        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
                        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
                        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

                        $usuario->update($login, $password);
                        
                        header('location: ../index.php');
                    }
                }
            }
        }  
    }
}
/*
TRABALHO OBJETIVO - MVP 
1 - QUAL O GRUPO
2 - QUAL O TEMA DO TRABALHO
3 - QUAL O ESCOPO DO SISTEMA
4 - QUAL TECNOLOGIA A SER UTILIZADA (PHP, REACT, NODE)
*/
    
?>