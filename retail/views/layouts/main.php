<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="header-wrapper">
    <div class="header">

        <div class="top-panel-fixed">
            <div class="top-wrapper">

                <div class="catalog">
                    <ul id="menu">
                        <li>
                            <a href="#" class="u">каталог<img src="/images/drow-arrow.png" alt="" /></a>
                            <ul>
                                <li>
                                    <a href="#">CSS</a>
                                    <ul>
                                        <div class="catalog-box">
                                            <li><a href="#">Item 11</a></li>
                                            <li><a href="#">Item 12</a></li>
                                            <li><a href="#">Item 13</a></li>
                                            <li><a href="#">Item 14</a></li>
                                            <li><a href="#">Item 11</a></li>
                                            <li><a href="#">Item 12</a></li>
                                            <li><a href="#">Item 13</a></li>
                                            <li><a href="#">Item 14</a></li>
                                        </div>
                                        <div class="catalog-box">
                                            <li><a href="#">Item 11</a></li>
                                            <li><a href="#">Item 12</a></li>
                                            <li><a href="#">Item 13</a></li>
                                            <li><a href="#">Item 14</a></li>
                                            <li><a href="#">Item 11</a></li>
                                            <li><a href="#">Item 12</a></li>
                                            <li><a href="#">Item 13</a></li>
                                            <li><a href="#">Item 14</a></li>
                                        </div>
                                        <div class="catalog-box">
                                            <li><a href="#">Item 11</a></li>
                                            <li><a href="#">Item 12</a></li>
                                            <li><a href="#">Item 13</a></li>
                                            <li><a href="#">Item 14</a></li>
                                            <li><a href="#">Item 11</a></li>
                                            <li><a href="#">Item 12</a></li>
                                            <li><a href="#">Item 13</a></li>
                                            <li><a href="#">Item 14</a></li>
                                        </div>
                                        <div class="catalog-box">
                                            <li><a href="#">Item 11</a></li>
                                            <li><a href="#">Item 12</a></li>
                                            <li><a href="#">Item 13</a></li>
                                            <li><a href="#">Item 14</a></li>
                                            <li><a href="#">Item 11</a></li>
                                            <li><a href="#">Item 12</a></li>
                                            <li><a href="#">Item 13</a></li>
                                            <li><a href="#">Item 14</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Graphic design</a>
                                    <ul>
                                        <li><a href="#">Item 21</a></li>
                                        <li><a href="#">Item 22</a></li>
                                        <li><a href="#">Item 23</a></li>
                                        <li><a href="#">Item 24</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Development tools</a>
                                    <ul>
                                        <li><a href="#">Item 31</a></li>
                                        <li><a href="#">Item 32</a></li>
                                        <li><a href="#">Item 33</a></li>
                                        <li><a href="#">Item 34</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Web design</a>
                                    <ul>
                                        <li><a href="#">Item 41</a></li>
                                        <li><a href="#">Item 42</a></li>
                                        <li><a href="#">Item 43</a></li>
                                        <li><a href="#">Item 44</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="contact">
                    <small>Иваново </small>
                    <small>7(3942)</small>
                    <strong>222-962</strong>
                </div>


                <div class="reg">
                    <a href="#" id="#example1" onclick="$('#exampleModal1').arcticmodal()" class="m-dotted">Вход</a>
                    <a href="#" id="#example2" onclick="$('#exampleModal2').arcticmodal()" class="m-dotted">Регистрация</a>
                </div>

                <div class="top-nav">
                    <ul>
                        <li>
                            <a href="#">Как получить</a>
                        </li>
                        <li>
                            <a href="#">Что с моим заказом?</a>
                        </li>
                        <li>
                            <a href="#">Сервисы</a>
                        </li>
                        <ul>
                </div>
            </div>
        </div>

        <a href="#" class="logo"><img src="/images/logo.png" alt="" /></a>

        <div class="search">
            <input type="text"  />
            <input type="submit" value="" />
        </div>
        <div class="basket">
            <a href="#" id="#example3" onclick="$('#exampleModal3').arcticmodal()" class="m-dotted">
                <img src="/images/basket.png" alt="" />
                <small>В корзине</small>
                <span>4</span>
            </a>
        </div>
    </div>
</div>

<?php echo $content ?>

