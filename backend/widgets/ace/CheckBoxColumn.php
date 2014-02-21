<?php

/**
 * Class CheckBoxColumn
 * генерация колонки чек-боксов в обертке для темы ace
 */
class CheckBoxColumn extends CCheckBoxColumn {

    public $value = '$data["id"]';
    public $checked = null;
    public $headerTemplate='<label>{item}<span class="lbl"></span></label>';

    protected function renderDataCellContent($row, $data) {
        ob_start();
        parent::renderDataCellContent($row, $data);
        //$result = ob_get_contents();
        //ob_end_flush();
        $result = ob_get_clean();

        echo '<label>' . $result . '<span class="lbl"></span></label>';
    }
}