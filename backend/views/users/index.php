<?php
Yii::app()->user->setFlash(
    TbHtml::ALERT_COLOR_WARNING,
    '<h4>Внимание!</h4>
    Не до конца реализован весь функционал на данной странице.<br /><br />
    <b>Работает:</b>
    <ul>
        <li>Быстрое редактирование, включая запись в бд</li>
        <li>Переход в карточку управления пользователем</li>
        <li>Пагинация</li>
        <li>Кнопки в карточке редактирования</li>
        <li>Загрузка списка групп, где это необходимо</li>
        <li>Реакция всех элементов на странице. То, что не реализовано - с заглушкой</li>
    </ul>
    <br />
    <b>НЕ Работает:</b>
    <ul>
        <li>сохранения пользователя из карточки</li>
        <li>фильтры</li>
        <li>сортировка и кол-во отображаемых записей</li>
        <li>удаление и пакетные операции</li>
    </ul>
    '
);

$this->pageButton = [
    TbHtml::linkButton(
        'Добавить',
        [
            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
            'icon' => TbHtml::ICON_PLUS,
            'url' => Yii::app()->createUrl("/users/add"),
            'type' => 'success',
        ]
    ),
    TbHtml::htmlButton(
        'Удалить',
        [
            'icon' => TbHtml::ICON_REMOVE,
            'url' => '#',
            'onClick' => 'js: (function(){
                var cb = $("input[name=\'userids[]\']:checked");
                if (cb.length==0){
                    alert("Ввыберите минимум один обьект в списке");
                }else{
                    alert("Пакетное удаление еще не реализовано");
                }
            })()'
        ]
    ),
    TbHtml::htmlButton(
        'Пакетная обработка',
        [
            'icon' => TbHtml::ICON_TASKS,
            'url' => '#',
            'onClick' => 'js: (function(){
                var cb = $("input[name=\'userids[]\']:checked");
                if (cb.length==0){
                    alert("Ввыберите минимум один обьект в списке");
                }else{
                    alert("Пакетная обработка еще не реализована");
                }
            })()'
        ]
    ),
]
?>
<div class="span2">
    <div id="sidebar">
        <h4 class="page-header">Фильтр:</h4>
        <?=
        TbHtml::dropDownList(
            'dropDown',
            '',
            array_merge(['- По группе -'], $this->groups),
            [
                'onChange'=>'js: (function(){
                    alert("Фильтр еще не реализован");
                })()'
            ]
        );
        ?>
        <hr class="hr-condensed">
        <?=
        TbHtml::dropDownList(
            'dropDown',
            '',
            [
                '- По дате регистрации -',
                'сегодня',
                'за прошлую неделю',
                'за прошлый месяц',
                'последние 3 месяца',
                'последние 6 месяцев',
                'за прошлый год',
                'больше года назад',
            ],
            [
                'onChange'=>'js: (function(){
                    alert("Фильтр еще не реализован");
                })()'
            ]
        );
        ?>
        <hr class="hr-condensed">
    </div>
</div>

