<?php
Yii::app()->clientScript->registerPackage('product');

?>
<div class="wrapper">

    <div class="breadcrumbs">
        <a href="#">Женщины</a><span>/</span>
        <a href="#">Одежда</a><span>/</span>
        <span>Футболки</span>
    </div>
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
                        <li><a href="#tab1">ОПИСАНИЕ</a></li>
                        <li><a href="#tab2">ДОСТАВКА</a></li>

                    </ul>
                    <div class="tab_container">
                        <div id="tab1" class="tab_content">
                            <p>СОСТАВ: шелк 100%;</p>

                            <p>СТРАНА ПРОИЗВОДСТВА:   <?php echo $product->manufacturers ?> </p>

                            <p>ОБХВАТ ГРУДИ: 110см</p>

                            <p>ДЛИНА ИЗДЕЛИЯ: 80см</p>
                        </div>
                        <div id="tab2" class="tab_content">
                            <p>MYTITLE/IMAGE TITLE: Anchor title and/or image title that will be used to show the zoom
                                title close to the jQZoom Window.
                                PAY ATTENTION: The SMALLIMAGE must be a scaled versione of the BIGIMAGE.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--        buy-lapiki-->

    </div>

    <div class="bottom-price">
        <div class="footer-social">
            <a href="#" class="soc-btn"><img src="/images/vk.png" alt=""/></a>
            <a href="#" class="soc-btn"><img src="/images/facebook.png" alt=""/></a>
            <a href="#" class="soc-btn"><img src="/images/twitter.png" alt=""/></a>
            <a href="#" class="soc-btn"><img src="/images/google.png" alt=""/></a>
            <a href="#" class="soc-btn"><img src="/images/odnoklassniki.png" alt=""/></a>
            <a href="#" class="soc-btn"><img src="/images/youtube.png" alt=""/></a>
            <a href="#" class="soc-btn"><img src="/images/photo.png" alt=""/></a>
        </div>
        <div class="price-main">
                	<span>
                    	  <?php echo round($product->price) ?> руб.
                    </span>
            <small><?php echo round($product->old_price) ?> руб.</small>
        </div>
        <div class="btn">
            <button class="basket">В КОРЗИНУ</button>
            <!--            <button class="buy-lapiki">КУПИТЬ ЗА ЛАПИКИ<img src="/images/icon-btn-lapiki.png" alt=""></button>-->
        </div>
    </div>

    <p class="title-cart-like-tovar">Похожие товары</p>

    <div class="slider-clothes">
        <div class="jcarousel-wrapper">
            <div class="jcarousel">
                <ul>
                    <li>
                        <a href="#">
                            <img src="/js/slider-clothes/img/sl1.png" alt="Image 1">
                        </a>

                        <div class="info">
                            <a href="#" class="name">Кофта</a>

                            <p>150 руб.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/js/slider-clothes/img/sl2.png" alt="Image 2">
                        </a>

                        <div class="info">
                            <a href="#" class="name">Кофта</a>

                            <p>150 руб.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/js/slider-clothes/img/sl3.png" alt="Image 3">
                        </a>

                        <div class="info">
                            <a href="#" class="name">Кофта</a>

                            <p>150 руб.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/js/slider-clothes/img/sl1.png" alt="Image 4">
                        </a>

                        <div class="info">
                            <a href="#" class="name">Кофта</a>

                            <p>150 руб.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/js/slider-clothes/img/sl2.png" alt="Image 5">
                        </a>

                        <div class="info">
                            <a href="#" class="name">Кофта</a>

                            <p>150 руб.</p>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/js/slider-clothes/img/sl3.png" alt="Image 6">
                        </a>

                        <div class="info">
                            <a href="#" class="name">Кофта</a>

                            <p>150 руб.</p>
                        </div>
                    </li>
                </ul>
            </div>

            <a href="#" class="jcarousel-control-prev"></a>
            <a href="#" class="jcarousel-control-next"></a>
        </div>
    </div>

</div>