<?php

Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/retailorder.css');
Yii::app()->getClientScript()->registerScriptFile($this->assets_backend . '/retailorder.js');

$this->pageTitle = 'Оптовые заказы: ' . ($item->id ? 'редактирование заказа номер ' . $item->id : 'новый заказ');

$this->pageButton = [
    BackendPageButtons::save(),
    $item->id ? BackendPageButtons::apply() : '',
    BackendPageButtons::cancel("/orders/index")
];

?>
