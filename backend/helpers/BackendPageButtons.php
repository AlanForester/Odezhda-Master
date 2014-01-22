<?php

class BackendPageButtons {

    public static function addButton($url = '', $option = [], $title = 'Добавить') {
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

    public static function removeButton($url = '', $option = [], $title = 'Удалить') {
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
                                                "usersgrid",
                                                {
                                                    url:"' . Yii::app()
                                                                ->createUrl($url) . '",
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

    public static function massButton($url = '', $option = [], $title = 'Пакетная обработка') {
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

    public static function saveButton($option = [], $title = 'Сохранить') {
        return
            TbHtml::htmlButton(
                  $title,
                  array_merge([
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
    }

}