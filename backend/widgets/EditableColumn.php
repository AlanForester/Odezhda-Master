<?php
/**
 * EditableColumn class
 *
 * расширение WhEditableColumn, позволяющее редактировать
 * поля в строках, динамически добавленных в список,
 * который был пустым при загрузке страницы
 */
Yii::import('yiiwheels.widgets.editable.WhEditableColumn');

class EditableColumn extends WhEditableColumn
{
    public $modelName;

    public function init()
    {
        parent::init();

        //инициализирует скрипты, даже если список пустой
        //для того, чтобы впоследствии добавленные строки
        //имели редактируемые поля
        $options = CMap::mergeArray($this->editable, [
            'liveSelector'=>($this->modelName ? $this->modelName.'_' : '') . $this->name,
            'liveTarget'=>$this->grid->id,
            'name'=>$this->name,
            'title'=>'Введите значение',
            'params'=>['scenario'=>'update'],
            'apply'=>true,
        ]);
        ob_start();
        $this->grid->controller->widget('WhEditable', $options);
        ob_get_clean();
    }

}
