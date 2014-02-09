<?php
/**
 * @var RetailController $this
 * @var string $content
 */

$js = "
function rewrite_days()
{
    var days = document.getElementById('day');
    var month = document.getElementById('month');
    var year = document.getElementById('year');
    var days_in_month = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
        if ((year.value % 4 == 0) && (month.value == 2))
        {
            days.length = 29;
            days.item(28).value = 29;
            days.item(28).text = 29;
        }
        else
        {
            days.length = days_in_month[month.value-1];
            for (var i = 29; i < days.length; i++)
            {
                days.item(i-1).value = i;
                days.item(i-1).text = i;
            }
        }
}
";

// разместить скрипт на странице
Yii::app()->getClientScript()->registerScript('some_name', $js, CClientScript::POS_END);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>

<?= $content; ?>

</body>
</html>
