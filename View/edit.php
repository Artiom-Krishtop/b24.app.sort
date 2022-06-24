<?php

require_once 'includes/header.php';?>

<div class="container" id="company-app">
    <div class="company-field edit">
        <div class="company-value-container" id="value-container">
            <? if (!empty($params['VALUE'])):?>
                <? foreach ($params['VALUE'] as $value):?>
                    <div class="company-field__value"  data-id="<?= $value['ID']?>">
                        <span class="company-name"><?= $value['TITLE']?></span>
                        <span class="close"></span>
                    </div>
                <? endforeach;?>
            <? endif;?>
            <span class="drop-select" id="btn-select"> выбрать</span>
        </div>
    </div>
    <div class="select-drop-container hide" id="select-drop-list">
        <div class="select-drop-company-type__list">
            <div class="company-type-list__item-wrapper select" data-company-type-id="all">
                <span class="company-type-list__item">Все</span>
            </div>
            <? if (!empty($params['COMPANY_TYPE'])):?>
                <? foreach ($params['COMPANY_TYPE'] as $companyType):?>
                    <div class="company-type-list__item-wrapper" data-company-type-id="<?= $companyType['STATUS_ID']?>">
                        <span class="company-type-list__item"><?= $companyType['NAME']?></span>
                    </div>
                <? endforeach;?>
            <? endif;?>
        </div>
        <div class="select-drop-company__list">
            <? if (!empty($params['COMPANY_LIST'])):?>
                <? foreach ($params['COMPANY_LIST'] as $company):?>
                    <div class="company-list__item-wrapper <?= isset($company['SELECTED']) && $company['SELECTED'] ? 'select' : '';?>" data-company-type="<?= $company['COMPANY_TYPE']?>" data-company-id="<?= $company['ID']?>">
                        <span class="company-list__item"><?= $company['TITLE']?></span>
                    </div>
                <? endforeach;?>
            <? else: ?>
                <div class="company-list__item-wrapper">
                    <span class="company-list__item">Список компаний пуст</span>
                </div>
            <? endif;?>
        </div>
    </div>
    <script>editObj.init({multiple: "<?= $params['MULTIPLE']?>", required: "<?= $params['REQUIRED']?>"})</script>
</div>

<? require_once 'includes/footer.php';?>