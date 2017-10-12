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


$usuario = new Usuario();
$usuario->login('Mariana', '65431');
Echo $usuario;






