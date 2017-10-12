<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 12/10/2017
 * Time: 15:58
 */

spl_autoload_register(function($class_name){

    $filename = "class".DIRECTORY_SEPARATOR.$class_name.'.php';

    if(file_exists($filename)){
        require_once ($filename);
    }


});

?>