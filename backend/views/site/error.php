<?php
/**
 * @var BackendController $this
 * @var string $code
 * @var string $message
 */

$this->pageTitle = 'Ошибка';
//$this->pageTitle=Yii::app()->name . ' - Ошибка';
//$this->breadcrumbs=array(
//	'Error',
//);
?>



<div id="error_wrapper" class="error">
    <div class="offset3 span6">
        <h2><?= $code; ?></h2>
        <?= CHtml::encode($message); ?>
<!--    </div>-->
<!--    <div class="span6">-->
        <img src="<?= $this->assets_backend . '/images/minions.jpg'; ?>">
    </div>
</div>