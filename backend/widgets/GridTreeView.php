<?php
Yii::import('yiiwheels.widgets.grid.WhGridView');
class GridTreeView extends WhGridView {

    public function renderTableRow($row)
    {
        $htmlOptions = array();
        if ($this->rowHtmlOptionsExpression !== null) {
            $data = $this->dataProvider->data[$row];

            $options = $this->evaluateExpression(
                $this->rowHtmlOptionsExpression,
                array('row' => $row, 'data' => $data)
            );
            if (is_array($options)) {
                $htmlOptions = $options;
            }
        }
        if ($this->rowCssClassExpression !== null) {
            $data = $this->dataProvider->data[$row];
            $class = $this->evaluateExpression($this->rowCssClassExpression, array('row' => $row, 'data' => $data));
        } elseif (is_array($this->rowCssClass) && ($n = count($this->rowCssClass)) > 0) {
            $class = $this->rowCssClass[$row % $n];
        }
        if (!empty($class)) {
            if (isset($htmlOptions['class'])) {
                $htmlOptions['class'] .= ' ' . $class;
            } else {
                $htmlOptions['class'] = $class.'-';
            }
        }
//        print_r($this->dataProvider->data);exit;
        $css='treegrid-'.$this->dataProvider->data[$row]['id'].' ';
        if(isset($this->dataProvider->data[$row]['loaded'])){
            $css.='loaded ';
        }
        if (!empty($this->dataProvider->data[$row]['childCount'])){
            $css.='hasChildren ';
        }
        if ($this->dataProvider->data[$row]['parent_id']!='0'){
            $css.=' treegrid-parent-'.$this->dataProvider->data[$row]['parent_id'];//$htmlOptions['class']='treegrid-'.$this->dataProvider->data[$row]['id'];
        }
        $htmlOptions['class']=$css;

        echo CHtml::openTag('tr', $htmlOptions);
        foreach ($this->columns as $column) {
            echo $this->displayExtendedSummary && !empty($this->extendedSummary['columns']) ? $this->parseColumnValue(
                $column,
                $row
            ) : $column->renderDataCell($row);
        }
        echo CHtml::closeTag('tr');
    }
 
}