<div class="footer-wrapper">
    <div class="footer-box">

        <div class="draw-icon">
            <a href="#"><img src="/images/dr1.png" alt="" /></a>
            <a href="#"><img src="/images/dr2.png" alt="" /></a>
            <a href="#"><img src="/images/dr3.png" alt="" /></a>
            <a href="#"><img src="/images/dr4.png" alt="" /></a>
            <a href="#"><img src="/images/dr5.png" alt="" /></a>
            <a href="#"><img src="/images/dr6.png" alt="" /></a>
            <a href="#" class="draw-arrow"><img src="/images/drow-arrow.png" alt="" /></a>
        </div>

        <div class="footer">
            <div class="nav-bar">
                <ul>
                    <li><a href="#">LAPANA.RU</a></li>
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Вакансии</a></li>
                    <li><a href="#">Партнерам</a></li>
                    <li><a href="#">Контакты</a></li>
                    <li><a href="#">Сертификаты</a></li>
                    <li><a href="#">Наши скидки</a></li>
                    <li><a href="#">Преимущества</a></li>
                </ul>
            </div>
            <div class="nav-bar">
                <ul>
                    <li><a href="#">СЕРВИС И ПОМОЩЬ</a></li>
                    <li><a href="#">Как сделать заказ</a></li>
                    <li><a href="#">Пункты самовывоза</a></li>
                    <li><a href="#">Способы оплаты</a></li>
                    <li><a href="#">Возврат</a></li>
                    <li><a href="#">Правила продажи</a></li>
                    <li><a href="#">Доставка</a></li>
                </ul>
            </div>
            <div class="nav-bar">
                <ul>
                    <li><a href="#">ПАРТНЕРАМ</a></li>
                    <li><a href="#">Франшиза</a></li>
                </ul>
            </div>
            <span>Я одеваюсь в Лапана бесплатно. Хотите знать как?</span>
            <img src="/images/modal-girl.png" class="footer-girl" alt="" />
            <div class="gift-card">
                <span>
                    ЧТО ПОДАРИТЬ И НЕ ПРОГАДАТЬ? Подарочная карта Lapana.ru – отличный подарок, который обязательно понравится!
                </span>
                <img src="/images/gift-card.png" alt="" />
                <button>купить</button>
            </div>
        </div>

        <!--<div class="footer-social">
            <a href="#" class="soc-btn"><img src="/images/vk.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/facebook.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/twitter.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/google.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/odnoklassniki.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/youtube.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/photo.png" alt="" /></a>
        </div>-->

    </div>
</div>
<div class="bottom-panel">
    <div class="bottom-panel-wrapper">
        <div class="see-goods">
            <a href="#" class="your-goods">вы смотрели</a>
            <h5>5</h5>
            <div class="your-goods-modal-wrapper">

                <div class="close-modal-see-goods">
                    X
                </div>

                <div class="your-goods-modal">
                    <p>Вы смотрели</p>
                    <div class="goods">
                        <img src="/images/kofta.png" alt="" />
                        <a href="#">Кофта (75382936)</a>
                        <span>150 руб.</span>
                        <button>купить</button>
                    </div>
                    <div class="goods">
                        <img src="/images/kofta.png" alt="" />
                        <a href="#">Кофта (75382936)</a>
                        <span>150 руб.</span>
                        <button>купить</button>
                    </div>
                    <div class="goods">
                        <img src="/images/kofta.png" alt="" />
                        <a href="#">Кофта (75382936)</a>
                        <span>150 руб.</span>
                        <button>купить</button>
                    </div>
                    <div class="goods">
                        <img src="/images/kofta.png" alt="" />
                        <a href="#">Кофта (75382936)</a>
                        <span>150 руб.</span>
                        <button>купить</button>
                    </div>
                    <div class="goods">
                        <img src="/images/kofta.png" alt="" />
                        <a href="#">Кофта (75382936)</a>
                        <span>150 руб.</span>
                        <button>купить</button>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="our-goods">+</a>
        <div class="our-goods-modal">
            <p>Ой, еще забыли предложить</p>
            <div class="goods">
                <img src="/images/kofta.png" alt="" />
                <a href="#">Кофта (75382936)</a>
                <span>150 руб.</span>
                <button>купить</button>
            </div>
            <div class="goods">
                <img src="/images/kofta.png" alt="" />
                <a href="#">Кофта (75382936)</a>
                <span>150 руб.</span>
                <button>купить</button>
            </div>
            <div class="goods">
                <img src="/images/kofta.png" alt="" />
                <a href="#">Кофта (75382936)</a>
                <span>150 руб.</span>
                <button>купить</button>
            </div>
        </div>
    </div>
</div>

