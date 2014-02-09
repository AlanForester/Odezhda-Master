<?php
Yii::app()->clientScript->registerPackage('product');
?>
<div class="wrapper">
    <div class="breadcrumbs">
        <a href='/'>Главная</a><span>/</span>
        <span><?php echo $infoPage->name ?></span>
    </div>
    <div class="karta-wrap" style="padding: 15px 20px;line-height: 20px;">
            <h1 style="text-align: center"><?php echo $infoPage->name ?></h1>
            <?php echo $infoPage->description ?>
    </div>
</div>