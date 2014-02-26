<?php
Yii::app()->clientScript->registerPackage('social');
?>

<div class="wrapper">
    <div class="catalog-goods">
        <?php foreach ($dataProvider->getData() as $product) { ?>
            <div class="goods-var">
                <a href="<?php echo $this->createUrl('catalog/product', ['id' => $product->id]) ?>"><img
                        class="goods-var-image" src="<?= Yii::app()->params['staticUrl'] ?>images/<?= $product['image'] ?>"
                        alt=""/></a>
                <a class='good-var-name'
                   href="<?php echo $this->createUrl('catalog/product', ['id' => $product->id]) ?>"><?php echo $product->name . ' ' . $product->model; ?></a>

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
