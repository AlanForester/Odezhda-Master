<?php
$lghtbox="
jQuery(document).ready(function($){
    $('.lightbox').lightbox();
});
";
$basket = "
jQuery(document).ready(function($){
    //добавление товара в корзину
    $('.addToCart').live('click',function(){
        var size = $(this).siblings('.product_size').val();
        if(!size){
            size = $('a.razmer-one.selected').attr('href');
        }
        var params = size?size:0;

        if(!size || params) {
            $.ajax({
                      type: 'POST',
                      url: '" . $this->createUrl('/social/addToCart') . "',
                      data: ({
                            product_id : $(this).next('.product_id').val(),
                            params : params,
                      }),
                      success: function(data) {
                            if (data){
                                $('.open .col').text(data);
                                $('.bottom-panel').stop(true,true).effect('highlight', {}, 2000);
                            }

                      }
                  });
        }
        else{
            alert ('Выберите, пожалуйста, размер товара.');
        }
    });

    //инициализация выдвигающийся панельки и кнопок
        $('#jqeasypanel').jqEasyPanel({
            position: 'bottom'
        });
        $('.open').click(function(){
            $('#jqeasytrigger').animate({bottom:'246px'});
        });
        $('.close').click(function(){
            $('#jqeasytrigger').animate({bottom:'0px'});
        });
        $('.goods-slider ul#items').easyPaginate({
                step:4
        });
});
";
Yii::app()->getClientScript()->registerScript('basket', $basket, CClientScript::POS_END);
Yii::app()->getClientScript()->registerScript('lghtbox', $lghtbox, CClientScript::POS_END);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?= CHtml::encode($this->pageTitle); ?></title>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#catalog_order').live('change',function () {
                $.post("<?php $this->createUrl('/social/index') ?>", {order: $('#catalog_order').val()}, function( data ) {
                    $('body').html(data);
                });
            });
        });
    </script>
</head>
<body>
<?php echo $content ?>
</body>
</html>
