<?php

class Grid extends CWidget {

    /**
     * Кнопки управления для контроллера
     * @var array
     */
    //    public $buttons = [];
    //public $pageButton = [];

    /**
     * Элементы фильтра
     * @var array
     */
    public $filter = null;

    /**
     * Пункты бокового под-меню
     * @var null
     */
    public $submenu = null;

    public $hrTemplate = '<hr class="hr-condensed">';

    /**
     * Содержимое текстового фильтра
     * @var string
     */
    public $textSearch = '';

    /**
     * Выбранное поле сортировки
     * @var string
     */
    //    public $order_field = '';

    /**
     * Параметры сортировки
     * @var array
     */
    public $order = [
        'active' => '',
        'fields' => [],
        'direct' => '',
    ];

    /**
     * Выбранный вариант кол-во записей на странице
     * @var int
     */
    public $pageSize = CPagination::DEFAULT_PAGE_SIZE;

    /**
     * Данные для таблицы
     * @var null
     */
    public $dataProvider = null;

    /**
     * Контроллер страницы
     * @var
     */
    //    public $controller;

    public function init() {
        //        if ($this->controller){
        //            $this->controller->pageButton = $this->pageButton;
        //        }

    }

    public function run() {

        // определеяем, нужно ли показывать 2 колонки
        $twoColumn = ($this->submenu || $this->filter);

        if ($twoColumn) {
            echo '
            <div class="span2">
                <div id="sidebar">' . $this->renderSubmenu() . $this->renderFilter() . '</div>
            </div>';
        }

        echo '
            <div class="span' . ($twoColumn ? '10' : '12') . '">
                <div>' . $this->renderTop() . $this->renderGrid() . '</div>
            </div>
        ';
    }

    public function renderSubmenu() {
        if ($this->submenu) {
            return
                '<h4 class="page-header">Подразделы:</h4>' .

                $this->widget(
                    'bootstrap.widgets.TbNav',
                    [
                        'items' => $this->submenu
                    ],
                    true
                );

            //$this->hrTemplate;
        }

        return null;
    }

    public function renderFilter() {
        if ($this->filter) {
            return '<h4 class="page-header">Фильтр:</h4>' . join($this->hrTemplate, $this->filter);
        }

        return null;
    }

