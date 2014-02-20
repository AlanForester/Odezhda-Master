<?php
Yii::app()->clientScript->registerPackage('product');
$this->breadcrumbs=array(
    $product->categories_name => $this->createUrl('catalog/list', ['id' => $product->categories_id]),
    $product->name.' ('.$product->model.')',
);
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.nav a').click(function(){
            var clicked=$(this);
            $('.nav a').each(function(){
                if($(this).hasClass('current')){
                    current=$(this);
                } else{
                    notCurrent=$(this);
                }
            });
            console.log(current);
            console.log(notCurrent);
            console.log(clicked);
            if (!clicked.hasClass('current')){
                console.log('yes');

                current.removeClass('current');
                notCurrent.addClass('current');
                $(notCurrent.attr('href')).removeClass('hide');
                $(current.attr('href')).addClass('hide');
            }
            return false;
        });

        $('a.razmer-one').click(function(){
            $('a.razmer-one.selected').removeClass('selected');
            $(this).addClass('selected');
            return false;
        });
    });
</script>
<div class="karta-wrap">
   <a href="<?= Yii::app()->params['staticUrl'] ?><?=ShopProductsHelper::pathToLargeImg($product->image); ?>" class="jqzoom" rel='gal1' title="triumph">
       <img class='prev_img' src="<?= Yii::app()->params['staticUrl'] ?><?=ShopProductsHelper::pathToLargeImg($product->image); ?>" title="triumph" alt="">
   </a>

       <div class='tovar-info'>
           <p ><?php echo $product->name ?></p>
           <span>Артикул <?php echo $product->model ?></span>
       </div>
    <?php if(!empty($product->product_options[0])){ ?>
    <div class="razmer">
        <div class="title">
            <span>РАЗМЕРЫ</span>
            <a href="#">Таблица размеров</a>
        </div>
                <?php foreach ($product->product_options as $option) { ?>
        <a href="<?=$option->products_options_values_id ?>" class="razmer-one"><?=$option->products_options_values_name ?></a>
                <?php }?>
    </div>
    <?php } ?>

    <div id="example-one">

        <ul class="nav">
            <li class="nav-one"><a href="#featured" class="current">ОПИСАНИЕ</a></li>
            <li class="nav-two"><a href="#core">ДОСТАВКА</a></li>
        </ul>

        <div class="list-wrap">

            <ul id="featured">
                <p><?=$product->description ?></p>
                <?php if($product->manufacturers_id){ ?>
                    <p>СТРАНА ПРОИЗВОДСТВА: <?=$product->manufacturers ?> </p>
                <?php } ?>
            </ul>

            <ul id="core" class="hide">
                <p>MYTITLE/IMAGE TITLE: Anchor title and/or image title that will be used to show the zoom title close to the jQZoom Window.
                    PAY ATTENTION: The SMALLIMAGE must be a scaled versione of the BIGIMAGE.</p>
            </ul>
        </div> <!-- END List Wrap -->
    </div>



       <div class="prev_razmer">
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