<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/b24.app.sort/Configs/Defines.php';

spl_autoload_register(function($className){
    $className = trim($className);

    $path = ROOT . str_replace(['Manao', '\\'], ['', '/'], $className);
    $path .= '.php';

    if(file_exists($path)){
        require_once $path;

        return true;
    }
});
