<?php
//todo откорректировать
// таблица
$this->widget(
    'backend.widgets.CompactGrid',
    [
        'gridId' => 'catalog_grid',

        'pageSize' => $criteria['page_size'],

        'dataProvider' => $gridDataProvider,

        'gridColumns' => [
            [
                'header' => 'Название',
                'name' => 'name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductAttributes(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/info/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ], [
                'header' => 'Код',
                'name' => 'model',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductAttributes(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/info/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ],
            [
                'header' => 'Категории',
                'name' => 'categories_list',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductAttributes(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/info/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ],
            [
                'header' => 'Размеры',
                'name' => 'catalog_options_values',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductAttributes(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/info/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ],
            [
                'header' => 'Производитель',
                'name' => 'manufacturers',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductAttributes(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/info/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ],
            [
                'header' => 'Цена (руб.)',
                'name' => 'price',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductAttributes(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/info/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ],
            /*[
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
            ],*/
            [
                'header' => 'Наличие',
                'name' => 'status',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductAttributes(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/info/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ],
            [
                'header' => 'ID',
                'name' => 'id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductAttributes(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/info/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ]
        ],
    ]
);
