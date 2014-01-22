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

$this->registerTemplateAssets();

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

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(function () {
            // todo: перенсти все в отдельный скрипт (файл)

            $('select').chosen({
                disable_search_threshold : 10,
                allow_single_deselect : true
            });

            // диалоговые окна
            bootbox.setDefaults({
                locale: "ru"
            });

            // tooltip
            $("[rel='tooltip'],.hasTooltip").tooltip({"container": false});

            // checkbox
//            $('table input:checkbox').each(function(){
//                var parent_html = $(this).parent().html();
//                $(this).parent().html('<label>'+parent_html+'<span class="lbl"></span></label>');
//            });
            $('table th input:checkbox').on('click' , function(){
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });
            });

            // fix sub nav on scroll
            var $win = $(window),
                $nav = $('.subhead'),
                navTop = $('.subhead').length && $('.subhead').offset().top - 63,
                isFixed = 0;

            processScroll();

            // hack sad times - holdover until rewrite for 2.1
            $nav.on('click', function (){
                if (!isFixed) setTimeout(function () {  $win.scrollTop($win.scrollTop() - 47) }, 10)
            });

            $win.on('scroll', processScroll);

            function processScroll(){
                var i, scrollTop = $win.scrollTop();
                if (scrollTop >= navTop && !isFixed){
                    isFixed = 1;
                    $nav.addClass('subhead-fixed');
                } else if (scrollTop <= navTop && isFixed){
                    isFixed = 0;
                    $nav.removeClass('subhead-fixed');
                }
            }
        });
    </script>
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

<?php if (count($this->pageButton) > 0) {?>
<div class="subhead-collapse collapse">
    <div class="subhead">
        <!--TITLE AND BUTTONS-->
        <div class="container-fluid">

            <div class="row-fluid">

                <div class="span12 pull-right button-block" style="text-align:right;line-height:60px">
                    <?php
                    //if (count($this->pageButton) > 0) {
                        echo join('', $this->pageButton);
                    //}
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- CONTENT WRAPPER BEGIN -->
<?php $this->renderPartial('//layouts/_content',compact('content')); ?>
<!-- CONTENT WRAPPER END -->

<?php //$this->renderPartial('//layouts/_footer'); ?>

</body>
</html>
