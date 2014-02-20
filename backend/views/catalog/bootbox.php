<?php
$this->widget(
    'backend.widgets.CompactGrid',
    [
        'gridId' => 'catalog_grid',

        'order' => [
            'active' => $criteria['order_field'],
            'fields' => [
                //'order'=>'Сортировка',
                //'id' => 'ID',
                'name' => 'Название',
                'model' => 'Код товара',
                //'date_add' => 'Дата добавления',
                'manufacturers'=>'Производитель',
                'price' => 'Цена',
                //'quantity' => 'Кол-во',
                //'weight' => 'Вес',
                //'status'=>'Наличие',
                //'xml'=>'XML',

            ],
            'direct' => $criteria['order_direct']
        ],

        'pageSize' => $criteria['page_size'],

        'textSearch' => $criteria['text_search'],

        'dataProvider' => $gridDataProvider,

        'gridColumns' => [
            [
                'header' => 'Название',
                'name' => 'name',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductOptions(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/selectoptions/') . '",
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
                        selectRetailOrdersProductOptions(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/selectoptions/') . '",
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
                        selectRetailOrdersProductOptions(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/selectoptions/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ],
            /*[
                'header' => 'Размеры',
                'name' => 'catalog_options_values',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductOptions(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/selectoptions/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ],*/
            [
                'header' => 'Производитель',
                'name' => 'manufacturers',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductOptions(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/selectoptions/') . '",
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
                        selectRetailOrdersProductOptions(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/selectoptions/') . '",
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
                        selectRetailOrdersProductOptions(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/selectoptions/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ],
            [
                'class' => 'backend.widgets.IDColumn',
                'name' => 'gridids[]',
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectRetailOrdersProductOptions(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/catalog/selectoptions/') . '",
                            "'. Yii::app()->createUrl('/retail_orders_products/queue/') .'"
                        );
                    })()',
                ],
            ]
        ],
    ]
);
