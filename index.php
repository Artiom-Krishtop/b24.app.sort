<?php 

require_once 'Utils/Autoloader.php';

use Manao\Utils\Logger;

if(defined("C_REST_LOGS_DIR")){
    $path = C_REST_LOGS_DIR;
}else{
    $path = ROOT . '/Logs/';
}

$logger = new Logger($path);

/* Обработчик установки */

if(isset($_REQUEST['event']) && $_REQUEST['event'] == 'ONAPPINSTALL'){
    require_once 'install.php';
}

/* Обработчик пользовательского поля */

if(isset($_REQUEST['PLACEMENT']) && $_REQUEST['PLACEMENT'] == 'USERFIELD_TYPE'){
    $placement = $_REQUEST['PLACEMENT'];
    $placementOption = json_decode($_REQUEST['PLACEMENT_OPTIONS'], true);

    if($placementOption['MODE'] == 'view'){
        require_once 'view.php';
    }elseif ($placementOption['MODE'] == 'edit') {
        require_once 'edit.php';
    }
}



