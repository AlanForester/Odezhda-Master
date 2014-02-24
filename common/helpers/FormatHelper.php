<?php

class FormatHelper {

    /**
     * Определение правильного окончания для числа
     * @param int $n исходное число
     * @param string $form1 единственное число
     * @param string $form2 множественное число
     * @param string $form5 множественное число
     * @return mixed
     */
    public static function plural($n, $form1, $form2, $form5) {
        $n = abs($n) % 100;
        $n1 = $n % 10;
        if ($n > 10 && $n < 20) return $form5;
        if ($n1 > 1 && $n1 < 5) return $form2;
        if ($n1 == 1) return $form1;
        return $form5;
    }

    /**
     * Определение цены с наценкой, округление до целых
     * @param $price
     */
    public static function markup($price) {
        return round($price*(1+Yii::app()->params['markup']/100)).' р.';
    }

    /**
     * Определение цены с наценкой, округление до целых
     * @param $price
     */
    public static function markupNumber($price) {
        return round($price*(1+Yii::app()->params['markup']/100));
    }

    /**
     * Определение общей(умножение на количество товаров) цены с наценкой, округление до целых
     * @param $price
     */
    public static function markupSummary($price, $count) {
        return round($count*$price*(1+Yii::app()->params['markup']/100)).' р.';
    }

}