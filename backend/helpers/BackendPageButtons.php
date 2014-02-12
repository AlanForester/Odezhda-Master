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

    public static function edit($url = '', $option = [], $title = 'Редактировать') {
        return
            TbHtml::linkButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_USER,
                        'buttonType' => 'link',
                        'url' => Yii::app()
                            ->createUrl($url),
                        //'type'=>TbHtml::BUTTON_TYPE_LINK,
                        'class' => 'btn-small',
                        'color' => TbHtml::BUTTON_COLOR_INFO,
                    ], $option
                )
            );
    }

    public static function selectCustomer(/*$url = '',*/ $option = [], $title = 'Выбрать покупателя') {
        return
            TbHtml::htmlButton(
                $title,
                array_merge(
                    [
                        'icon' => TbHtml::ICON_USER,
                        'url' => '#',
                        'class' => 'btn-small',
                        'onClick' => 'js: (function(){
                                $.ajax({
                                    url: "' . Yii::app()->createUrl('/customers/index/') . '?ajax=whgrid",
                                    dataType : "html",
                                    success: function (data, textStatus) {
                                        bootbox.dialog({
                                            message: "<div>" + data +
                                                "</div>",
                                            title: "Выбор покупателя",
                                            buttons: {
                                                success: {
                                                    label: "Выбрать",
                                                    className: "btn-small btn-success",
                                                    callback: function() {

                                                    }
                                                },
                                                cancel: {
                                                    label: "Отмена",
                                                    className: "btn-small btn-danger",
                                                    callback: function() {

                                                    }
                                                }
                                            }
                                        });
                                        jQuery("#whgrid").yiiGridView({
                                            "ajaxUpdate":["whgrid"],
                                            "ajaxVar":"ajax",
                                            "pagerClass":"pagination",
                                            "loadingClass":"grid-view-loading",
                                            "filterClass":"filters",
                                            "tableClass":"table-bordered items table table-striped table-bordered",
                                            "selectableRows":2,
                                            "enableHistory":false,
                                            "updateSelector":"{page}, {sort}",
                                            "filterSelector":"{filter}",
                                            "pageVar":"Customer_page",
                                            "afterAjaxUpdate": function(id, data) {
                                                $("#whgrid").trigger("ajaxUpdate.editable");
                                                (function(){
                                                    $("#whgrid").trigger("ajaxUpdateTree");
                                                }).apply(this, arguments);
                                        }});
                                    }
                                });
                            })()'
                    ], $option
                )
            );
    }

}