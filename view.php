<?php 

use Manao\Utils\AppExeption;
use Manao\Utils\CRest\CRestCompanyApp;
use Manao\Utils\Html;

$value = '';
        
if(!empty($placementOption['VALUE'])){
    $result = CRestCompanyApp::call('crm.company.list', [
        'ORDER' => [
            'NAME' => 'ASC'
        ],
        'FILTER' => [
            'ID' => $placementOption['VALUE']
        ],
        'SELECT' => [
            'ID',
            'TITLE'
        ]
    ]);

    if(isset($result['error'])){
        throw new AppExeption('Ошибка вызова метода', $logger);
    }else {
        $value = $result['result'];
    }
}

$params = [
    'VALUE' => $value, 
    'MULTIPLE' => $placementOption['MULTIPLE']
];

Html::getHtml('view', $params);