<div class="span10">
    <div>
        <?php
        echo TbHtml::textField(
            'appendedInputButtons',
            '',
            [
                //                'class'=>'tooltip',
                'rel' => 'tooltip',
                'title' => 'Поиск по текстовым полям',
                'placeholder' => 'Поиск',
                'append' =>
                    TbHtml::button('', ['icon' => TbHtml::ICON_SEARCH, 'title' => 'Искать', 'rel' => 'tooltip']) .
                    ' ' .
                    TbHtml::button('', ['icon' => TbHtml::ICON_REMOVE, 'title' => 'Очистить', 'rel' => 'tooltip'])
            ]
        );





        echo TbHtml::dropDownList(
            'dropDown',
            '',
            [
                '5',
                '10',
                '15',
                '20',
                '25',
                '30',
                '50',
                '100',
                'Все',
            ],
            [
                'class'=>'pull-right',
                'style'=>'width:50px;margin-left:5px;',
                'onChange'=>'js: (function(){
                    alert("Сортировка еще не реализован");
                })()'
            ]
        );

        echo TbHtml::dropDownList(
            'dropDown',
            '',
            [
                'Порядок отображения',
                'По убыванию',
                'По возрастанию',
            ],
            [
                'class'=>'pull-right',
                'style'=>'width:150px;margin-left:5px;',
                'onChange'=>'js: (function(){
                    alert("Сортировка еще не реализован");
                })()'
            ]
        );

        echo TbHtml::dropDownList(
            'dropDown',
            '',
            [
                'Имя',
                'Фамилия',
                'E-Mail',
                'Группа',
                'Последний визит',
                'ID',
            ],
            [
                'class'=>'pull-right',
                'style'=>'width:150px;margin-left:5px;',
                'onChange'=>'js: (function(){
                    alert("Сортировка еще не реализован");
                })()'
            ]
        );
        ?>
    </div>

    <?php
    $this->widget(
        'yiiwheels.widgets.grid.WhGridView',
        array(
            'id' => 'usersgrid',
            'dataProvider' => $this->gridDataProvider,
            'itemsCssClass' => 'table-bordered items',
            //    'filter'=>$this->model,
            'fixedHeader' => true,
            'responsiveTable' => true,
            'type' => 'striped bordered',
            'headerOffset' => 40, // 40px is the height of the main navigation at bootstrap
            'template' => '<div class="table-block">{items}</div>
      <div class="row pager-block">
          <div class="span6 pull-right">{summary}</div>
          <div class="span6 pull-left">{pager}</div>
      </div>',
            'summaryText' => 'Отображение записей {start}-{end} из {count}',
            'columns' => array(
                [
                    'class' => 'CCheckBoxColumn',
                    'selectableRows' => 2,
                    'checkBoxHtmlOptions' => [
                        'name' => 'userids[]',
                    ],
                    'value' => '$data["id"]',
                    'checked' => null,
                ],
                [
                    'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                    'type' => 'text',
                    'header' => 'Имя',
                    'name' => 'firstname',
                    'headerHtmlOptions' => [
                        'style' => 'text-align: left;'
                    ],
                    'htmlOptions' => [
                        'style' => 'text-align: left;'
                    ],
                    'editable' => [
                        'placement' => 'right',
                        'emptytext' => 'не задано',
                        'url' => Yii::app()->createUrl("/users/update"),
                        //'source'   => $this->createUrl('users/update'),
                    ]
                ],
                [
                    'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                    'type' => 'text',
                    'header' => 'Фамилия',
                    'name' => 'lastname',
                    'headerHtmlOptions' => [
                        'style' => 'text-align: left;'
                    ],
                    'htmlOptions' => [
                        'style' => 'text-align: left;'
                    ],
                    'editable' => [
                        'placement' => 'right',
                        'emptytext' => 'не задано',
                        'url' => Yii::app()->createUrl("/users/update"),
                    ]
                ],
                [
                    'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                    'type' => 'text',
                    'header' => 'E-mail',
                    'name' => 'email_address',
                    'headerHtmlOptions' => [
                        'style' => 'text-align: center;'
                    ],
                    'htmlOptions' => [
                        'style' => 'text-align: center;'
                    ],
                    'editable' => [
                        'placement' => 'right',
                        'emptytext' => 'не задано',
                        'url' => Yii::app()->createUrl("/users/update"),
                    ]
                ],
                [
                    'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                    'header' => 'Группа',
                    'name' => 'groups_id',
                    'headerHtmlOptions' => [
                        'style' => 'width: 200px; text-align: center;'
                    ],
                    'htmlOptions' => [
                        'style' => 'width: 200px; text-align: center;'
                    ],
                    'editable' => [
                        'type' => 'select',
                        'placement' => 'right',
                        'emptytext' => 'не задано',
                        'url' => Yii::app()->createUrl("/users/update"),
                        'source' => $this->createUrl('groups/list'),
                    ]
                ],
                [
                    'header' => 'Последний визит',
                    'name' => 'logdate',
                    'headerHtmlOptions' => [
                        'style' => 'text-align: center;'
                    ],
                    'htmlOptions' => [
                        'style' => 'text-align: center;'
                    ],
                ],
                [
                    'header' => 'Id',
                    'name' => 'id',
                    'headerHtmlOptions' => [
                        'style' => 'width: 30px; text-align: center;'
                    ],
                    'htmlOptions' => [
                        'style' => 'width: 30px; text-align: center;'
                    ],
                ],
                [
                    //            'header' => 'Редактировать',
                    'htmlOptions' => [
                        'width' => '50px'
                    ],
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'viewButtonUrl' => 'Yii::app()->createUrl("/users/show", array("id"=>$data["id"]))',
                    'updateButtonUrl' => 'Yii::app()->createUrl("/users/edit", array("id"=>$data["id"]))',
                    'deleteButtonUrl' => 'Yii::app()->createUrl("/users/delete", array("id"=>$data["id"]))',
                ]
            ),
        )
    );
    ?>
</div>