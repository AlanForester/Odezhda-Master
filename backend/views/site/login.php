<?php
/**
 * @var BackendController $this
 * @var BackendLoginForm $model
 */


Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/adminlogin.css');
$this->pageTitle = 'Login';
$this->breadcrumbs = ['Login'];
?>

<!--<p>Please fill out the following form with your login credentials:</p>-->

<!-- Login Form BEGIN -->
<div class="form">

<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget(
	'bootstrap.widgets.TbActiveForm',
	array(
		'id' => 'loginForm',
		'enableClientValidation' => true,
		'htmlOptions' => ['class' => 'well offset4'],
		'clientOptions' => array(
			'validateOnSubmit'=>true,
		),
	)
);

echo CHtml::errorSummary($model, null, null, array('class' => 'alert alert-error'));
?>

<!--	<p class="lead">Log In Here</p>-->
    <legend>Авторизация</legend>

    <?= $form->textField($model, 'username', array('class'=>'span3', 'placeholder'=>'Логин', 'prepend'=>TbHtml::icon(TbHtml::ICON_USER), 'size'=>'60'));?>
	<?= $form->passwordField($model, 'password', array('class'=>'span3', 'placeholder'=>'Пароль', 'prepend'=>TbHtml::icon(TbHtml::ICON_LOCK)));?>

	<?php if ($model->isCaptchaRequired()): ?>
		<?php $this->widget('CCaptcha'); ?>
		<?= $form->textField($model, 'verifyCode'); ?>
	<?php endif; ?>

<!--	<div class="form-actions">-->
		<?php $this->widget('bootstrap.widgets.TbButton', array('id'=>'logInButton', 'buttonType'=>'submit','type'=>'primary','label'=>'Вход', 'icon'=>'ok'));?>
<!--	</div>-->

<?php $this->endWidget(); ?>

</div>
<!-- Login Form END -->
