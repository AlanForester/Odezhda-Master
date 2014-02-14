<?php
//todo откорректировать
// таблица
$this->widget(
    'backend.widgets.CompactGrid',
    [
        'gridId' => 'catalog_grid',

        'pageSize' => $page_size,

        'dataProvider' => $this->gridDataProvider,

        'gridColumns' => [
            [
                'header' => 'Название',
                'name' => 'name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ], [
                'header' => 'Код',
                'name' => 'model',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'header' => 'Категории',
                'name' => 'categories_list',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'header' => 'Размеры',
                'name' => 'catalog_options_values',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'header' => 'Производитель',
                'name' => 'manufacturers',
                'headerHtmlOptions' => [
                ],
            ],
            [
                'header' => 'Цена (руб.)',
                'name' => 'price',
                'headerHtmlOptions' => [
                ],
            ],
            [
                'header' => 'Количество',
                'name' => 'quantity',
            ],
            [
                'header' => 'Покупок',
                'name' => 'count_orders'
            ],
            [
                'header' => 'Вес (кг)',
                'name' => 'weight',
            ],
            [
                'header' => 'Дата поступления',
                'name' => 'date_add'

            ],
            [
                'header' => 'Сортировка',
                'name' => 'order',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'header' => 'XML',
                'name' => 'xml',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'header' => 'Наличие',
                'name' => 'status',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'header' => 'ID',
                'name' => 'id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ]
            ]
        ],
    ]
);
