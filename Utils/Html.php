<?php

namespace Manao\Utils;

class Html
{
    const HTML_FOLDER = '/View/';

    public static function getHtml($name, $params){
        $path = ROOT . self::HTML_FOLDER . $name . '.php';
        
        if(file_exists($path)){
            include_once $path;
        }
    }
}