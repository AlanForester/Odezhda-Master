<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LAPANA</title>
    
    <link href="/css/reset.css" rel="stylesheet" />
    <link href="/css/flick/jquery-ui-1.10.3.custom.css" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" />
    <link href="/css/karta.css" rel="stylesheet" />
    
    
    <!-- JQUERY -->
    <script src="/js/slider/jquery.js"></script>
    <script src="/js/jquery-ui-1.10.3.custom.min.js"></script>
    
     <!-- MODAL -->
    <script src="/js/modal/jquery.arcticmodal-0.3.min.js"></script>
    <link rel="stylesheet" href="/js/modal/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="/js/modal/themes/simple.css">
    
    <script type="text/javascript"> 
        $(function() {
          if ($.browser.msie && $.browser.version.substr(0,1)<7)
          {
			$('li').has('ul').mouseover(function(){
				$(this).children('ul').show();
				}).mouseout(function(){
				$(this).children('ul').hide();
				})
          }
        });        
    </script> 
    
    <!-- KARTA SLIDER -->
    <script src="/js/karta-slider/jquery.jqzoom-core-pack.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/js/karta-slider/jquery.jqzoom.css" type="text/css">
    <script type="text/javascript">
		$(document).ready(function() {
			$('.jqzoom').jqzoom({
					zoomType: 'reverse',
					lens:true,
					preloadImages: false,
					alwaysOn:false
				});
			//$('.jqzoom').jqzoom();
		});	
	</script>
    
    <!-- TABS -->
    <script type="text/javascript">
		$(document).ready(function() {
		
			//Default Action
			$(".tab_content").hide(); //Hide all content
			$("ul.tabs li:first").addClass("active").show(); //Activate first tab
			$(".tab_content:first").show(); //Show first tab content
		
			//On Click Event
			$("ul.tabs li").click(function() {
				$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab_content").hide(); //Hide all tab content
				var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active content
				return false;
			});
		
		});
	</script>
</head>

<body>
	<div class="header-wrapper">
        <div class="header">
        
        	<div class="top-panel-fixed">
            	<div class="top-wrapper">
            
                    <div class="contact"
                        <div class="contact">
                        <small>Иваново</small>
                        <small>+7(3942)</small>
                        <strong>222-962</strong>
                    </div>
                    
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
                    <span>4</span>
                </a>
            </div>
            <div class="reg">
                <a href="#" id="#example1" onclick="$('#exampleModal1').arcticmodal()" class="m-dotted">Вход</a>
                <br />
            	<a href="#" id="#example2" onclick="$('#exampleModal2').arcticmodal()" class="m-dotted">Регистрация</a>
            </div>
        </div>
    </div>
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
	</div>

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
<script>
$(document).ready(function(){
            $(".our-goods").click(function(){
            $(".our-goods-modal").slideToggle("slow");
            $(this).toggleClass("active");
			var a = $(".our-goods").text();
			if (a=='-') {$(".our-goods").text('+') } else {$(".our-goods").text('-')};
			return false;			
        });
		
		$(".your-goods").click(function(){
            $(".your-goods-modal-wrapper").slideDown("slow");            
			return false;
		});
		$(".close-modal-see-goods").click(function(){
            $(".your-goods-modal-wrapper").slideUp("slow");            
			return false;
		});
});
</script>
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
		
<script>
$(function(){
    $('#exampleModal').arcticmodal();
});
</script>

<script>
	$("#up").click(function(){
		$("body").animate({"scrollTop":0},"slow");
	});
</script>

<a href="#" class="scroll-top" id="up"></a>

</body>
</html>