<?php
/**
 * @var RetailController $this
 * @var string $content
 */
$js = "
jQuery(document).ready(function($){
    $('.lightbox').lightbox();

//для формы регистрации
    $('#registration #reg_submit').live('click',function(){
        $('#registr button').attr('disabled','disabled');
        $('#registr #reg_submit').hide();
        $('#registr #reg_submit_process').show();
        var validate=true;
        $('#registration .required').each(function(){
            validate=false;
            $(this).toggleClass('error',($(this).val() == ''));

        });
        if($('#registration .required.error').length == 0){
                $.ajax({
                  type: 'POST',
                  url: '" . $this->createUrl('/site/registration') . "',
                  data: $('#registr').serialize(),
                  dataType:'json',
                  success: function(data) {

                        if (data){
                              $.lightbox().shake();
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
        $('#registr button').removeAttr('disabled');
        $('#registr #reg_submit_process').hide();
        $('#registr #reg_submit').show();
    });

//для формы логина
    $('#login #openRegForm').live('click',function(){
        $.lightbox().close();
        setTimeout(function() {
            $('#aReg').trigger('click');
        }, 500);
    })
    });
//восстановление пароля - получение формочки
    $('#login #reset_pass').live('click',function(){
        $.lightbox().close();
        setTimeout(function() {
            $.lightbox('" . $this->createUrl('/site/recovery') . "',{'width':430, 'height':300, 'modal': true});
        }, 500);

    });

   //восстановление пароля
    $('#recover_submit').live('click',function(){
        if($('#email').val().length!=0){
            $('.jquery-lightbox-background').addClass('jquery-lightbox-loading');
            $('.jquery-lightbox-html').css('display','none');
            $.ajax({
                          type: 'POST',
                          url: '" . $this->createUrl('/site/recovery') . "',
                          data: $('#rec').serialize(),
                          success: function(data) {
                                if (data){
                                      $('.jquery-lightbox-html').html(data);
                                }
                                $('.jquery-lightbox-background').removeClass('jquery-lightbox-loading');
                                $('.jquery-lightbox-html').css('display','block');
                          }
            });
        }
        else  {
            $.lightbox().shake();
            $('#email').css('border','1px solid #E2136F');
        }

    });

    $('#login #login_submit').live('click',function(){
        $('#login button').attr('disabled','disabled');
        $('#login #login_submit').hide();
        $('#login #login_submit_process').show();
        var validate=true;
        $('#login .required').each(function(){
            validate=false;
            $(this).toggleClass('error',($(this).val() == ''));

        });
        if($('#login .required.error').length == 0){
                $.ajax({
                  type: 'POST',
                  url: '" . $this->createUrl('/site/login') . "',
                  data: $('#log').serialize(),
                  dataType:'json',
                  success: function(data) {

                        if (data){
                              $.lightbox().shake();
                              $('#login_error').text('Ошибка:');
                              var ul='<ul>';
                              $.each(data,function (key, value){
                                ul+='<li>'+value+'</li>'
                              });
                              ul+='</ul>';
                              $('#login_error').append(ul);
                              $('#login_error').css('display','block');
                        }
                        else {
                            location.reload();
                        }
                  },
                  error:  function(xhr, str){
                        $('#login_error').text('Ошибка соединения с сервером');
                        $('#login_error').css('display','block');
                    }
                });
        }
        $('#login button').removeAttr('disabled');
        $('#login #login_submit_process').hide();
        $('#login #login_submit').show();
    });

//корзинка
    //увеличение количества товара в корзине
    $('.plus').live('click',function(){
       var counter=$(this);
       if ($(this).prev('.count').text()<100){
            $.ajax({
                          type: 'POST',
                          url: '" . $this->createUrl('/cart/changeCounter') . "',
                          dataType:'json',
                          data: ({
                                product_id : $(this).nextAll('.prod_id').val(),
                                change : 'plus',
                                params : $(this).nextAll('.prod_params').val(),
                          }),
                          success: function(data) {
                                if (data){
                                      counter.prev('.count').text(data.items);
                                      $('#jqeasytrigger .col').text(data.products);
                                      $('#jqeasytrigger .sum').text(data.total_price);
                                      $('.end-price').text(data.total_price);
                                      $('#jqeasypanel .cart_title').text(data.products);
                                      counter.prevAll('.price-b').text(data.price);
                                      $('.bottom-panel').stop(true,true).effect('highlight', {}, 2000);
                                }

                          }
                      });
        }
     });

    //уменьшение количества товара в корзине
    $('.minus').live('click',function(){
       var counter=$(this);
       if ($(this).next('.count').text()>1){
            $.ajax({
                          type: 'POST',
                          url: '" . $this->createUrl('/cart/changeCounter') . "',
                          dataType:'json',
                          data: ({
                                product_id : $(this).nextAll('.prod_id').val(),
                                change : 'minus',
                                params : $(this).nextAll('.prod_params').val(),
                          }),
                          success: function(data) {
                                if (data){
                                      counter.next('.count').text(data.items);
                                      $('#jqeasytrigger .col').text(data.products);
                                      $('#jqeasytrigger .sum').text(data.total_price);
                                      $('.end-price').text(data.total_price);
                                      $('#jqeasypanel .cart_title').text(data.products);
                                      counter.prevAll('.price-b').text(data.price);
                                      $('.bottom-panel').stop(true,true).effect('highlight', {}, 2000);
                                }

                          }
                      });
       }
    });

    //удаление товара из корзины
    $('.del-good').live('click',function(){
            $.ajax({
                          type: 'POST',
                          url: '" . $this->createUrl('/cart/deleteProduct') . "',
                          data: ({
                                product_id : $(this).nextAll('.prod_id').val(),
                                params : $(this).nextAll('.prod_params').val(),
                          }),
                          success: function(data) {
                                if (data){
                                      $('#panel').html(data);
                                      $('#jqeasypanel').jqEasyPanel({
                                            position: 'bottom'
                                      });
                                      $('.open').click(function(){
                                            $('#jqeasytrigger').stop(true,true).animate({bottom:'246px'});
                                      });
                                      $('.close').click(function(){
                                            $('#jqeasytrigger').stop(true,true).animate({bottom:'0px'});
                                      });
                                      $('.goods-slider ul#items').easyPaginate({
                                             step:4
                                      });
                                      $('.bottom-panel').stop(true,true).effect('highlight', {}, 2000);
                                      $('.open').trigger('click');
                                }

                          }
                      });
     });

     //удаление всех товаров из корзины
    $('.clear').live('click',function(){
       if ($(this).next('.count').text()<100){
            $.ajax({
                          type: 'POST',
                          url: '" . $this->createUrl('/cart/deleteAll') . "',
                          success: function(data) {
                                if (data){
                                      $('#panel').html(data);
                                      $('#jqeasypanel').jqEasyPanel({
                                            position: 'bottom'
                                      });
                                      $('.open').click(function(){
                                            $('#jqeasytrigger').stop(true,true).animate({bottom:'246px'});
                                      });
                                      $('.close').click(function(){
                                            $('#jqeasytrigger').stop(true,true).animate({bottom:'0px'});
                                      });
                                      $('.goods-slider ul#items').easyPaginate({
                                             step:4
                                      });
                                      $('.bottom-panel').stop(true,true).effect('highlight', {}, 2000);
                                }

                          }
                      });
        }
     });

    //оформление заказа
    $('#order_submit').live('click',function(){
            $.ajax({
                          type: 'POST',
                          url: '" . $this->createUrl('/cart/makeOrder') . "',
                          data: $('#order_step1').serialize(),
                          dataType:'json',
                          success: function(data) {
                                if (data.lightbox){
                                      $('.jquery-lightbox-html').html(data.lightbox);
                                }
                                if (data.bottomPanel){
                                      $('#panel').html(data.bottomPanel);
                                      $('.bottom-panel').stop(true,true).effect('highlight', {}, 2000);
                                }
                                $('#jqeasypanel').jqEasyPanel({
                                        position: 'bottom'
                                  });
                                  $('.open').click(function(){
                                        $('#jqeasytrigger').stop(true,true).animate({bottom:'246px'});
                                  });
                                  $('.close').click(function(){
                                        $('#jqeasytrigger').stop(true,true).animate({bottom:'0px'});
                                  });
                                  $('.goods-slider ul#items').easyPaginate({
                                         step:4
                                  });
                          }
                      });
     });

";

$basket = "
jQuery(document).ready(function($){
    //корзинка
    $('.addToCart').live('click',function(){
        var size = $(this).siblings('.product_size').val();
        if(!size){
            size = $('a.razmer-one.selected').attr('href');
        }
        var params = size?size:0;

        if(!size || params) {
            $.ajax({
                      type: 'POST',
                      url: '" . $this->createUrl('/cart/add') . "',
                      data: ({
                            product_id : $(this).next('.product_id').val(),
                            params : params,
                      }),
                      success: function(data) {
                            if (data){
                                  $('#panel').html(data);
                                  $('#jqeasypanel').jqEasyPanel({
                                        position: 'bottom'
                                  });
                                  $('.open').click(function(){
                                        $('#jqeasytrigger').stop(true,true).animate({bottom:'246px'});
                                  });
                                  $('.close').click(function(){
                                        $('#jqeasytrigger').stop(true,true).animate({bottom:'0px'});
                                  });
                                  $('.goods-slider ul#items').easyPaginate({
                                         step:4
                                  });
                                  $('.bottom-panel').stop(true,true).effect('highlight', {}, 2000);

                            }

                      }
                  });
        }
        else{
            alert ('Выберите, пожалуйста, размер товара.');
        }
    });
});

$(document).ready(function() {
        $('#jqeasypanel').jqEasyPanel({
            position: 'bottom'
        });
        $('.open').click(function(){
            $('#jqeasytrigger').animate({bottom:'246px'});
        });
        $('.close').click(function(){
            $('#jqeasytrigger').animate({bottom:'0px'});
        });
        $('.goods-slider ul#items').easyPaginate({
                step:4
        });
});
";

Yii::app()->getClientScript()->registerScript('basket', $basket, CClientScript::POS_END);

Yii::app()->getClientScript()->registerScript('lightbox', $js, CClientScript::POS_END);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?= CHtml::encode($this->pageTitle); ?></title>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>

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
                           data-options='{"width":860, "height":355, "modal": true}' class="m-dotted lightbox"
                           id="aLog">Вход</a>
                        <a href="<?php echo $this->createUrl('site/registration') ?>"
                           data-options='{"width":860, "height":410, "modal": true}'
                           class="m-dotted lightbox" id="aReg">Регистрация</a>
                    <?php } else { ?>
                        <span>Вы вошли как: <strong><?php echo Yii::app()->user->name; ?></strong></span>
                        <a href="<?= $this->createUrl('customer/index') ?>" class="m-dotted">Личный кабинет</a>
                        <a href="<?php echo $this->createUrl('site/logout') ?>" id="#exit"
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
            <form id='text-search' action='/catalog/list/' method='get'>
                <input name='text_search' type="text"
                       value='<?= (Yii::app()->request->getQuery('text_search') ? : '') ?>'/>
                <input type="submit" value=""/>
            </form>
        </div>
    </div>
</div>
<?php if (isset($this->breadcrumbs)): ?>
    <div class="wrapper">
        <?php $this->widget(
            'zii.widgets.CBreadcrumbs', array(
                                          'links' => $this->breadcrumbs,
                                          'homeLink' => CHtml::link('Главная', '/'),
                                          'separator' => '/',
                                      )
        ); ?><!-- breadcrumbs -->
    </div>
<?php endif ?>
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
                    <!--                    <li><a href="-->
                    <?php //echo $this->createUrl('info/view', ['id' => '14']) ?><!--">Партнерам</a></li>-->
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

            <div class="nav-bar nav-last">
                <ul>
                    <li><span>Контакты</span></li>
                    <li><span>тел.: <?= Yii::app()->params['contactTel'] ?></span></li>
                    <li><span>email: <a href="mailto:<?= Yii::app()->params['contactEmail'] ?>"><?= Yii::app()->params['contactEmail'] ?></a></span></li>
                    <li><span><?= Yii::app()->params['contactAddress'] ?></span></li>
                    <li><a href="/map/">Карта проезда</a></li>
                    <li><span>&nbsp;</span></li>
                    <li>&copy; 2014 lapana.ru</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php

if (!Yii::app()->user->isGuest) {
    ?>
    <div id="panel">
        <?php $this->renderPartial('/layouts/parts/bottomPanel'); ?>
    </div>
<?php
}

//$this->renderPartial('/layouts/parts/login');
//$this->renderPartial('/layouts/parts/register');
//$this->renderPartial('/layouts/parts/basket');
//$this->renderPartial('/layouts/parts/productPreview');
//$this->renderPartial('/layouts/parts/social');

?>

</body>
</html>
