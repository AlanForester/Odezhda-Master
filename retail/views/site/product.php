<?php
Yii::app()->clientScript->registerPackage('product');
//print_r($product);exit;
$this->breadcrumbs=array(
    $product->categories_name => $this->createUrl('catalog/list', ['id' => $product->categories_id]),
    $product->name.' ('.$product->model.')',
);

$cart = "
jQuery(document).ready(function($){
    //корзинка
    $('#addToCart').live('click',function(){
        $.ajax({
                  type: 'POST',
                  url: '".$this->createUrl('/cart/add')."',
                  data: ({
                        product_id : '".$product->id."',
                        params : '',
                  }),
                  success: function(data) {
                        if (data){
                              $('#panel').html(data);
                              $('.bottom-panel').effect('highlight', {}, 2000);
                        }

                  }
              });
    });
});
";

Yii::app()->getClientScript()->registerScript('cart', $cart, CClientScript::POS_END);
?>

<div class="wrapper">

    <div class="karta-wrap">
        <div class="karta-box">
            <div class="tovar-slider">
                <div class="clearfix" id="content">


                    <div class="clearfix">

                        <ul id="thumblist" class="clearfix">

                            <?php $list_image=ShopProductsHelper::previewListImg($product); ?>
                            <?php foreach($list_image as $image){ ?>
                                <li><a class="zoomThumbActive" href='javascript:void(0);'
                                       rel="{gallery: 'gal1', smallimage: '<?= Yii::app()->params['staticUrl'].$image['small'] ?>',largeimage: '<?= Yii::app()->params['staticUrl'].$image['large'] ?>"><img
                                            src='<?= Yii::app()->params['staticUrl'].$image['small'] ?>' alt=""></a></li>


                            <?php } ?>


<!--                            <li><a class="zoomThumbActive" href='javascript:void(0);'-->
<!--                                   rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img-->
<!--                                        src='/images/tovar1.png' alt=""></a></li>-->
<!--                            -->
<!--                            <li><a href='javascript:void(0);'-->
<!--                                   rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img-->
<!--                                        src='/images/tovar1.png' alt=""></a></li>-->
<!--                            <li><a href='javascript:void(0);'-->
<!--                                   rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img-->
<!--                                        src='/images/tovar1.png' alt=""></a></li>-->
<!--                            <li><a href='javascript:void(0);'-->
<!--                                   rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img-->
<!--                                        src='/images/tovar1.png' alt=""></a></li>-->
                        </ul>
                    </div>
                    <div class="clearfix">
                        <a href="<?= Yii::app()->params['staticUrl'] ?><?=ShopProductsHelper::pathToLargeImg($product->image); ?>" class="jqzoom" rel='gal1' title="triumph">
                            <img src="<?= Yii::app()->params['staticUrl'] ?><?=ShopProductsHelper::pathToLargeImg($product->image); ?>" title="triumph" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tovar-info">
            <p><?php echo $product->name ?></p>
            <span>Артикул <?php echo $product->model ?></span>

            <div class="color">
                <span>ВЫБЕРИТЕ ЦВЕТ</span>
                <?php foreach($list_image as $image){ ?>
                <a href="#"><img src="<?= Yii::app()->params['staticUrl'].$image['small'] ?>" alt=""></a>
                <?php } ?>
<!--                <a href="#"><img src="http://odezhda-master.ru/preview/w50_img_7863.jpg" alt=""></a>-->
<!--                <a href="#"><img src="/images/tovar1.png" alt=""></a>-->
<!--                <a href="#"><img src="/images/tovar1.png" alt=""></a>-->
            </div>
            <div class="razmer">
                <div class="title">
                    <span>РАЗМЕРЫ</span>
                    <a href="#">Таблица размеров</a>
                </div>
                <a href="#" class="razmer-one">45</a>
                <a href="#" class="razmer-one">56</a>
                <a href="#" class="razmer-one">41</a>
                <a href="#" class="razmer-one-del">48</a>
                <a href="#" class="razmer-one">32</a>
                <a href="#" class="razmer-one">39</a>
            </div>
            <div class="tovar-more-info">
                <div id="tabs" class="tab1">
                    <ul class="tabs">
                        <li><!--<a href="#tab1">-->ОПИСАНИЕ<!--</a>--></li>
