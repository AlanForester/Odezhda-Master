<div id="qwe" class="bottom" style="height: 80px;">
    <p>В вашей корзине
        <?php
        $n=CartModel::countProducts();
        echo($n.' '.FormatHelper::plural($n,'товар','товара','товаров'));
        ?>
    </p>
    <button class="clear"><b>X</b>Очистить корзину</button>
    <!--    <p class="open-basket"><input type="checkbox"  /><span>Не открывать корзину при каждой покупке</span></p>-->

    <div class="goods-slider">
        <div id="container">
            <ul id="items">
                <?php $sum=0; foreach($products as $product) { ?>
                    <li>
                        <p class="image"><a href="/catalog/product/<?=$product->id ?>">
                                <img src="<?=Yii::app()->params['staticUrl'].ShopProductsHelper::pathToLargeImg($product->image) ?>" alt="<?=$product->name ?>" />
                            </a>
                            <button class="changeCount right plus">+</button>
                            <span class="sel-count count"><?=$product_ids[$product->id] ?></span>
                            <button class="changeCount left minus">-</button>
                        </p>
                        <h3><a href="/catalog/product/<?=$product->id ?>" class="name-goods"><?=$product->name ?></a></h3>
                        <span class="artikul"><?= $product->model ?></span>
                        <span class="price-g"><?=FormatHelper::markup($product->price) ?></span>
                        <span class="price-b"><?=FormatHelper::markupSummary($product->price,$product_ids[$product->id]) ?></span>
                        <input type="hidden" class="prod_id" value="<?=$product->id ?>"/>
                    </li>
                    <?php $sum+=$product->price*$product_ids[$product->id]; } ?>
            </ul>

        </div>
    </div>

    <div class="all-price">
        <div id="jqeasytrigger" class="bottom">
            <a href="#" class="close">x</a>
        </div>
        <p class="title-price">Стоимость заказа</p>
        <span class="end-price"><?=FormatHelper::markup($sum) ?></span>
        <a href="#" class="zakaz" id="makeOrder">Оформить заказ</a>
    </div>
</div>