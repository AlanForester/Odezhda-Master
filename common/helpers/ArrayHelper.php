<?php


class ArrayHelper
{

    public static function arrayToUl($array)
    {
        if (!empty($array)) {
            $ul = '<ul style="list-style-type: none;">';
            foreach ($array as $k => $v) {
                if (is_array($v)){
                    $v = $k.': '.join(', ',$v);
                }
                $ul .= '<li>' . $v . '</li>';
            }
            $ul .= '</ul>';

            return $ul;
        }
    }
}