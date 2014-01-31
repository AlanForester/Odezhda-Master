<?php

class Grid extends CWidget {

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
    public $order = [];

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
     * Колонки таблицы
     * @var array
     */
    public $gridColumns = [];

    /**
     * PHP код для создания ссылки кнопок. Поддерживаются ключи: <b>show, edit, delete</b> <br>
     * Пример содержимого для одной кнопки: 'Yii::app()->createUrl("/users/delete", array("id"=>$data["id"]))'
     * @var array
     */
    public $gridButtonsUrl = [];

    /**
     * PHP код, отвечающий для получения идентификатора данных из дата-провайдера для записи
     * @var string
     */
    public $gridIdData = '$data["id"]';

    /**
     * Опции для виджета таблицы
     * @var array
     */
    public $gridOptions = [];

    /**
     * Геренировать дерево
     * @var bool
     */
    public $gridTree = false;

    /**
     * Контроллер страницы
     * @var
     */
    //    public $controller;

    public function init() {
        // todo: сделать перепроверку собственных обязательных свойств

        // ключи для всех кнопок всегда должны существоать
        $this->gridButtonsUrl = array_merge(
            [
                'show' => null,
                'edit' => null,
                'delete' => null
            ], $this->gridButtonsUrl
        );

        // ключи всех параметров сортировки должны существовать
        $this->order = array_merge(
            [
                'active' => '',
                'fields' => [],
                'direct' => '',
            ], $this->order
        );
    }

    public function run() {
        if ($this->controller->isAjax) {
            echo $this->renderGrid();
            return;
        }

        // определеяем, нужно ли показывать 2 колонки
        $twoColumn = ($this->submenu || $this->filter);

        // левая колонка с фильтром и под-меню
        if ($twoColumn) {
            echo '
            <div class="span2">
                <div id="sidebar" class="sidebar">' . $this->renderSubmenu() . $this->renderFilter() . '</div>
            </div>';
        }

        // основная колонка
        echo '
            <div class="span' . ($twoColumn ? '10' : '12') . '">
                <div>' . $this->renderTop() . $this->renderGrid() . '</div>
            </div>
        ';
    }

    /**
     * Проверка, является ли текущий пункт под-раздела тактивным
     * @param array $item данные пункта меню
     * @param string $route текущий запрос из контроллера
     * @return bool
     */
    protected function isItemActive($item, $route) {
        if (isset($item['url']) && is_array($item['url']) && !strcasecmp(trim($item['url'][0], '/'), $route)) {

            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if (!isset($_GET[$name]) || $_GET[$name] != $value) {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Генерация html кода под-меню
     * @return null|string
     */
    public function renderSubmenu() {
        if ($this->submenu) {
            $route = $this->controller->getRoute();

            // определяем текущий активный пункт
            foreach ($this->submenu as $n => $item) {
                $this->submenu[$n]['active'] = $this->isItemActive($item, $route);
            }

            return
                '<h4 class="page-header">Подразделы:</h4>' .

                $this->widget(
                    'bootstrap.widgets.TbNav',
                    [
                        'htmlOptions' => [
                            'class' => 'nav-list nav',
                        ],
                        'items' => $this->submenu
                    ],
                    true
                );

            //$this->hrTemplate;
        }

        return null;
    }

    /**
     * Генерация html кода фильтров
     * @return null|string
     */
    public function renderFilter() {
        if ($this->filter) {
            return '<h4 class="page-header">Фильтр:</h4>' . join($this->hrTemplate, $this->filter);
        }

        return null;
    }

    /**
     * Генерация html кода
     * @return string
     */
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
                array_merge(['' => '- Поле -'], $this->order['fields']),
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
                    '' => '- Направление -',
                    //                    '' => 'Порядок отображения',
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

        //        return false;
        return $this->widget(
            ($this->gridTree ? 'backend.widgets.GridTreeView' : 'yiiwheels.widgets.grid.WhGridView'),
            array_merge(
                $this->gridOptions,
                [
                    'id' => 'whgrid',
                    //        'CssClass'=>'dataTables_wrapper',
                    'dataProvider' => $this->dataProvider,
                    'itemsCssClass' => 'tree table-bordered items',
                    'afterAjaxUpdate'=>'function(){
                        $("#whgrid").trigger("ajaxUpdateTree");
                    }',
                    //    'filter'=>$this->model,
                    'fixedHeader' => true,
                    'responsiveTable' => true,
                    'type' => 'striped bordered',
                    'headerOffset' => 106,
                    'htmlOptions' => [
                        'class' => 'grid-view dataTables_wrapper'
                    ],

                    'selectableRows' => 2, // если 0 или 1 - чекбоксы перестают работать

                    'emptyText' => 'Нет данных для отображения',

                    // todo: pager - сделать tooltip на кнопки
                    'template' => '
                    <div class="table-block">{items}</div>
                    <div class="row pager-block">
                        <div class="span6 pull-right">{summary}</div>
                        <div class="span6 pull-left">{pager}</div>
                    </div>
                    ',
                    'summaryText' => 'Отображено записей {start}-{end} из {count}',
                    'columns' => array_merge(
                        [
                            [
                                'class' => 'backend.widgets.ace.CheckBoxColumn',

                                'checkBoxHtmlOptions' => [
                                    'name' => 'gridids[]'
                                ],
                                // todo: перенести в виджет
                                'headerTemplate' => '<label>{item}<span class="lbl"></span></label>',
                                'value' => $this->gridIdData,
                                'checked' => null,
                            ]
                        ],

                        $this->gridColumns,

                        [
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
                                bootbox.alert("Здесь должно быть модальное окно с просмотром всей информации записи, без возможности редактирования");
                            })()'
                                ],
                                'class' => 'bootstrap.widgets.TbButtonColumn',
                                'afterDelete' => 'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                                'viewButtonUrl' => null, //$this->gridButtonsUrl['show'],
                                'updateButtonUrl' => $this->gridButtonsUrl['edit'],
                                'deleteButtonUrl' => $this->gridButtonsUrl['delete'],
                            ]
                        ]
                    )
                ]
            ),
            true
        );
    }

}