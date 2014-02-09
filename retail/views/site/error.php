<?php
Yii::app()->clientScript->registerPackage('index');

$this->pageTitle .= ' - Ошибка';
?>
<div class="wrapper error_page">
    <div class="karta-wrap" style="padding: 15px 20px;line-height: 20px;">
        <div><?php echo CHtml::encode($message) ?></div>

        <small>(Ошибка <?php echo $code ?>)</small>
    </div>
</div>