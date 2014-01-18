<?php
/**
 * @var BackendController $this
 * @var string $code
 * @var string $message
 */

$this->pageTitle='Ошибка';
//$this->pageTitle=Yii::app()->name . ' - Ошибка';
//$this->breadcrumbs=array(
//	'Error',
//);
?>

<h2><?= $code; ?></h2>

<div class="error">
<?= CHtml::encode($message); ?>
</div>