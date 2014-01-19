<?php

/**
 * Class CheckBoxColumn
 * генерация колонки чек-боксов в обертке для темы ace
 */
class CheckBoxColumn extends CCheckBoxColumn {

    protected function renderDataCellContent($row, $data) {
        ob_start();
        parent::renderDataCellContent($row, $data);
        $result = ob_get_contents();
        ob_end_flush();

        echo '<label>' . $result . '<span class="lbl"></span></label>';
    }
}