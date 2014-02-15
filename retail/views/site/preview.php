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
           <?php if(!empty($product->product_options)){ ?>
           <select id="filter_size">
               <?php foreach ($product->product_options as $option) { ?>
                   <option value='<?=$option->products_options_values_id ?>'><?=$option->products_options_values_name ?></option>
               <?php }?>
           </select>
           <?php } ?>
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
               <a class="basket prev_basket addToCart">В КОРЗИНУ</a>
           <?php else: ?>
               <a href="<?php echo $this->createUrl('site/login') ?>"
                  data-options='{"width":900, "height":355, "modal": true}' class="basket prev_basket">В КОРЗИНУ</a>
           <?php endif; ?>
           <input type="hidden" class="product_id" value="<?=$product->id ?>"/>
       </div>

</div>