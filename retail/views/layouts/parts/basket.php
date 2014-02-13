<div class="box-modal modal-cart" id="cart" xmlns="http://www.w3.org/1999/html">
        <p>В вашей корзине
            <?php
                $n=CartModel::countProducts();
                echo($n.' '.FormatHelper::plural($n,'товар','товара','товаров'));?>
        </p>
        <button class="clear"><b>X</b>Очистить корзину</button>
        <div class="cart-goods">
            <?php $sum=0; foreach($products as $product) { ?>
            <div class="goods-one">
                <img src="<?=Yii::app()->params['staticUrl'].ShopProductsHelper::pathToLargeImg($product->image) ?>" alt="<?=$product->name ?>">
                <a href="/catalog/product/<?=$product->id ?>" class="name-goods"><?=$product->name ?> (<?= $product->model ?>)</a>
                <button class="del-goods">X</button>
                <button class="changeCount right plus">+</button>
                <span class="sel-count count"><?=$product_ids[$product->id] ?></span>
                <button class="changeCount left minus">-</button>
                <span class="price"><?=FormatHelper::markupSummary($product->price,$product_ids[$product->id]) ?></span>
                <input type="hidden" class="prod_id" value="<?=$product->id ?>"/>

            </div>
            <?php $sum+=$product->price*$product_ids[$product->id]; } ?>
        </div>
        <div class="next-sale">
            <p>Стоимость заказа</p>
            <span><?=FormatHelper::markup($sum) ?></span>
            <button>Оформить заказ</button>
        </div>
    </div>