<?php $count=isset($count) ? $count :0;
//todo что-то с этим решить
//$products=CartHelper::getCart();
if(Yii::app()->user->id){
    $reg=true;
    $customer_id=Yii::app()->user->id;
    $products=[];
    if (!empty($customer_id)){
        $model = new CartModel();
        $product_ids=$model->getUserProducts($customer_id);
        if($product_ids){
            $catalogModel = new CatalogModel();
            foreach($product_ids as $id=>$count){
                if ($product = $catalogModel->productById($id)) {

                    $products[]=$product;
                }
            }
        }
    //    print_r($product_ids);exit;
    }
}else{
    $catalogModel = new CatalogModel();
    foreach($_SESSION as $value){
        if ($product = $catalogModel->productById($value['product_id'])) {
            $products[$value['product_id']][]=$product;
            $products[$value['product_id']][]=$value;
        }
    }
//    print_r($products);
//    exit;
}
?>

<div id="jqeasytrigger" class="bottom bottom-panel">

    <a href="#" class="open" style="display: block;">
        <img src="../../../images/bottom-basket-icon.png" alt="" />

        <p>корзина</p>
        <span class="col"><?php echo CartModel::countProducts();?></span>
        <p class="sum"><?php echo CartModel::countPrices();?></p>

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
                <?php
                if(Yii::app()->user->id){
                    $sum=0; foreach($products as $product) {
                        foreach($product_ids[$product->id] as $values){
                        ?>
                        <li>
                            <p class="image"><a href="<?= $this->createUrl('catalog/product', ['id' => $product->id]) ?>">
                                    <img src="<?=Yii::app()->params['staticUrl'].ShopProductsHelper::pathToLargeImg($product->image) ?>" alt="<?=$product->name ?>" />
                                </a>

                            </p>
                            <h3><a href="<?= $this->createUrl('catalog/product', ['id' => $product->id]) ?>" class="name-goods"><?=$product->name ?></a></h3>
                            <span class="artikul"><?= $product->model ?></span>
                            <span class="artikul">Размер <?= CartModel::getSizeById($values['params']) ?></span>
                            <span class="price-g"><?=FormatHelper::markup($product->price) ?></span>
                            <span class="price-b"><?=FormatHelper::markupSummary($product->price,$values['count']) ?></span>
                            <button class="changeCount left minus">-</button>
                            <span class="sel-count count"><?=$values['count'] ?></span>
                            <button class="changeCount right plus">+</button>
                            <span class="del-good">x</span>
                            <input type="hidden" class="prod_id" value="<?=$product->id ?>"/>
                            <input type="hidden" class="prod_params" value="<?=$values['params'] ?>"/>
                        </li>
                        <?php $sum+=$product->price*$values['count']; }
                    }
                }else{ ?>

                   <?php foreach($products as $values){
                        $sum=0;
                    ?>
                    <li>
                        <p class="image"><a href="<?= $this->createUrl('catalog/product', ['id' => $values[0]->id]) ?>">
                                <img src="<?=Yii::app()->params['staticUrl'].ShopProductsHelper::pathToLargeImg($values[0]->image) ?>" alt="<?=$product->name ?>" />
                            </a>

                        </p>
                        <h3><a href="<?= $this->createUrl('catalog/product', ['id' => $values[0]->products_id]) ?>" class="name-goods"><?=$values[0]->products_name ?></a></h3>
                        <span class="artikul"><?= $values[0]->model ?></span>
                        <span class="artikul">Размер <?php echo CartModel::getSizeById($values[1]['params']) ?></span>
                        <span class="price-g"><?=FormatHelper::markup($values[0]->price) ?></span>
                        <span class="price-b"><?php echo FormatHelper::markupSummary($values[0]->price,$values[1]['count']) ?></span>
                        <button class="changeCount left minus">-</button>
                        <span class="sel-count count"><?php echo $values[1]['count'] ?></span>
                        <button class="changeCount right plus">+</button>
                        <span class="del-good">x</span>
                        <input type="hidden" class="prod_id" value="<?=$values[0]->id ?>"/>
                        <input type="hidden" class="prod_params" value="<?php echo $values[1]['params'] ?>"/>
                    </li>
                <?php $sum+=$values[0]->price*$values[1]['count'];
                    } ?>

               <?php }
                ?>
            </ul>

        </div>
    </div>

    <div class="all-price">
        <div id="jqeasytrigger" class="bottom">
            <a href="#" class="close">x</a>
        </div>
        <p class="title-price">Стоимость заказа</p>
<!--        <span class="end-price">--><?php //echo FormatHelper::markup($sum) ?><!--</span>-->
        <a href="<?php echo $this->createUrl('cart/orderStep1')?>"
                       data-options='{"width":860, "height":380, "modal": true}'
                       class="lightbox zakaz" id="makeOrder" onclick="$('.close').trigger('click')">
                        Оформить заказ
                    </a>
    </div>
    <?php } else{?>
    <p>Ваша корзина пуста</p>
    <?php }?>
</div>
