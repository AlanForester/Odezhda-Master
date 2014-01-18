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



<div class="error row">
    <span class="span6">
        <h2><?= $code; ?></h2>
        <?= CHtml::encode($message); ?>
    </span>
    <span class="span6">
        <img src="<?= $this->assets_backend . '/images/minions.jpg'; ?>">
    </span>
</div>