<?php
/**
 * @var RetailController $this
 * @var string $content
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?= CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="header-wrapper">
    <div class="header">

        <div class="top-panel-fixed">
            <div class="top-wrapper">

<!--                <div class="catalog">-->
<!--                    <ul id="menu">-->
<!--                        <li>-->
<!--                            <a href="#" class="u">каталог<img src="/images/drow-arrow.png" alt=""/></a>-->
<!--                            <ul>-->
<!--<!--                                --><?php
////                                    $result='';
////                                    foreach($this->categories as $el)   {
////                                        $result.='<li><a href="#">'.$el['name'].'</a>';
////                                        if($el['childCount']>0){
////                                            $result.='<ul><div class="catalog-box">';
////                                            foreach ($el['children'] as $child_el){
////                                                $result.='<li><a href="#">'.$child_el['name'].'</a></li>';
////                                            }
////                                            $result.='</div></ul>';
////                                        }
////                                        $result.='</li>';
////                                    }
////                                    echo($result);
////                                ?>
<!--                                <li>-->
<!--                                    <a href="#">CSS</a>-->
<!--                                    <ul>-->
<!--                                        <div class="catalog-box">-->
<!--                                            <li><a href="#">Item 11</a></li>-->
<!--                                            <li><a href="#">Item 12</a></li>-->
<!--                                            <li><a href="#">Item 13</a></li>-->
<!--                                            <li><a href="#">Item 14</a></li>-->
<!--                                            <li><a href="#">Item 11</a></li>-->
<!--                                            <li><a href="#">Item 12</a></li>-->
<!--                                            <li><a href="#">Item 13</a></li>-->
<!--                                            <li><a href="#">Item 14</a></li>-->
<!--                                        </div>-->
<!--                                        <div class="catalog-box">-->
<!--                                            <li><a href="#">Item 11</a></li>-->
<!--                                            <li><a href="#">Item 12</a></li>-->
<!--                                            <li><a href="#">Item 13</a></li>-->
<!--                                            <li><a href="#">Item 14</a></li>-->
<!--                                            <li><a href="#">Item 11</a></li>-->
<!--                                            <li><a href="#">Item 12</a></li>-->
<!--                                            <li><a href="#">Item 13</a></li>-->
<!--                                            <li><a href="#">Item 14</a></li>-->
<!--                                        </div>-->
<!--                                        <div class="catalog-box">-->
<!--                                            <li><a href="#">Item 11</a></li>-->
<!--                                            <li><a href="#">Item 12</a></li>-->
<!--                                            <li><a href="#">Item 13</a></li>-->
<!--                                            <li><a href="#">Item 14</a></li>-->
<!--                                            <li><a href="#">Item 11</a></li>-->
<!--                                            <li><a href="#">Item 12</a></li>-->
<!--                                            <li><a href="#">Item 13</a></li>-->
<!--                                            <li><a href="#">Item 14</a></li>-->
<!--                                        </div>-->
<!--                                        <div class="catalog-box">-->
<!--                                            <li><a href="#">Item 11</a></li>-->
<!--                                            <li><a href="#">Item 12</a></li>-->
<!--                                            <li><a href="#">Item 13</a></li>-->
<!--                                            <li><a href="#">Item 14</a></li>-->
<!--                                            <li><a href="#">Item 11</a></li>-->
<!--                                            <li><a href="#">Item 12</a></li>-->
<!--                                            <li><a href="#">Item 13</a></li>-->
<!--                                            <li><a href="#">Item 14</a></li>-->
<!--                                        </div>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">Graphic design</a>-->
<!--                                    <ul>-->
<!--                                        <li><a href="#">Item 21</a></li>-->
<!--                                        <li><a href="#">Item 22</a></li>-->
<!--                                        <li><a href="#">Item 23</a></li>-->
<!--                                        <li><a href="#">Item 24</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">Development tools</a>-->
<!--                                    <ul>-->
<!--                                        <li><a href="#">Item 31</a></li>-->
<!--                                        <li><a href="#">Item 32</a></li>-->
<!--                                        <li><a href="#">Item 33</a></li>-->
<!--                                        <li><a href="#">Item 34</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">Web design</a>-->
<!--                                    <ul>-->
<!--                                        <li><a href="#">Item 41</a></li>-->
<!--                                        <li><a href="#">Item 42</a></li>-->
<!--                                        <li><a href="#">Item 43</a></li>-->
<!--                                        <li><a href="#">Item 44</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->

                <div class="contact">
                    <small>Иваново</small>
                    <small>7(3942)</small>
                    <strong>222-962</strong>
                </div>


                <div class="reg">
                    <a href="#" id="#example1" onclick="$('#exampleModal1').arcticmodal()" class="m-dotted">Вход</a>
                    <a href="#" id="#example2" onclick="$('#exampleModal2').arcticmodal()" class="m-dotted">Регистрация</a>
                </div>

                <div class="top-nav">
                    <ul>
                        <li><a href="/info?id=9">Как получить</a></li>
                        <li><a href="/info?id=10">Что с моим заказом?</a></li>
                        <li><a href="/info?id=11">Сервисы</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <a href="#" class="logo"><img src="/images/logo.png" alt=""/></a>

        <div class="search">
            <input type="text"/>
            <input type="submit" value=""/>
        </div>
        <div class="basket">
            <a href="#" id="#example3" onclick="$('#exampleModal3').arcticmodal()" class="m-dotted">
                <img src="/images/basket.png" alt=""/>
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
            <a href="/catalog/list/931"><img src="/images/dr1.png" alt=""/></a>
            <a href="/catalog/list/932"><img src="/images/dr2.png" alt=""/></a>
            <a href="/catalog/list/452"><img src="/images/dr3.png" alt=""/></a>
            <a href="/catalog/list/936"><img src="/images/dr4.png" alt=""/></a>
            <a href="/catalog/list/1420"><img src="/images/dr5.png" alt=""/></a>
            <a href="/catalog/list/835"><img src="/images/dr6.png" alt=""/></a>
            <a href="#" class="draw-arrow"><img src="/images/drow-arrow.png" alt=""/></a>
        </div>

        <div class="footer">
            <div class="nav-bar">
                <ul>
                    <li><a href="/">LAPANA.RU</a></li>
                    <li><a href="/info?id=12">О нас</a></li>
                    <li><a href="/info?id=13">Вакансии</a></li>
                    <li><a href="/info?id=14">Партнерам</a></li>
                    <li><a href="/info?id=6">Контакты</a></li>
                    <li><a href="/info?id=15">Сертификаты</a></li>
                    <li><a href="/info?id=16">Наши скидки</a></li>
                    <li><a href="/info?id=17">Преимущества</a></li>
                </ul>
            </div>
            <div class="nav-bar">
                <ul>
                    <li><a href="/info?id=11">СЕРВИС И ПОМОЩЬ</a></li>
                    <li><a href="/info?id=7">Как сделать заказ</a></li>
                    <li><a href="/info?id=18">Пункты самовывоза</a></li>
                    <li><a href="/info?id=5">Способы оплаты</a></li>
                    <li><a href="/info?id=2">Возврат</a></li>
                    <li><a href="/info?id=19">Правила продажи</a></li>
                    <li><a href="/info?id=2">Доставка</a></li>
                </ul>
            </div>
            <div class="nav-bar">
                <ul>
                    <li><a href="/info?id=14">ПАРТНЕРАМ</a></li>
                    <li><a href="/info?id=20">Франшиза</a></li>
                </ul>
            </div>
            <span>Я одеваюсь в Лапана бесплатно. Хотите знать как?</span>
            <img src="/images/modal-girl.png" class="footer-girl" alt=""/>

            <div class="gift-card">
                <span>
                    ЧТО ПОДАРИТЬ И НЕ ПРОГАДАТЬ? Подарочная карта Lapana.ru – отличный подарок, который обязательно понравится!
                </span>
                <img src="/images/gift-card.png" alt=""/>
                <button>купить</button>
            </div>
        </div>
    </div>
</div>

<?php

$this->renderPartial('/layouts/parts/bottomPanel');
$this->renderPartial('/layouts/parts/login');
$this->renderPartial('/layouts/parts/register');
$this->renderPartial('/layouts/parts/basket');
$this->renderPartial('/layouts/parts/productPreview');
$this->renderPartial('/layouts/parts/social');

?>

</body>
</html>
