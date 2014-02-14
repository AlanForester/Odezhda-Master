<?php
//todo откорректировать
// таблица
$this->widget(
    'backend.widgets.CompactGrid',
    [
        'gridId' => 'customers_grid',

        'pageSize' => $criteria['page_size'],

        'dataProvider' => $gridDataProvider,

        'gridColumns' => [
            [
                'name' => 'firstname',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectCustomer(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/customers/info/') . '",
                            "'. Yii::app()->createUrl('/customers/edit/') .'"
                        );
                    })()',
                ],
            ],
            [
                'name' => 'lastname',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectCustomer(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/customers/info/') . '",
                            "'. Yii::app()->createUrl('/customers/edit/') .'"
                        );
                    })()',
                ],
            ],
            [
                'name' => 'email',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectCustomer(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/customers/info/') . '",
                            "'. Yii::app()->createUrl('/customers/edit/') .'"
                        );
                    })()',
                ],
            ],
            [
                'name' => 'phone',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectCustomer(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/customers/info/') . '",
                            "'. Yii::app()->createUrl('/customers/edit/') .'"
                        );
                    })()',
                ],
            ],
            [
                'name' => 'id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        selectCustomer(
                            event,
                            ' . ($id ? : 0) . ',
                            "' . Yii::app()->createUrl('/customers/info/') . '",
                            "'. Yii::app()->createUrl('/customers/edit/') .'"
                        );
                    })()',
                ],
            ],
        ],
    ]
);
