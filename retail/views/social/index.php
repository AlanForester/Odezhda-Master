<?php
Yii::app()->clientScript->registerPackage('social');
//Yii::app()->clientScript->registerPackage('index');
?>
<div class="wrapper">

    <div class="sort-goods-catalog">
        <p>Всего <?php echo $totalCount . ' ' . FormatHelper::plural($totalCount, 'товар', 'товара', 'товаров'); ?></p>

        <div class="sort">
            <span>Сортировать:</span>
            <?php
            echo CHtml::dropDownList(
                'order',
                Yii::app()->request->getParam('order'),
                [
                    'hits' => 'По популярности',
                    'date' => 'По дате добавления',
                    'price_down' => 'От дешевых к дорогим',
                    'price_up' => 'От дорогих к дешевым'
                ],
                [
                    'id' => 'catalog_order'
                ]
            );
            ?>
        </div>
<!--        <div class="basket">-->
<!--            <a href="--><?php //echo $this->createUrl('site/login') ?><!--" data-options='{"width":860, "height":355, "modal": true}'-->
<!--              id="openCart" class="lightbox">-->
<!--                <img src="/images/basket_social.png" alt="" />-->
<!--                <small>В корзине</small>-->
<!--                <span class="col">--><?php //echo CartModel::countProducts();?><!--</span>-->
<!--            </a>-->
<!--        </div>-->
    </div>

    <div class="catalog-goods">
        <?php foreach ($dataProvider->getData() as $product) { ?>
            <div class="goods-var">
                <img class="goods-var-image" src="<?= Yii::app()->params['staticUrl'] ?>images/<?= $product['image'] ?>"
                        alt=""/>
                <a class='good-var-name'><?php echo $product->name . ' ' . $product->model; ?></a>

                <span><?= FormatHelper::markup($product->price) ?></span>
                <?php if ($product->old_price != 0) { ?>
                    <h5><?= FormatHelper::markup($product->old_price) ?></h5>
                <?php } ?>

                <div class="choice">
                    <?php if (!empty($product->product_options)) { ?>
                        <select class="product_size">
                            <?php foreach ($product->product_options as $option) { ?>
                                <option
                                    value='<?= $option->products_options_values_id ?>'><?= $option->products_options_values_name ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                    <?php if (!Yii::app()->user->isGuest): ?>
                        <a class="in-basket addToCart">в корзину</a>
                    <?php else: ?>
                        <a class="in-basket addToCart">в корзину</a>
                    <?php endif; ?>
                    <input type="hidden" class="product_id" value="<?= $product->id ?>"/>
                </div>
            </div>
        <?php } ?>

        <?php
        $this->widget(
            'retail.widgets.LinkPager',
            [
                'pages' => $pages,
            ]
        )

        ?>
    </div>
</div>
<div id="panel">
    <?php $this->renderPartial('/layouts/socialParts/cart'); ?>
</div>
