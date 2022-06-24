<?php

namespace Manao\Utils\CRest;

use Manao\Utils\CRest\CRest;
use Manao\Utils\Logger;

class CRestCompanyApp extends CRest
{
    public static function setlog($arData, $type = '')
    {
        if (defined("C_REST_LOGS_DIR")) {
            $path = C_REST_LOGS_DIR;
        }else {
            $path = ROOT . '/Logs/';
        }

        $logger = new Logger($path);
        $logger->log($arData);
    }
}