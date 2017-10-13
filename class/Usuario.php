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

            $this->setData($results[0]);

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

          $this->setData($results[0]);

        }else{

            throw new Exception("Login e/ou senha inválidos.");

        }

    }

    public function insert(){

        $sql = new sql();
                                            //procedure // sp - storieprocedure_tabela_accao
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(

            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
        ));

        if(count($results) > 0) {
            $this->setData($results[0]);
        }
    }


    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()

        ));

    }

    public function __construct($login = "", $senha = ""){

        $this->setDeslogin($login);
        $this->setDessenha($senha);

}
    public function setData($data){

        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));

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