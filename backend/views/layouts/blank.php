<?php
/**
 * Main layout file for the whole backend.
 * It is based on Twitter Bootstrap classes inside HTML5Boilerplate.
 *
 * @var BackendController $this
 * @var string $content
 */

// тема
// основные стили
//Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/font-awesome.min.css');
//Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/ace.min.css');
//Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/ace-responsive.min.css');
//Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/ace-skins.min.css');
//// форма и элементы
//Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/chosen.css');
//
//// скрипты
//Yii::app()->getClientScript()->registerScriptFile($this->assets_backend . '/theme/js/chosen.jquery.min.js');
//Yii::app()->getClientScript()->registerScriptFile($this->assets_backend . '/theme/js/ace-elements.min.js');
//Yii::app()->getClientScript()->registerScriptFile($this->assets_backend . '/theme/js/ace.min.js');
//
//
//
$this->rgisterTemplateAssets();

//Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/main.css');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<!-- CONTENT WRAPPER BEGIN -->
<div class="container">

	<div class="row">

        <!-- CONTENT BEGIN -->
		<?= $content; ?>
        <!-- CONTENT END -->

    </div>
</div>
<!-- CONTENT WRAPPER END -->


</body>
</html>
