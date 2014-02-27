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
