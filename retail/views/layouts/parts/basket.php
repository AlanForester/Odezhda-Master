<div class="box-modal modal-cart" id="cart" xmlns="http://www.w3.org/1999/html">
        <p>В вашей корзине
            <?php
                $n=CartModel::countProducts();
                echo($n.' '.FormatHelper::plural($n,'товар','товара','товаров'));?>
        </p>
        <button class="clear"><b>X</b>Очистить корзину</button>
        <div class="cart-goods">
            <?php foreach($products as $product) { ?>
            <div class="goods-one">
                <img src="/images/kofta.png" alt="" />
                <a href="/catalog/product/<?=$product->id ?>" class="name-goods"><?=$product->name ?> (<?= $product->model ?>)</a>
                <span class="price"><?=FormatHelper::markupSummary($product->price,$product_ids[$product->id]) ?></span>
                <button class="del-goods">X</button>
                <button class="changeCount right" id="plus">+</button>
                <span class="sel-count" id="count"><?=$product_ids[$product->id] ?></span>
                <button class="changeCount left" id="minus">-</button>
            </div>
            <?php } ?>
        </div>
        <div class="next-sale">
            <p>Стоимость заказа</p>
            <span>5 050 руб.</span>
            <button>Оформить заказ</button>
        </div>
    </div>