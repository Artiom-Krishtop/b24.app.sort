<?php

use Manao\Utils\AppExeption;
use Manao\Utils\CRest\CRestCompanyApp;
use Manao\Utils\Html;

$values = [];

$result = CRestCompanyApp::call('crm.company.list', []);

if(isset($result['error'])){
    throw new AppExeption('Ошибка вызова метода', $logger);
}

$companyList = $result['result'];

if(!empty($placementOption['VALUE'])){

    if($placementOption['MULTIPLE'] == 'Y'){
        foreach($companyList as $key => $company){
            if(in_array($company['ID'], $placementOption['VALUE'])){
                $companyList[$key]['SELECTED'] = true;
                $values[] = $company;
            }
        }
    }else {
        foreach($companyList as $key => $company){
            if($company['ID'] == $placementOption['VALUE']){
                $companyList[$key]['SELECTED'] = true;
                $values[] = $company;

                break;
            }
        }
    }
}


$result = CRestCompanyApp::call('crm.status.entity.items', ['ENTITY_ID' => 'COMPANY_TYPE']);

if(isset($result['error'])){
    throw new AppExeption('Ошибка вызова метода', $logger);
}

$companyType = $result['result'];

$params = [
    'VALUE' => $values, 
    'MULTIPLE' => $placementOption['MULTIPLE'],
    'REQUIRED' => $placementOption['MANDATORY'],
    'FIELD_NAME' => $placementOption['FIELD_NAME'],
    'COMPANY_LIST' => $companyList,
    'COMPANY_TYPE' => $companyType
];

Html::getHtml('edit', $params);