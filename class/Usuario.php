<?php

class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    /**
     * @return mixed
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * @param mixed $idusuario
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }

    /**
     * @return mixed
     */
    public function getDeslogin()
    {
        return $this->deslogin;
    }

    /**
     * @param mixed $deslogin
     */
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;
    }

    /**
     * @return mixed
     */
    public function getDessenha()
    {
        return $this->dessenha;
    }

    /**
     * @param mixed $dessenha
     */
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;
    }

    /**
     * @return mixed
     */
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    /**
     * @param mixed $dtcadastro
     */
    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;
    }

    //Atributos preenchidos com os dados guardados na DB
    //Busca info na DB e preenche os campos dos atributos

    public function loadById($id){

        $sql = new Sql();


        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario=:ID", array(
            ':ID' =>$id
        ));

        if(count($results)>0){

            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));

        }

    }
    //Static - Não é necessário instanciar o objecto, ele é chamado directamente
    //como não tem $this->>methods a ser usados torna esta função possível de ser estática
    //não está amarrada nela propria, assim pode ser chamada directamente fora
    public static function getList(){

        $sql = new Sql();
       return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

    }

    public static function search($login){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(

            ':SEARCH' =>'%'.$login.'%'

        ));

    }

    public function login($login, $password){

        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN and dessenha = :PASSWORD", array(
            ':LOGIN' => $login,
            ':PASSWORD' => $password
        ));

        if(count($results)>0){

            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));

        }else{

            throw new Exception("Login e/ou senha inválidos.");

        }

    }

    //funções magicas do php
    public function __toString(){

        return json_encode(array(

            'idusuario'=>$this->getIdusuario(),
            'deslogin'=>$this->getDeslogin(),
            'dessenha'=>$this->getDessenha(),
            'dtcadastro'=>$this->getDtcadastro()->format('Y-m-d H:i:s')

        ));

    }



}

?>