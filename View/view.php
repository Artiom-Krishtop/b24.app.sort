<?php

require_once 'includes/header.php';?>

<div class="container" id="company-app">
    <div class="company-field">
        <? if (!empty($params['VALUE'])): ?>
            <? foreach ($params['VALUE'] as $value): ?>
                <span class="company__value" data-id="<?= $value['ID'] ?>"><?= $value['TITLE'] ?></span>
            <? endforeach; ?>
        <? else: ?>
            <span class="company__value">Ничего не выбрано</span>
        <? endif; ?> 
    </div>
</div>

<? require_once 'includes/footer.php';?>