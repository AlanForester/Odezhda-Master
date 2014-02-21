<?php

class BackendPageButtons {

    public static function add($url = '', $option = [], $title = 'Добавить') {
        return
            TbHtml::linkButton(
                $title,
                array_merge(
                    [
                        'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                        'icon' => TbHtml::ICON_PLUS,
                        'url' => Yii::app()
                                ->createUrl($url),
                        'type' => 'success',
                        'class' => 'btn-small'
                    ], $option
                )
            );
    }

    public static function remove($url = '', $option = [], $title = 'Удалить') {
        return
            TbHtml::htmlButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_REMOVE,
                        'color' => TbHtml::BUTTON_COLOR_DANGER,
                        'url' => '#',
                        'class' => 'btn-small',
                        'onClick' => 'js: (function(){
                            var cb = $("input[name=\'gridids[]\']:checked");
                            var ids = [];

                            if (cb.length==0){
                                bootbox.alert({message:"Ввыберите минимум один обьект в списке",title:"Ошибка"});
                            }else{
                                bootbox.confirm(
                                    "Вы уверены, что хотите удалить выбраные пункты?",
                                    function(options){
                                        if (options){
                                            cb.each(function(){
                                                ids.push($(this).val());
                                            });
                                            $.fn.yiiGridView.update(
                                                "whgrid",
                                                {
                                                    url:"' . Yii::app()->createUrl($url) . '",
                                                    data:{
                                                        mass_action:"delete",
                                                        ids:ids
                                                    }
                                                }
                                            )
                                        }
                                    }
                                );
                            }
                        })()'
                    ], $option
                )
            );
    }

    public static function mass($url = '', $option = [], $title = 'Пакетная обработка') {
        return
            TbHtml::htmlButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_TASKS,
                        'url' => '#',
                        'class' => 'btn-small',
                        'onClick' => 'js: (function(){
                            var cb = $("input[name=\'gridids[]\']:checked");
                            if (cb.length==0){
                                bootbox.alert({message:"Ввыберите минимум один обьект в списке",title:"Ошибка"});
                            }else{
                                bootbox.alert({message:"Пакетная обработка еще не реализована",title:"Ошибка"});
                            }
                        })()'
                    ], $option
                )
            );
    }

    public static function save($option = [], $title = 'Сохранить') {
        return
            TbHtml::htmlButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_PENCIL,
                        'buttonType' => 'link',
                        'url' => '#', //'/users/add',
                        //            'type'=>TbHtml::BUTTON_TYPE_SUBMIT,
                        'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                        'class' => 'btn-small',
                        'onClick' => 'js: (function(){
                            $("input[name=\'form_action\']").val("save");
                            $("#yw0").submit();
                        })()'
                    ], $option
                )
            );
        //todo: "#yw0" ссылается на первый виджет на странице, а должен ссылаться на конкретный id формы.
        //если первый виджет - не целевая форма, то кнопка не срабатывает.
        //нужно сменить ид, к примеру, на "#edit_form", затем во всех причастных view при подключении виджета
        //использовать строку конфига 'id' => 'edit_form', чтобы указать форму однозначно.
    }

    public static function apply($option = [], $title = 'Применить') {
        return
            TbHtml::htmlButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_OK,
                        'buttonType' => 'link',
                        'url' => '#',
                        //            'type'=>TbHtml::BUTTON_TYPE_SUBMIT,
                        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                        'class' => 'btn-small',
                        'onClick' => 'js: (function(){
                                        $("input[name=\'form_action\']").val("apply");
                                        $("#yw0").submit();
                                    })()'
                    ], $option
                )
            );

    }

    public static function cancel($url = '', $option = [], $title = 'Отмена') {
        return
            TbHtml::linkButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_REMOVE,
                        'buttonType' => 'link',
                        'url' => Yii::app()
                                ->createUrl($url),
                        //            'type'=>TbHtml::BUTTON_TYPE_LINK,
                        'class' => 'btn-small',
                        'color' => TbHtml::BUTTON_COLOR_DANGER,
                    ], $option
                )
            );
    }

    public static function cancelCustomer($url = '', $urlParams = '', $option = [], $title = 'Отмена') {
        return
            TbHtml::linkButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_REMOVE,
                        'buttonType' => 'link',
                        'url' => Yii::app()
                            ->createUrl($url) . $urlParams,
                        //            'type'=>TbHtml::BUTTON_TYPE_LINK,
                        'class' => 'btn-small',
                        'color' => TbHtml::BUTTON_COLOR_DANGER,
                    ], $option
                )
            );
    }

    public static function editCustomer($url = '', $urlParams = '', $option = [], $title = 'Редактировать') {
        return
            TbHtml::linkButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_USER,
                        'buttonType' => 'link',
                        'url' => Yii::app()->createUrl($url) . $urlParams,
                        //'type'=>TbHtml::BUTTON_TYPE_LINK,
                        'class' => 'btn-small',
                        'color' => TbHtml::BUTTON_COLOR_INFO,
                    ], $option
                )
            );
    }

    public static function selectCustomer($url = '', $option = [], $title = 'Выбрать покупателя') {
        return
            TbHtml::htmlButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_USER,
                        'url' => '#',
                        'class' => 'btn-small',
                        'onClick' => 'js: (function(){
                                showBootbox("Выбор покупателя");
                                loadGridIntoBootbox("customers_grid", "' . Yii::app()->createUrl($url) . '");
                            })()'
                    ], $option
                )
            );
    }

    public static function addProduct(/*$url = '',*/ $orderId = null, $option = [], $title = 'Добавить') {
        return
            TbHtml::htmlButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_PLUS,
                        'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                        'url' => '#',
                        'class' => 'btn-small',
                        'onClick' => 'js: (function(){
                                showBootbox("Выбор товара");
                                loadGridIntoBootbox("catalog_grid", "' . Yii::app()->createUrl('/catalog/bootbox/') . $orderId . '");
                            })()'
                    ], $option
                )
            );
    }

    public static function removeProducts($url = '', $orderId = null, $option = [], $title = 'Удалить') {
        return
            TbHtml::htmlButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_REMOVE,
                        'color' => TbHtml::BUTTON_COLOR_DANGER,
                        'url' => '#',
                        'class' => 'btn-small',
                        'onClick' => 'js: (function(){
                            var cb = $("#ropgrid input[name=\'gridids[]\']:checked");
                            var ids = [];

                            if (cb.length==0){
                                bootbox.alert({message:"Выберите минимум один обьект в списке",title:"Ошибка"});
                            }else{
                                bootbox.confirm(
                                    "Вы уверены, что хотите удалить выбранные пункты?",
                                    function(options){
                                        if (options){
                                            cb.each(function(){
                                                ids.push($(this).val());
                                            });
                                            $.fn.yiiGridView.update(
                                                "ropgrid",
                                                {
                                                    url:"' . Yii::app()->createUrl($url) . $orderId . '",
                                                    data:{
                                                        mass_action:"delete",
                                                        ids:ids
                                                    }
                                                }
                                            );
                                        }
                                    }
                                );
                            }
                        })()'
                    ], $option
                )
            );
    }

}