    public function renderTop() {
        return
            TbHtml::textField(
                'text_search',
                '',
                [
                    'rel' => 'tooltip',
                    'title' => 'Поиск по текстовым полям',
                    'placeholder' => 'Поиск',
                    'value' => $this->textSearch,
                    'append' =>
                        TbHtml::button(
                            '',
                            [
                                'icon' => TbHtml::ICON_SEARCH,
                                'title' => 'Искать',
                                'rel' => 'tooltip',
                                'onClick' => 'js: (function(){
                                $.fn.yiiGridView.update(
                                    "whgrid",
                                    {
                                        data:{
                                            text_search:$("#text_search").val()
                                        }
                                    }
                                )
                            })()'
                            ]
                        ) .
                        ' ' .
                        TbHtml::button(
                            '',
                            [
                                'icon' => TbHtml::ICON_REMOVE,
                                'title' => 'Очистить',
                                'rel' => 'tooltip',
                                'onClick' => 'js: (function(){
                                $.fn.yiiGridView.update(
                                    "whgrid",
                                    {
                                        data:{
                                            text_search:""
                                        }
                                    }
                                )
                                $("#text_search").val("");
                            })()'
                            ]
                        )
                ]
            ) .

            '<div class="btn-group pull-right">
                <div class="btn-group">
            ' .
            TbHtml::dropDownList(
                'order_field',
                $this->order['active'],
                $this->order['fields'],
                [
                    'class' => 'pull-right',
                    'style' => 'width:150px;margin-left:5px;',
                    'onChange' => 'js: (function(){
                        $.fn.yiiGridView.update(
                            "whgrid",
                            {
                                data:{
                                    order_field:$("#order_field").val()
                                }
                            }
                        )
                    })()'
                ]
            ) .
            '   </div>
            <div class="btn-group">' .

            TbHtml::dropDownList(
                'order_direct',
                $this->order['direct'],
                [
                    '' => 'Порядок отображения',
                    'down' => 'По убыванию',
                    'up' => 'По возрастанию',
                ],
                [
                    'class' => 'pull-right',
                    'style' => 'width:200px;margin-left:5px;',
                    'onChange' => 'js: (function(){
                        $.fn.yiiGridView.update(
                            "whgrid",
                            {
                                data:{
                                    order_direct:$("#order_direct").val()
                                }
                            }
                        )
                    })()'
                ]
            ) .

            '   </div>
            <div class="btn-group">' .

            TbHtml::dropDownList(
                'page_size',
                $this->pageSize,
                [
                    '5' => '5',
                    '10' => '10',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '50' => '50',
                    '100' => '100',
                    'all' => 'Все',
                ],
                [
                    'class' => 'pull-right',
                    'style' => 'width:70px;margin-left:5px;',
                    'onChange' => 'js: (function(){
                        $.fn.yiiGridView.update(
                            "whgrid",
                            {
                                data:{
                                    page_size:$("#page_size").val()
                                }
                            }
                        )
                    })()'
                ]
            ) .

            '   </div>
            </div>';
    }


    public function renderGrid() {
        return $this->widget(
            'yiiwheels.widgets.grid.WhGridView',
            array(
                'id' => 'whgrid',
                //        'CssClass'=>'dataTables_wrapper',
                'dataProvider' => $this->dataProvider,
                'itemsCssClass' => 'table-bordered items',
                //    'filter'=>$this->model,
                'fixedHeader' => true,
                'responsiveTable' => true,
                'type' => 'striped bordered',
                'headerOffset' => 106,
                'htmlOptions' => [
                    'class' => 'grid-view dataTables_wrapper'
                ],
                'emptyText' => 'Нет данных для отображения',

                // todo: pager - сделать tooltip на кнопки
                'template' => '
                    <div class="table-block">{items}</div>
                    <div class="row pager-block">
                        <div class="span6 pull-right">{summary}</div>
                        <div class="span6 pull-left">{pager}</div>
                    </div>
                ',
                'summaryText' => 'Отображение записей {start}-{end} из {count}',
                'columns' => array(
                    [
                        'class' => 'backend.widgets.ace.CheckBoxColumn',
                        'selectableRows' => 2,
                        'checkBoxHtmlOptions' => [
                            'name' => 'gridids[]'
                        ],
                        // todo: перенести в виджет
                        'headerTemplate' => '<label>{item}<span class="lbl"></span></label>',
                        'value' => '$data["id"]',
                        'checked' => null,
                    ],
                    [
                        'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
                        'type' => 'text',
                        'header' => 'Имя',
                        'name' => 'firstname',
                        'headerHtmlOptions' => [
                        ],
                        'htmlOptions' => [
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
                        ],
                        'htmlOptions' => [
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
                        'name' => 'email',
                        'headerHtmlOptions' => [
                        ],
                        'htmlOptions' => [
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
                        'name' => 'group_id',
                        'headerHtmlOptions' => [
                        ],
                        'htmlOptions' => [
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
                        ],
                        'htmlOptions' => [
                        ],
                    ],
                    [
                        'header' => 'Id',
                        'name' => 'id',
                        'headerHtmlOptions' => [
                        ],
                        'htmlOptions' => [
                        ],
                    ],
                    [
                        'header' => 'Действие',
                        'htmlOptions' => [
                            'class' => 'action-buttons',
                            'width' => '50px'
                        ],
                        'deleteButtonOptions' => [
                            'class' => 'red bigger-130',
                            'title' => 'Удалить',
                        ],
                        'updateButtonOptions' => [
                            'class' => 'green bigger-130',
                            'title' => 'Изменить',
                        ],
                        'viewButtonOptions' => [
                            'class' => 'bigger-130',
                            'title' => 'Просмотр',
                            'onClick' => 'js: (function(){
                                bootbox.alert("Здесь должно быть модальное окно с просмотром всей информации пользователя, без возможности редактирования");
                            })()'
                        ],
                        'class' => 'bootstrap.widgets.TbButtonColumn',
                        'afterDelete' => 'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                        'viewButtonUrl' => null, //'Yii::app()->createUrl("/users/show", array("id"=>$data["id"]))',
                        'updateButtonUrl' => 'Yii::app()->createUrl("/users/edit", array("id"=>$data["id"]))',
                        'deleteButtonUrl' => 'Yii::app()->createUrl("/users/delete", array("id"=>$data["id"]))',
                    ]
                ),
            ),
            true
        );
    }

}