<div class="g-hidden">
    <div class="box-modal" id="exampleModal1">
        <div class="box-modal_close arcticmodal-close">X</div>
        <div class="modal-login-left">
            <p>Постоянный клиент</p>
            <form>
                <input type="text" placeholder="E-mail" />
                <input type="text" placeholder="Пароль" />
                <div class="remember">
                    <input type="checkbox"  /><span>Запомнить меня</span>
                </div>
                <button>Войти</button>
            </form>
            <div class="line"></div>
            <h4>Войти как пользователь социальной сети</h4>
            <a href="#" class="soc-btn vk"><img src="/images/vk.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/facebook.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/twitter.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/google.png" alt="" /></a>
            <a href="#" class="soc-btn"><img src="/images/odnoklassniki.png" alt="" /></a>
            <div class="info">
                <p>Регистрация на сайте Lapana.ru дает мне дополнительные возможности.<br /><br />

                    Я могуоткладывать понравившиеся товары; отслеживать статус заказов и хранить их историю в Личном кабинете; однократно ввести адрес доставки и больше не указывать его при заказах.<br /><br />

                    А еще я получаю скидки, подарки и сюрпризы.</p>
            </div>
        </div>
        <div class="modal-login-right">
            <p>Новый покупатель</p>
            <button>Регистрация</button>
            <img src="/images/modal-girl.png" alt="" />
        </div>
    </div>
</div>

<div class="g-hidden">
    <div class="box-modal modal-reg" id="exampleModal2">
        <div class="box-modal_close arcticmodal-close modal-reg">X</div>
        <div class="modal-login-left modal-reg">
            <p>Регистрация</p>
            <form>
                <div class="reg-input">
                    <input type="text" placeholder="Имя, Фамилия*" />
                    <input type="text" placeholder="Пароль*" class="pass" />
                    <input type="text" placeholder="E-mail*" />
                    <input type="text" placeholder="Подтвердите пароль*" class="pass" />
                </div>
                <div class="left-info">
                    <div class="date-birth">
                        <p>Дата рождения</p>
                        <select class="intro-select-day">
                            <option>дд</option>
                            <option>мм</option>
                            <option>гггг</option>
                            <option>пол</option>
                        </select>
                        <select class="intro-select-month">
                            <option>дд</option>
                            <option>мм</option>
                            <option>гггг</option>
                            <option>пол</option>
                        </select>
                        <select class="intro-select-year">
                            <option>дд</option>
                            <option>мм</option>
                            <option>гггг</option>
                            <option>пол</option>
                        </select>
                        <select class="intro-select-pol">
                            <option>дд</option>
                            <option>мм</option>
                            <option>гггг</option>
                            <option>пол</option>
                        </select>
                        <h6>Подарки и сюрпризы на день рождения от Lapana.ru</h6>
                    </div>
                    <input type="text" placeholder="Мобильный" />
                    <h6>Для sms-уведомлений о состоянии заказа и связи с вами, когда вы заказываете доставку. Мы не берем за это денег, не рассылаем спам и не раскрываем ваш номер сторонним организациям.</h6>
                    <input type="text" placeholder="Промо-код" />
                    <h6>Вводится при регистрации по приглашению от действующего участника программы Lapa-bonus</h6>
                </div>
                <div class="right-info">
                    <div class="remember">
                        <p><input type="checkbox"  /><span>Я хочу получать уведомления по электронной почте</span></p>
                        <p><input type="checkbox"  /><span>Я хочу получать sms-уведомления</span></p>
                        <p><input type="checkbox"  /><span>Запомнить меня</span></p>
                    </div>
                    <h6>чтобы автоматически входить на сайт при каждом посещении</h6>
                    <h6>Lapana.ru не передает и не продает персональную информацию. Нажимая кнопку "РЕГИСТРАЦИЯ" Вы соглашаетесь на обработку Ваших персональных данных в соответствии с ФЗ РФ от 27.07.2006 г. № 152-ФЗ (в ред. 25.07.2011 г.) "О персональных данных", а так же с нашей Политикой конфиденциальности и условиями договора публичной оферты.</h6>
                    <button>Регистрация</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="g-hidden">
    <div class="box-modal modal-cart" id="exampleModal3">
        <div class="box-modal_close arcticmodal-close modal-cart">X</div>
        <p>В вашей корзине 4 товара</p>
        <button class="clear"><b>X</b>Очистить корзину</button>
        <p class="open-basket"><input type="checkbox"  /><span>Не открывать корзину<br /> при каждой покупке</span></p>
        <div class="cart-goods">
            <div class="goods-one">
                <img src="/images/kofta.png" alt="" />
                <a href="#" class="name-goods">Кофта (75382936)</a>
                <span class="price">2 500руб.</span>
                <select class="sel-count">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                <button class="del-goods">X</button>
            </div>
            <div class="goods-one">
                <img src="/images/kofta.png" alt="" />
                <a href="#" class="name-goods">Кофта (75382936)</a>
                <span class="price">2 500руб.</span>
                <select class="sel-count">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                <button class="del-goods">X</button>
            </div>
            <div class="goods-one">
                <img src="/images/kofta.png" alt="" />
                <a href="#" class="name-goods">Кофта (75382936)</a>
                <span class="price">2 500руб.</span>
                <select class="sel-count">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                <button class="del-goods">X</button>
            </div>
            <div class="goods-one">
                <img src="/images/kofta.png" alt="" />
                <a href="#" class="name-goods">Кофта (75382936)</a>
                <span class="price">2 500руб.</span>
                <select class="sel-count">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                <button class="del-goods">X</button>
            </div>
            <div class="goods-one">
                <img src="/images/kofta.png" alt="" />
                <a href="#" class="name-goods">Кофта (75382936)</a>
                <span class="price">2 500руб.</span>
                <select class="sel-count">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                <button class="del-goods">X</button>
            </div>
        </div>
        <div class="next-sale">
            <a href="#">Продолжить покупки</a>
            <p>Стоимость заказа</p>
            <span>5 050 руб.</span>
            <button>Оформить заказ</button>
        </div>
        <div class="like-goods">
            <p>Возможно Вам также понравится</p>
            <div class="like-one">
                <img src="/images/kofta.png" alt="" />
                <p>Двуспальный комплект</p>
                <a href="#">195 руб.</a>
            </div>
            <div class="like-one">
                <img src="/images/kofta.png" alt="" />
                <p>Двуспальный комплект</p>
                <a href="#">195 руб.</a>
            </div>
            <div class="like-one">
                <img src="/images/kofta.png" alt="" />
                <p>Двуспальный комплект</p>
                <a href="#">195 руб.</a>
            </div>
            <div class="like-one">
                <img src="/images/kofta.png" alt="" />
                <p>Двуспальный комплект</p>
                <a href="#">195 руб.</a>
            </div>
            <div class="like-one">
                <img src="/images/kofta.png" alt="" />
                <p>Двуспальный комплект</p>
                <a href="#">195 руб.</a>
            </div>
        </div>
    </div>
