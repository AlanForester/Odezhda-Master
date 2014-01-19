<?php
/**
 * Main layout file for the whole backend.
 * It is based on Twitter Bootstrap classes inside HTML5Boilerplate.
 *
 * @var BackendController $this
 * @var string $content
 */

Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/main.css');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= CHtml::encode($this->pageTitle); ?></title>
</head>

<body data-offset="87" data-target=".subhead" data-spy="scroll">
<!-- NAVIGATION BEGIN -->
<?php $this->renderPartial('//layouts/_navigation'); ?>
<!-- NAVIGATION END -->

<!--<div style="margin-top: 50px;"></div>-->

<header class="header">
    <div class="container-fluid">
        <div class="row-fluid">

            <div class="span12">
                    <h1 class="page-title"><?= $this->pageTitle ?></h1>
            </div>
        </div>
    </div>
</header>

<div class="subhead-collapse collapse">
    <div class="subhead">
<!--TITLE AND BUTTONS-->
<div class="container-fluid">
    <div class="row-fluid">

        <div class="span12 pull-right button-block" style="text-align:right;line-height:60px">
            <?php
            if (count($this->pageButton)>0){
//            $this->widget(
//                'backend.widgets.bootstrap.TbButtonGroup',
//                [
//                    'buttons'=>$this->pageButton
//                ]
//            );

                echo join('',$this->pageButton);
//                foreach ($this->pageButton as $button) {
//                    echo TbHtml::linkButton($button['label'], $button['htmlOptions']);
////                    echo TbHtml::btn(self::BUTTON_TYPE_LINK, $label, $htmlOptions)
//                }

            }
            ?>
        </div>
    </div>
</div>
        </div>
</div>

<!-- CONTENT WRAPPER BEGIN -->
<div class="container-fluid">

    <!-- BREADCRUMBS-->
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumb',
            array(
                'links' => $this->breadcrumbs,
            )
        ); ?>
    <?php endif ?>

    <!-- CONTENT-->
    <?= $content; ?>


</div>
<!-- CONTENT WRAPPER END -->

<?php //$this->renderPartial('//layouts/_footer'); ?>

</body>
</html>
