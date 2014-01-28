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

                    <div class="clearfix" >
                        <ul id="thumblist" class="clearfix" >
                            <li><a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img src='/images/tovar1.png' alt=""></a></li>
                            <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img src='/images/tovar1.png' alt=""></a></li>
                            <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img src='/images/tovar1.png' alt=""></a></li>
                            <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img src='/images/tovar1.png' alt=""></a></li>
                        </ul>
                    </div>
                    <div class="clearfix">
                        <a href="/images/tovar1-big-b.png" class="jqzoom" rel='gal1'  title="triumph" >
                            <img src="/images/tovar1-big.png"  title="triumph" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tovar-info">
            <p>Футболка</p>
            <span>Артикул 75388308</span>
            <div class="color">
                <span>ВЫБЕРИТЕ ЦВЕТ</span>
                <a href="#"><img src="/images/tovar1.png" alt=""></a>
                <a href="#"><img src="/images/tovar1.png" alt=""></a>
                <a href="#"><img src="/images/tovar1.png" alt=""></a>
                <a href="#"><img src="/images/tovar1.png" alt=""></a>
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
                            <p>СОСТАВ:   шелк 100%;</p>
                            <p>СТРАНА ПРОИЗВОДСТВА:   Китай </p>
                            <p>ОБХВАТ ГРУДИ:   110см</p>
                            <p>ДЛИНА ИЗДЕЛИЯ:   80см</p>
                        </div>
                        <div id="tab2" class="tab_content">
                            <p>MYTITLE/IMAGE TITLE: Anchor title and/or image title that will be used to show the zoom title close to the jQZoom Window.
                                PAY ATTENTION: The SMALLIMAGE must be a scaled versione of the BIGIMAGE.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="para-ideal">
            <h4>ИДЕАЛЬНАЯ ПАРА</h4>
            <div class="para-box">
                <a href="#"><img src="/images/para-img.png" alt=""></a>
                <a href="#" class="name">Кофта</a>
                <p>150 руб.</p>
            </div>
            <div class="para-box">
                <a href="#"><img src="/images/para-img.png" alt=""></a>
                <a href="#" class="name">Кофта</a>
                <p>150 руб.</p>
            </div>
        </div>

    </div>

    <div class="bottom-price">
        <div class="footer-social">
            <a href="#" class="soc-btn"><img src="/images/vk.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/facebook.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/twitter.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/google.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/odnoklassniki.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/youtube.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/photo.png" alt="" /></a>
        </div>
        <div class="price-main">
                	<span>
                    	1200 руб.
                    </span>
            <small>1500 руб.</small>
        </div>
        <div class="btn">
            <button class="basket">В КОРЗИНУ</button>
            <button class="buy-lapiki">КУПИТЬ ЗА ЛАПИКИ<img src="/images/icon-btn-lapiki.png" alt=""></button>
        </div>
    </div>

    <p class="title-cart-like-tovar">Похожие товары</p>
    <div class="slider-clothes">
        <script type="text/javascript" src="/js/slider-clothes/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="/js/slider-clothes/jcarousel.responsive.js"></script>
        <link rel="stylesheet" type="text/css" href="/js/slider-clothes/jcarousel.responsive-karta.css">
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