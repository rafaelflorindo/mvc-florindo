<?php
require('Sql.php');
class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    
    public function __construct($login="",$password="")
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }
    
    public function setData($data){//o data aqui é de dados
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new Datetime($data['dtcadastro']));
    }
    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

    public static function getList(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM dbusuario ORDER BY deslogin;");
    }

    public static function search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM dbusuario where deslogin LIKE :SEARCH ORDER BY deslogin;",
         array(
            ':SEARCH'=>"%".$login."%"
           ));
    }

    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM dbusuario where idusuario = :id", array(":id"=>$id));
        /*print_r($results);
        exit;*/
        if(count($results) > 0){
            $this->setData($results[0]);
        }
    } 

    public function login($login, $password){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM dbusuario where deslogin = :LOGIN and dessenha = :PASSWORD", 
        array(":LOGIN"=>$login, 
            ":PASSWORD"=>$password)
        );
        if(count($results)>0){
            $this->setData($results[0]);
            return json_encode(array(
                "idusuario"=>$this->getIdusuario(),
                "deslogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
            ));
        }else{
            throw new Exception("Login e ou senha inválidos");
        }
    }

    public function insert(){
        $sql = new Sql();
        $this->setDtcadastro(Date("Y-m-d H:m:s"));
        $sql->query("INSERT INTO dbusuario (deslogin, dessenha, dtcadastro) 
                                value (:LOGIN, :PASSWORD, :DTCADASTRO)", 
                                array(":LOGIN"=>$this->getDeslogin(), 
                                    ":PASSWORD"=>$this->getDessenha(), 
                                    ":DTCADASTRO"=>$this->getDtcadastro()
                                ));
                                
        $results = $sql->select("SELECT * FROM dbusuario WHERE idusuario = LAST_INSERT_ID()");
        if(count($results) > 0)
            $this->setData($results[0]);
    }

    public function update($login, $password){
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();
        $sql->query("UPDATE dbusuario SET deslogin=:LOGIN, dessenha=:PASSWORD WHERE idusuario=:ID",
        array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha(),
            ":ID"=>$this->getIdusuario()
        ));
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM dbusuario WHERE idusuario = :ID",
        array(":ID"=>$this->getIdusuario())
        );
        //depois que excluiu limpa os dados do objeto
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new Datetime());
    }

    private function setIdusuario($value){
        $this->idusuario=$value;
    }
    public function getIdusuario(){
        return $this->idusuario;
    }
    private function setDeslogin($value){
        $this->deslogin=$value;
    }
    public function getDeslogin(){
        return $this->deslogin;
    }
    private function setDessenha($value){
        $this->dessenha=$value;
    }
    public function getDessenha(){
        return $this->dessenha;
    }
    private function setDtcadastro($value){
        $this->dtcadastro=$value;
    }
    public function getDtcadastro(){
        return $this->dtcadastro;
    }
}
?>