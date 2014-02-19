<?php

Yii::import('zii.widgets.grid.CGridColumn');

/**
 * Class IDColumn
 * генерация колонки с полями, содержащими идентификатор строки
 * и скрытое поле с идентификатором
 */
class IDColumn extends CGridColumn {

    public $header = 'ID';
    public $name = 'id[]';
    public $value = '$data["id"]';
    public $htmlOptions=array();

    protected function renderDataCellContent($row, $data) {
        if($this->value!==null)
            $value=$this->evaluateExpression($this->value,array('data'=>$data,'row'=>$row));
        else
            $value=$this->grid->dataProvider->keys[$row];
        echo $value . CHtml::hiddenField($this->name,$value,$this->htmlOptions);
    }
}