</div>

<a href="#" id="#example4" onclick="$('#exampleModal4').arcticmodal()" class="m-dotted callback">?</a>

<div class="g-hidden">
    <div class="box-modal modal-reg" id="exampleModal4">
        <div class="box-modal_close arcticmodal-close modal-reg">X</div>
    </div>
</div>

<a href="#" id="#example5" onclick="$('#exampleModal5').arcticmodal()" class="m-dotted fixed-info"><img src="/images/fixed-info-btn.png" alt="" /></a>

<div class="g-hidden">
    <div class="box-modal modal-reg" id="exampleModal5">
        <div class="box-modal_close arcticmodal-close modal-reg">X</div>
    </div>
</div>

<div class="g-hidden">
<div class="box-modal more-goods" id="exampleModalmore-goods">
<div class="box-modal_close arcticmodal-close modal-reg">X</div>
<script type="text/javascript" src="/js/slider-clothes/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="/js/slider-clothes/jcarousel.responsive.js"></script>
<link rel="stylesheet" type="text/css" href="/js/slider-clothes/jcarousel.responsive.css">
<div class="jcarousel-wrapper">
<div class="jcarousel">
<ul>
<li class="goods-list">
    <div class="karta-wrap">
        <div class="karta-box">
            <div class="tovar-slider">
                <div class="clearfix" id="content">

                    <div class="clearfix" >
                        <ul id="thumblist" class="clearfix" >
                            <li><a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img src='/images/tovar1.png' alt=""></a></li>
                            <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img src='/images/tovar1.png' alt=""></a></li>
                            <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '/images/tovar1-big-b.png'}"><img src='/images/tovar1.png' alt=""></a></li>
                            <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '/images/tovar1-big.png',largeimage: '//tovar1-big-b.png'}"><img src='/images/tovar1.png' alt=""></a></li>
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

        <div class="tovar-info goods">
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

                <script type="text/javascript" src="/js/tabs/withoutPlugin.js"></script>
                <script type="text/javascript" src="/js/tabs/organictabs.jquery.js"></script>
                <link href="/js/tabs/style.css" rel="stylesheet" type="text/css" />
                <script>
                    $(function() {

                        $("#example-one").organicTabs();

                        $("#example-two").organicTabs({
                            "speed": 200
                        });

                    });
                </script>
                <div id="example-one">

                    <ul class="nav">
                        <li class="nav-one"><a href="#featured" class="current">ОПИСАНИЕ</a></li>
                        <li class="nav-two"><a href="#core">ДОСТАВКА</a></li>
                    </ul>

                    <div class="list-wrap">

                        <ul id="featured">
                            <p>СОСТАВ:   шелк 100%;</p>
                            <p>СТРАНА ПРОИЗВОДСТВА:   Китай </p>
                            <p>ОБХВАТ ГРУДИ:   110см</p>
                            <p>ДЛИНА ИЗДЕЛИЯ:   80см</p>
                        </ul>

                        <ul id="core" class="hide">
                            <p>MYTITLE/IMAGE TITLE: Anchor title and/or image title that will be used to show the zoom title close to the jQZoom Window.
                                PAY ATTENTION: The SMALLIMAGE must be a scaled versione of the BIGIMAGE.</p>
                        </ul>
                    </div> <!-- END List Wrap -->
                </div>
            </div>
            <div class="footer-social">
                <a href="#" class="soc-btn"><img src="/images/vk.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/facebook.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/twitter.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/google.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/odnoklassniki.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/youtube.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/photo.png" alt="" /></a>
            </div>
        </div>
    </div>
    <div class="bottom-price">
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
</li>
<li class="goods-list">
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

        <div class="tovar-info goods">
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

                <script type="text/javascript" src="/js/tabs/withoutPlugin.js"></script>
                <script type="text/javascript" src="/js/tabs/organictabs.jquery.js"></script>
                <link href="/js/tabs/style.css" rel="stylesheet" type="text/css" />
                <script>
                    $(function() {

                        $("#example-one").organicTabs();

                        $("#example-two").organicTabs({
                            "speed": 200
                        });

                    });
                </script>
                <div id="example-one">

                    <ul class="nav">
                        <li class="nav-one"><a href="#featured" class="current">ОПИСАНИЕ</a></li>
                        <li class="nav-two"><a href="#core">ДОСТАВКА</a></li>
                    </ul>

                    <div class="list-wrap">

                        <ul id="featured">
                            <p>СОСТАВ:   шелк 100%;</p>
                            <p>СТРАНА ПРОИЗВОДСТВА:   Китай </p>
                            <p>ОБХВАТ ГРУДИ:   110см</p>
                            <p>ДЛИНА ИЗДЕЛИЯ:   80см</p>
                        </ul>

                        <ul id="core" class="hide">
                            <p>MYTITLE/IMAGE TITLE: Anchor title and/or image title that will be used to show the zoom title close to the jQZoom Window.
                                PAY ATTENTION: The SMALLIMAGE must be a scaled versione of the BIGIMAGE.</p>
                        </ul>
                    </div> <!-- END List Wrap -->
                </div>
            </div>
            <div class="footer-social">
                <a href="#" class="soc-btn"><img src="/images/vk.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/facebook.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/twitter.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/google.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/odnoklassniki.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/youtube.png" alt="" /></a>
                <a href="#" class="soc-btn"><img src="/images/photo.png" alt="" /></a>
            </div>
        </div>
    </div>
    <div class="bottom-price">
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
</li>
</ul>
</div>

<a href="#" class="jcarousel-control-prev"></a>
<a href="#" class="jcarousel-control-next"></a>
</div>
</div>
</div>

<a href="#" class="scroll-top" id="up"></a>

<div class="fixed-social">
    <a href="#" class="soc-btn vk"><img src="/images/l-vk.png" alt="" /></a>
    <a href="#" class="soc-btn facebook"><img src="/images/l-facebook.png" alt="" /></a>
    <a href="#" class="soc-btn twitter"><img src="/images/l-twitter.png" alt="" /></a>
    <a href="#" class="soc-btn google"><img src="/images/l-google.png" alt="" /></a>
    <a href="#" class="soc-btn odnoklassniki"><img src="/images/l-odnoklassniki.png" alt="" /></a>
    <a href="#" class="soc-btn youtube"><img src="/images/l-youtube.png" alt="" /></a>
    <a href="#" class="soc-btn photo"><img src="/images/l-photo.png" alt="" /></a>
    <span></span>
</div>

</body>
</html>
