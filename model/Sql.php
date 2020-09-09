<?php

class Sql extends PDO
{
    private $conn;

    public function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=dbtestedao","root", "");
    }

    private function setParams($statement, $parameters = array()){
       // print_r($statement);
       /* exit;
        */
       /*
        print_r($parameters);
        exit;*/
        foreach($parameters as $key => $value){
           /* echo "<br>Campo = " . $key;
            echo "<br>Valor = " . $value;*/
            $this->setParam($statement, $key, $value);
            //exit;
        }
    }
    private function setParam($statement, $key, $value){
        $statement->bindParam($key,$value);//PDO
        //Vincula uma variável PHP a um espaço reservado com nome ou ponto de interrogação 
        //correspondente na instrução SQL que foi usada para preparar a instrução. 
    }

    //o método query será utilizado para o insert, update e delete.
    public function query($rawQuery, $params = array()){//método com argumento padrão
        $stmt = $this->conn->prepare($rawQuery);//prepare: associação dos parâmetros 
        $this->setParams($stmt, $params);
        /*
        print_r($stmt);
        exit;
        */
        $stmt->execute();
        return $stmt;
    }

    //o método select será para todas seleções com ou sem parâmetros
    //rawQuery = query bruta comandos select que vai para o BD
    public function select($rawQuery, $params = array()):array
    {
     /*  echo $rawQuery;
        echo "<br>";
        print_r($params);
        exit;*/
        $stmt = $this->query($rawQuery, $params);
        //print_r($stmt); exit;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        //fetchAll: retorna um array contendo todas as linhas no conjunto de resultados
        //FETCH_ASSOC: retorna uma matriz indexada pelo nome da coluna conforme retornado em seu conjunto de resultados
    }

}

?>