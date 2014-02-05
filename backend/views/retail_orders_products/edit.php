<?php

$this->pageTitle = 'Товары: ' . ($item->id ? 'редактирование товара номер ' . $item->id . ' (' . $item->products_model . ')' : 'новый товар в заказе');

$this->pageButton = [
    BackendPageButtons::save(),
    BackendPageButtons::apply(),
    BackendPageButtons::cancel("/retail_orders_products/order/".$orderId)
];

$this->widget(
    'backend.widgets.SubMenu',
    [
        'submenu' => BackendSubMenu::retailOrder($item->id),
    ]
);
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
                    <legend>Основные параметры товара</legend>
                    <?php
                    ?>

                </fieldset>
            </div>

            <div class="span6">
                <fieldset>
                    <legend>Дополнительная информация</legend>
                    <?php
                    ?>
                </fieldset>
            </div>
        </div>
        <input type="hidden" name="form_action" value="save">
        <?php $this->endWidget(); ?>
    </div>