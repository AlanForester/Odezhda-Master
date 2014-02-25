<?php
//Yii::app()->clientScript->registerPackage('index');
Yii::app()->clientScript->registerPackage('catalog');
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
                <!---->
                <!--                <button class="m-dotted fixed-info quick-view" id="#example5"-->
                <!--                        onclick="$('#exampleModalmore-goods').arcticmodal()">Быстрый просмотр-->
                <!--                </button>-->
                <a href='<?php echo $this->createUrl('catalog/preview', ['id' => $product->id]) ?>'
                   data-options='{"width":743, "height":535, "modal": true}' class='lightbox quick-view' rel="group1">Быстрый
                    просмотр</a>

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
                        <!--                    <a href="--><?php //echo $this->createUrl('site/login') ?><!--"-->
                        <!--                       data-options='{"width":900, "height":355, "modal": true}' class="in-basket lightbox" >в-->
                        <!--                        корзину</a>-->
                    <?php endif; ?>
                    <input type="hidden" class="product_id" value="<?= $product->id ?>"/>
                </div>
            </div>
        <?php } ?>
    </div>

</div>
<?php
$this->widget(
    'retail.widgets.LinkPager',
    [
        'pages' => $pages,
    ]
)

?>