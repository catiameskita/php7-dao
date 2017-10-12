<?php

//bash/git init
//online/criar novo repositório e copiar https
//git remote add origin https://github.com/catiameskita/php7-dao.git

//git pull origin master - puxar do git online para o PC

class Sql extends PDO{


    private $conn;

    public function __construct(){

        $this->conn = new PDO("mysql:host=localhost; dbname=dbphp7", "root", "");

    }

    private function setParams($statement, $parameters = array() ){

        foreach ($parameters as $key => $value){

            $this->setParam($key, $value);

        }
    }

    private function setParam($statement, $key, $value){

        $statement->bindParam($key, $value);
    }


    public function query($rawQuery, $params = array()){

        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;

    }

    public function select($rawQuery, $params = array()):array {

        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}




?>