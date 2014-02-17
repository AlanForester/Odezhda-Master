<?php
Yii::app()->clientScript->registerPackage('index');


//    echo(Yii::app()->user->identityCookie);
//exit;
//print_r($day_data);
//exit;
?>

<div class="wrapper">
<div class="left-nav">
    <ul>
        <?php foreach ($this->categories as $category) { ?>
            <li>
                <a href="/catalog/list/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a><span>></span>
                <?php if (!empty($category['children'])) {
                    $i = 0; ?>

                    <ul>

                        <div class="catalog-box">
                            <?php foreach ($category['children'] as $child){
                            $i++; ?>

                            <?php if ($i % 16 == 0 && $i > 0){ ?>
                        </div>
                        <div class="catalog-box">
                            <?php } ?>
                            <li><a href="/catalog/list/<?php echo $child['id']; ?>"><?php echo $child['name']; ?></a>
                            </li>
                            <?php } ?>
                        </div>
                    </ul>

                <?php } ?>
            </li>
        <?php } ?>

    </ul>
    <a href="/catalog/list/" class="all-catalog">Весь каталог</a>
</div>
<div class="slider">

    <div class="bannercontainer responsive">
        <div class="banner">
            <ul>
                <!-- THE 1 SLIDE -->
                <li data-transition="turnoff" data-slotamount="1" data-masterspeed="300">
                    <img src="/images/slides/girl.png" alt=""/>

                    <div class="caption large_text fade"
                         data-x="509"
                         data-y="290"
                         data-speed="300"
                         data-start="800"
                         data-easing="easeOutExpo"></div>


                    <div class="caption large_black_text randomrotate"
                         data-x="450"
                         data-y="300"
                         data-speed="300"
                         data-start="1400"
                         data-easing="easeOutExpo">Оформите заказ на LAPANA.RU <br/>и получите его<br/> в ближайшем к
                        Вам магазине*
                    </div>

                    <div class="caption sfb"
                         data-x="440"
                         data-y="50"
                         data-speed="300"
                         data-start="2000"
                         data-easing="easeOutBack"><img src="/images/slides/blue-cirkle.png" alt="Image 7"></div>

                    <div class="caption very_large_black_text randomrotate"
                         data-x="470"
                         data-y="75"
                         data-speed="300"
                         data-start="1100"
                         data-easing="easeOutExpo">СТИЛЬНО<br/>НЕ ЗНАЧИТ<br/>ДОРОГО
                    </div>


                    <div class="caption bold_red_text randomrotate"
                         data-x="470"
                         data-y="155"
                         data-speed="300"
                         data-start="1700"
                         data-easing="easeOutExpo">Первый в Иваново<br/>интернет-гипермаркет<br/>с низкими ценами.
                    </div>

                    <div class="caption bold_price_text randomrotate"
                         data-x="470"
                         data-y="195"
                         data-speed="200"
                         data-start="1100"
                         data-easing="easeOutExpo">Новые поступления<br/>каждый день!
                    </div>

                </li>

                <!-- THE 2 SLIDE -->
                <li data-transition="slideleft" data-slotamount="1" data-masterspeed="300"
                    data-thumb="/images/slides/thumb5.jpg">

                    <img src="/images/slides/slide4.jpg">

                    <div class="caption large_text sft"
                         data-x="50"
                         data-y="44"
                         data-speed="300"
                         data-start="800"
                         data-easing="easeOutExpo">TOUCH ENABLED
                    </div>

                    <div class="caption medium_text sfl"
                         data-x="79"
                         data-y="82"
                         data-speed="300"
                         data-start="1100"
                         data-easing="easeOutExpo">AND
                    </div>

                    <div class="caption large_text sfr"
                         data-x="128"
                         data-y="78"
                         data-speed="300"
                         data-start="1100"
                         data-easing="easeOutExpo"><span style="color: #ffc600;">RESPONSIVE</span></div>

                    <div class="caption lfl"
                         data-x="53"
                         data-y="192"
                         data-speed="300"
                         data-start="1400"
                         data-easing="easeOutExpo"><img src="/images/slides/imac.png" alt="Image 4"></div>

                    <div class="caption lfl"
                         data-x="253"
                         data-y="282"
                         data-speed="300"
                         data-start="1500"
                         data-easing="easeOutExpo"><img src="/images/slides/ipad.png" alt="Image 5"></div>

                    <div class="caption lfl"
                         data-x="322"
                         data-y="313"
                         data-speed="300"
                         data-start="1600"
                         data-easing="easeOutExpo"><img src="/images/slides/iphone.png" alt="Image 6"></div>
                </li>


                <!-- THE 3 SLIDE -->
                <li data-transition="flyin" data-slotamount="1" data-masterspeed="300"
                    data-thumb="/images/slides/thumb6.jpg">
                    <img src="/images/slides/slide51.jpg">

                    <div class="caption large_text sfl"
                         data-x="38"
                         data-y="200"
                         data-speed="300"
                         data-start="1000"
                         data-easing="easeOutExpo">A Happy
                    </div>

                    <div class="caption large_text sfl"
                         data-x="37"
                         data-y="243"
                         data-speed="300"
                         data-start="1300"
                         data-easing="easeOutExpo">Holiday Season
                    </div>

                    <div class="caption randomrotate"
                         data-x="610"
                         data-y="174"
                         data-speed="800"
                         data-start="1600"

                         data-easing="easeOutExpo"><img src="/images/slides/TP_logo.png" alt="Image 4"></div>
                </li>
            </ul>

            <!-- CORRED -->
            <div class="tp-bannertimer"></div>
        </div>
    </div>
