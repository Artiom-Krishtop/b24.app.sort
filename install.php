<?php

use Manao\Utils\AppExeption;
use Manao\Utils\CRest\CRestCompanyApp;

$result = CRestCompanyApp::installApp();

if(!$result['install']){
    throw new AppExeption('Приложение не установлено', $logger);
}

$handler = 'https://' . $_SERVER['SERVER_NAME'] . ROOT . '/index.php'; 

$result = CRestCompanyApp::call('userfieldtype.add', [
    'USER_TYPE_ID' =>  'select_company',
    'HANDLER' =>  $handler,
    'TITLE' =>  'Выбор компании',
    'DESCRIPTION' =>  'Выбор компании с фильтрацией по типу компании'
]);

if(!$result['result']){
    throw new AppExeption('Пользовательский тип поля не добавлен', $logger);
}