<!--                        <li><a href="#tab2">ДОСТАВКА</a></li>-->

                    </ul>
                    <div class="tab_container">
                        <div id="tab1" class="tab_content">
<!--                            <p>СОСТАВ: шелк 100%;</p>-->
                            <?=$product->description ?>
                       <?php if($product->manufacturers_id){ ?>
                            <p>СТРАНА ПРОИЗВОДСТВА:   <?=$product->manufacturers ?> </p>
                            <?php } ?>
<!--                            <p>ОБХВАТ ГРУДИ: 110см</p>-->
<!---->
<!--                            <p>ДЛИНА ИЗДЕЛИЯ: 80см</p>-->
                        </div>
<!--                        <div id="tab2" class="tab_content">-->
<!--                            <p>MYTITLE/IMAGE TITLE: Anchor title and/or image title that will be used to show the zoom-->
<!--                                title close to the jQZoom Window.-->
<!--                                PAY ATTENTION: The SMALLIMAGE must be a scaled versione of the BIGIMAGE.</p>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>

        <!--        buy-lapiki-->

    </div>

    <div class="bottom-price">
<!--        <div class="footer-social">-->
<!--            <a href="#" class="soc-btn"><img src="/images/vk.png" alt=""/></a>-->
<!--            <a href="#" class="soc-btn"><img src="/images/facebook.png" alt=""/></a>-->
<!--            <a href="#" class="soc-btn"><img src="/images/twitter.png" alt=""/></a>-->
<!--            <a href="#" class="soc-btn"><img src="/images/google.png" alt=""/></a>-->
<!--            <a href="#" class="soc-btn"><img src="/images/odnoklassniki.png" alt=""/></a>-->
<!--            <a href="#" class="soc-btn"><img src="/images/youtube.png" alt=""/></a>-->
<!--            <a href="#" class="soc-btn"><img src="/images/photo.png" alt=""/></a>-->
<!--        </div>-->
        <div class="footer-social">
            <script type="text/javascript">(function() {
                    if (window.pluso)if (typeof window.pluso.start == "function") return;
                    if (window.ifpluso==undefined) { window.ifpluso = 1;
                        var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                        s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                        s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                        var h=d[g]('body')[0];
                        h.appendChild(s);
                    }})();</script>
            <div class="pluso" data-background="transparent" data-options="medium,round,line,horizontal,nocounter,theme=06" data-services="vkontakte,facebook,google,twitter,odnoklassniki" data-url="odezhda-master.ru/" data-title="<?= Yii::app()->params['title'] ?>" data-description=""></div>
        </div>

        <div class="btn">
            <?php if(!Yii::app()->user->isGuest): ?>
                <a class="basket" id="addToCart">В КОРЗИНУ</a>
            <?php else: ?>
<!--                <button class="basket" onclick="$('#aLog').trigger('click');">В КОРЗИНУ</button>-->
                <a href="<?php echo $this->createUrl('site/login') ?>"
                   data-options='{"width":900, "height":355, "modal": true}' class="basket lightbox">В КОРЗИНУ</a>
            <?php endif; ?>
            <!--            <button class="buy-lapiki">КУПИТЬ ЗА ЛАПИКИ<img src="/images/icon-btn-lapiki.png" alt=""></button>-->
        </div>

        <div class="price-main">
                	<span>
                    	  <?=FormatHelper::markup($product['price']) ?>
                    </span>
            <?php if ($product['old_price'] != 0) { ?>
                 <small><?=FormatHelper::markup($product['old_price']) ?></small>
            <?php } ?>
        </div>

    </div>

    <p class="title-cart-like-tovar">Популярные товары</p>

    <div class="slider-clothes">
        <div class="jcarousel-wrapper">
            <div class="jcarousel">
                <ul>
                    <?php foreach ($dataProvider->getData() as $product) { ?>
                    <li>
                        <a href="/catalog/product/<?=$product->id ?>">
                            <img src="<?=Yii::app()->params['staticUrl'].ShopProductsHelper::pathToMidImg($product->image) ?>" alt="<?=$product->image ?>">
                        </a>

                        <div class="info">
                            <a href="/catalog/product/<?=$product->id ?>" class="name"><?=$product->name ?></a>

                            <p><?=FormatHelper::markup($product->price) ?></p>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <a href="#" class="jcarousel-control-prev"></a>
            <a href="#" class="jcarousel-control-next"></a>
        </div>
    </div>

</div>