<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 12/10/2017
 * Time: 16:05
 */

require_once ('config.php');

//carrega um usuario
/*$root = new Usuario();
$root->loadById(1);
Echo $root;*/

//carrega a lista de usuarios
/*$list = Usuario::getList();
echo json_encode($list);*/

//carrega a lista de usuarios pesquisados por um índice

/*$search = Usuario::search('a');
echo json_encode($search);*/

//login de usuario
/*$usuario = new Usuario();
$usuario->login('Mariana', '654321');
Echo $usuario;*/

//Inserir novo usuario
/*$aluno = new Usuario("Sofia", "54687");
$aluno->insert();
echo $aluno;*/

//Update Usuario

$usuario = new Usuario();

/*$usuario->loadById(4);

$usuario->update("Marianinha","777777");

echo $usuario;*/

$usuario->loadById(1);

$usuario->update('Joca', '333');