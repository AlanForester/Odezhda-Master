<?php $count=isset($count) ? $count :0;
//todo что-то с этим решить
//$products=CartHelper::getCart();
$customer_id=Yii::app()->user->id;
$products=[];
if (!empty($customer_id)){
    $model = new CartModel();
    $product_ids=$model->getUserProducts($customer_id);
    if($product_ids){
        $catalogModel = new CatalogModel();
//        print_r($product_ids);exit;
        foreach($product_ids as $id=>$count){
            if ($product = $catalogModel->productById($id)) {

                $products[]=$product;
            }
        }
    }
}
?>

<div id="jqeasytrigger" class="bottom bottom-panel">

    <a href="#" class="open" style="display: block;">
        <img src="../../../images/bottom-basket-icon.png" alt="" />

        <p>корзина</p>
        <span class="col"><?php echo(CartModel::countProducts());?></span>
        <p class="sum"><?php echo(CartModel::countPrices());?></p>

    </a>
    <a href="#" class="close" style="display: none;">
        <img src="../../../images/bottom-basket-icon.png" alt="" />
        <p>корзина</p>
        <!-- Если корзина пустая -->
        <span class="null col"><?php echo(CartModel::countProducts());?></span>
        <p class="sum"><?php echo(CartModel::countPrices());?></p>
        <img src="../../../images/bottom-basket-arrow.png" alt="" class="bottom-basket-arrow" />
    </a>
</div>

<div id="jqeasypanel" class="bottom" style="height: 80px;">
    <?php if(!empty($products)) {?>
    <p>В вашей корзине <span class="cart_title">
        <?php
        $n=CartModel::countProducts();
        echo($n.' '.FormatHelper::plural($n,'товар','товара','товаров'));
        ?>
    </span>
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
<!--                            <select class="goods-count">-->
<!--                                --><?php //for($i=1;$i<100;$i++){
//                                    if($i==$product_ids[$product->id]){?>
<!--                                        <option selected="selected">--><?//=$i?><!--</option>-->
<!--                                    --><?php //continue;}?>
<!--                                <option>--><?//=$i?><!--</option>-->
<!--                                --><?php //}?>
<!--                            </select>-->

                        </p>
                        <h3><a href="/catalog/product/<?=$product->id ?>" class="name-goods"><?=$product->name ?></a></h3>
                        <span class="artikul"><?= $product->model ?></span>
                        <span class="price-g"><?=FormatHelper::markup($product->price) ?></span>
                        <span class="price-b"><?=FormatHelper::markupSummary($product->price,$product_ids[$product->id]) ?></span>
                        <button class="changeCount left minus">-</button>
                        <span class="sel-count count"><?=$product_ids[$product->id] ?></span>
                        <button class="changeCount right plus">+</button>
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
    <?php } else{?>
    <p>Ваша корзина пуста</p>
    <?php }?>
</div>
