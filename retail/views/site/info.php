<?php
Yii::app()->clientScript->registerPackage('product');
$this->breadcrumbs=array(
    $infoPage->name,
);
?>
<div class="wrapper">
<!--    <div class="breadcrumbs">-->
<!--        <a href='/'>Главная</a><span>/</span>-->
<!--        <span>--><?php //echo $infoPage->name ?><!--</span>-->
<!--    </div>-->

<!--    <div class="karta-wrap" style="padding: 15px 20px;line-height: 20px;">-->
    <div class="karta-wrap">
            <h1><?php echo $infoPage->name ?></h1>
            <?php echo $infoPage->description ?>
    </div>
</div>