</div>
<div class="tovar-day">
    <p>товар дня</p>
    <img src="<?= Yii::app()->params['staticUrl'] ?><?= ShopProductsHelper::pathToMidImg($day_data->image); ?>" alt="Товар дня">
    <a href="/catalog/product/<?php echo $day_data->id; ?>"><?php echo $day_data->name . ' (' . $day_data->model . ')'; ?></a>
    <span><?=FormatHelper::markup($day_data->price) ?></span>
    <h5><?=FormatHelper::markup($day_data->old_price) ?></h5>
</div>
<div class="info-user">
    <div class="box1">
        <h2>1000 платьев</h2>

        <h3>на каждый день</h3>
        <a href="/catalog/list/452">смотреть</a>
    </div>
    <div class="box2">
        <h2>распродажа</h2>

        <h3>круглый год</h3>
        <a href="/catalog/list/590">смотреть</a>
    </div>
    <div class="box3">
        <h2>новинки</h2>

        <h3>каждый день</h3>
        <a href="/catalog/list/?sort=date">смотреть</a>
    </div>
</div>

<div class="main-tabs">
    <div id="tabs">
        <div class="tab-menu">
            <ul>
                <li class="displayed_tab"><a href="#fragment-1">Новинки</a></li>
                <li><a href="#fragment-2">Lapa цена</a></li>
                <li><a href="#fragment-3">лидер продаж</a></li>
                <li><a href="#fragment-4">гид по обуви</a></li>
                <li><a href="#fragment-5">остатки сладки</a></li>
            </ul>
        </div>

        <div id="fragment_holder">
            <?php
            $i=1;
            foreach($this->catalogData as $catalog){ ?>

                <div id="fragment-<?php echo $i; ?>" class="fragment <?php  if($i==1){echo 'displayed_tab_content'; }?> ">
                    <?php ?>
                    <?php foreach ($catalog as $product) { ?>
                        <div class="tab-var">

                            <img class="tab-var-image" src="<?= Yii::app()->params['staticUrl'] ?><?=ShopProductsHelper::pathToMidImg($product['image']); ?>" alt=""/>
                            <a href="/catalog/product/<?php echo $product['id']; ?>"><?php echo $product['name'] . ' (' . $product['model'] . ')'; ?></a>

                            <span><?=FormatHelper::markup($product['price']) ?></span>
                            <?php if ($product['old_price'] != 0) { ?>
                                <h5><?=FormatHelper::markup($product['old_price']) ?><</h5>
                            <?php } ?>

                            <div class="var-all">
                                <a href="/catalog/list/<?php echo $product['category'] ?>">Вся одежда<img src="/images/var-img-more.png" alt=""/></a>
                            </div>
                        </div>

                    <?php } $i++; ?>
                </div>
            <?php } ?>
        </div>
<!--        <div class="left-skidka">-->
<!--            <form action="/site/discountsend">-->
<!--                <p>ПОЛУЧИ СКИДКУ 10%</p>-->
<!--                <h6>ПОДПИШИТЕСЬ НА РАССЫЛКУ И ВЫ ПЕРВЫМИ БУДЕТЕ В КУРСЕ САМЫХ ВЫГОДНЫХ ПРЕДЛОЖЕНИЙ.</h6>-->
<!--                <input type="text" name="name" placeholder="Имя"/>-->
<!--                <input type="text" name="email" placeholder="E-mail"/>-->
<!--                <button>Отправить<img src="/images/var-img-more.png" alt=""/></button>-->
<!--            </form>-->
<!--        </div>-->
    </div>


</div>

<?php
foreach ($banners as $n=>$b){
    $num = $n == 0? 'one' : ($n == 1? 'two' : 'three');
    echo '<div class="skidki '.$num.'">';
    if ($b){
        echo '<a href="'.$b->url.'"><img src="'.$b->images.'" alt="'.$b->name.'" /></a>';
    }
    echo '</div>';
}
?>

<!--<div class="social-box">-->
<!--    <p>Давайте дружить!</p>-->
<!--    <img src="/images/social-box.png" alt=""/>-->
<!--</div>-->

</div>