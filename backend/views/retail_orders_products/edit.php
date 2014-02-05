<?php

$this->pageTitle = 'Товары: ' . ($item->id ? 'редактирование информации о товаре в заказе (' . $item->products_name . ')' : 'новый товар в заказе');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/retail_orders_products/order/".$orderId)
];

/*$this->widget(
    'backend.widgets.SubMenu',
    [
        'submenu' => BackendSubMenu::retailOrder($orderId),
    ]
);*/
?>
    <div class="span10">
        <?php
        /**
         * @var TbActiveForm $form
         * @var RetailOrdersController $this
         */
        $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            [
                'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                //'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => [
                    'validateOnSubmit' => true,
                ]
            ]

        );
        ?>
        <div class="span12">
            <div class="span6">
                <fieldset>
                    <legend>Параметры товара в заказе</legend>
                    <?php
                    echo $form->hiddenField($item, 'id', []);
                    //echo $form->dropDownListControlGroup($item, 'retail_orders_id', $retailOrders, []);
                    echo $form->dropDownListControlGroup($item, 'products_id', $products, []);
                    echo $form->textFieldControlGroup($item, 'products_name', []);
                    echo $form->textFieldControlGroup($item, 'products_model', []);
                    echo $form->numberFieldControlGroup($item, 'products_quantity', []);
                    echo $form->numberFieldControlGroup($item, 'products_price', []);
                    ?>

                </fieldset>
            </div>
        </div>
        <input type="hidden" name="form_action" value="save">
        <?php $this->endWidget(); ?>
    </div>