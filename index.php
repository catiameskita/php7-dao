<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 12/10/2017
 * Time: 16:05
 */

require_once ('config.php');

$sql = new Sql();

$usuarios = $sql->select('SELECT * FROM tb_usuarios' );

echo json_encode($usuarios);



