<?php
Yii::app()->clientScript->registerPackage('product');
$this->breadcrumbs=array(
    $product->categories_name => $this->createUrl('catalog/list', ['id' => $product->categories_id]),
    $product->name.' ('.$product->model.')',
);
?>
<div class="karta-wrap">
   <a href="<?= Yii::app()->params['staticUrl'] ?><?=ShopProductsHelper::pathToLargeImg($product->image); ?>" class="jqzoom" rel='gal1' title="triumph">
       <img class='prev_img' src="<?= Yii::app()->params['staticUrl'] ?><?=ShopProductsHelper::pathToLargeImg($product->image); ?>" title="triumph" alt="">
   </a>

       <div class='tovar-info'>
           <p ><?php echo $product->name ?></p>
           <span>Артикул <?php echo $product->model ?></span>
       </div>
       <div class="razmer prev_razmer">
           <div class="title prev_title">
               <span>РАЗМЕРЫ</span>
               <a href="#">Таблица размеров</a>
           </div>
           <a href="#" class="razmer-one">45</a>
           <a href="#" class="razmer-one">56</a>
           <a href="#" class="razmer-one">41</a>
           <a href="#" class="razmer-one-del">48</a>
           <a href="#" class="razmer-one">32</a>
           <a href="#" class="razmer-one">39</a>
           <div class='prev_info'>
               <p><?=$product->description ?></p>
                <?php if($product->manufacturers_id){ ?>
                   <p>СТРАНА ПРОИЗВОДСТВА: <?=$product->manufacturers ?> </p>
               <?php } ?>

           </div>
           <span class='prev_price'>
              <?=FormatHelper::markup($product['price']) ?>
           </span>
           <?php if(!Yii::app()->user->isGuest): ?>
               <button class="basket prev_basket">В КОРЗИНУ</button>
           <?php else: ?>
               <button class="basket prev_basket" onclick="$('#aLog').trigger('click');">В КОРЗИНУ</button>
           <?php endif; ?>
       </div>

</div>