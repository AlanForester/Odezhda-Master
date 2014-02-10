<?php
/**
 * @var RetailController $this
 * @var string $content
 */
$js = "
jQuery(document).ready(function($){
    $('.lightbox').lightbox();

    $('#registration #reg_submit').live('click',function(){
//        $('.required').css({'border':'none'});
        var validate=true;
        $('#registration .required').each(function(){
            validate=false;
            $(this).toggleClass('error',($(this).val() == ''));

        });
        if($('#registration .required.error').length == 0){
                $.ajax({
                  type: 'POST',
                  url: '/site/registration',
                  data: $('#registr').serialize(),
                  dataType:'json',
                  success: function(data) {
                        if (data){
                              $('#reg_error').text('Ошибка:');
                              var ul='<ul>';
                              $.each(data,function (key, value){
                                ul+='<li>'+value+'</li>'
                              });
                              ul+='</ul>';
                              $('#reg_error').append(ul);
                              $('#reg_error').css('display','block');
                        }
                        else {
                            location.reload();
                        }
                  },
                  error:  function(xhr, str){
                        $('#reg_error').text('Ошибка соединения с сервером');
                        $('#reg_error').css('display','block');
                    }
                });
        }
    });
//
//    $('#email').live('focus',function(){
//        $('#email').css({'border':'none'});
//    });
//
//    $('#phone').live('focus',function(){
//        $('#phone').css({'border':'none'});
//    });
});
";

Yii::app()->getClientScript()->registerScript('lightbox', $js, CClientScript::POS_END);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
    <title><?= CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="header-wrapper">
    <div class="header">

        <div class="top-panel-fixed">
            <div class="top-wrapper">
                <div class="contact">
                    <small>Иваново</small>
                    <small>7(3942)</small>
                    <strong>222-962</strong>
                </div>

                <div class="reg">
                    <?php if (empty(Yii::app()->user->id)) { ?>
                        <a href="<?php echo $this->createUrl('site/login') ?>"
                           data-options='{"width":900, "height":330, "modal": true}' class="m-dotted lightbox">Вход</a>
                        <a href="<?php echo $this->createUrl('site/registration') ?>"
                           data-options='{"width":900, "height":480, "modal": true}'
                           class="m-dotted lightbox">Регистрация</a>
                    <?php } else { ?>
                        <span>Вы вошли как: <strong><?php echo Yii::app()->user->name; ?></strong></span>
                        <a href="#" id="#example1" class="m-dotted">Личный кабинет</a>
                        <a href="<?php echo $this->createUrl('site/logout') ?>" id="#example2"
                           class="m-dotted">Выход</a>
                    <?php } ?>
                </div>

                <div class="top-nav">
                    <ul>
                        <li><a href="<?php echo $this->createUrl('info/view', ['id' => '9']) ?>">Как получить</a></li>
                        <li><a href="<?php echo $this->createUrl('info/view', ['id' => '10']) ?>">Что с моим
                                заказом?</a></li>
                        <li><a href="<?php echo $this->createUrl('info/view', ['id' => '11']) ?>">Сервисы</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <a href="/" class="logo"><img src="/images/logo.png" alt=""/></a>

        <div class="search">
            <input type="text"/>
            <input type="submit" value=""/>
        </div>
        <!--        <div class="basket">-->
        <!--            <a href="#" id="#example3" onclick="$('#exampleModal3').arcticmodal()" class="m-dotted">-->
        <!--                <img src="/images/basket.png" alt=""/>-->
        <!--                <small>В корзине</small>-->
        <!--                <span>4</span>-->
        <!--            </a>-->
        <!--        </div>-->
    </div>
</div>

<?php echo $content ?>

<div class="footer-wrapper">
    <div class="footer-box">

        <div class="draw-icon">
            <a href="<?php echo $this->createUrl('catalog/list', ['id' => '931']) ?>"><img src="/images/dr1.png"
                                                                                           alt=""/></a>
            <a href="<?php echo $this->createUrl('catalog/list', ['id' => '932']) ?>"><img src="/images/dr2.png"
                                                                                           alt=""/></a>
            <a href="<?php echo $this->createUrl('catalog/list', ['id' => '452']) ?>"><img src="/images/dr3.png"
                                                                                           alt=""/></a>
            <a href="<?php echo $this->createUrl('catalog/list', ['id' => '936']) ?>"><img src="/images/dr4.png"
                                                                                           alt=""/></a>
            <a href="<?php echo $this->createUrl('catalog/list', ['id' => '1420']) ?>"><img src="/images/dr5.png"
                                                                                            alt=""/></a>
            <a href="<?php echo $this->createUrl('catalog/list', ['id' => '835']) ?>"><img src="/images/dr6.png"
                                                                                           alt=""/></a>
            <a href="#" class="draw-arrow"><img src="/images/drow-arrow.png" alt=""/></a>
        </div>

        <div class="footer">
            <div class="nav-bar">
                <ul>
                    <li><a href="/">LAPANA.RU</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '12']) ?>">О нас</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '13']) ?>">Вакансии</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '14']) ?>">Партнерам</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '6']) ?>">Контакты</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '15']) ?>">Сертификаты</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '16']) ?>">Наши скидки</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '17']) ?>">Преимущества</a></li>
                </ul>
            </div>
            <div class="nav-bar">
                <ul>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '11']) ?>">СЕРВИС И ПОМОЩЬ</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '7']) ?>">Как сделать заказ</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '18']) ?>">Пункты самовывоза</a>
                    </li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '5']) ?>">Способы оплаты</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '2']) ?>">Возврат</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '19']) ?>">Правила продажи</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '2']) ?>">Доставка</a></li>
                </ul>
            </div>
            <div class="nav-bar">
                <ul>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '14']) ?>">ПАРТНЕРАМ</a></li>
                    <li><a href="<?php echo $this->createUrl('info/view', ['id' => '20']) ?>">Франшиза</a></li>
                </ul>
            </div>
            <!--            <span>Я одеваюсь в Лапана бесплатно. Хотите знать как?</span>-->
            <!--            <img src="/images/modal-girl.png" class="footer-girl" alt=""/>-->

            <!--            <div class="gift-card">-->
            <!--                <span>-->
            <!--                    ЧТО ПОДАРИТЬ И НЕ ПРОГАДАТЬ? Подарочная карта Lapana.ru – отличный подарок, который обязательно понравится!-->
            <!--                </span>-->
            <!--                <img src="/images/gift-card.png" alt=""/>-->
            <!--                <button>купить</button>-->
            <!--            </div>-->
        </div>
    </div>
</div>

<?php

// todo: сделать корзинку в нижней панели
//$this->renderPartial('/layouts/parts/bottomPanel');

//$this->renderPartial('/layouts/parts/login');
//$this->renderPartial('/layouts/parts/register');
//$this->renderPartial('/layouts/parts/basket');
//$this->renderPartial('/layouts/parts/productPreview');
//$this->renderPartial('/layouts/parts/social');

?>

</body>
</html>
