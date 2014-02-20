<?php
Yii::app()->clientScript->registerPackage('product');

$this->breadcrumbs = array(
    $product->categories_name => $this->createUrl('catalog/list', ['id' => $product->categories_id]),
    $product->name . ' (' . $product->model . ')',
);

$cart = "
jQuery(document).ready(function($){
    //корзинка
    $('#addToCart').live('click',function(){
        $.ajax({
                  type: 'POST',
                  url: '" . $this->createUrl('/cart/add') . "',
                  data: ({
                        product_id : '" . $product->id . "',
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
                            <?php $list_image = ShopProductsHelper::previewListImg($product); ?>
                            <?php foreach ($list_image as $image) { ?>
                                <li><a class="zoomThumbActive" href='javascript:void(0);'
                                       rel="{gallery: 'gal1', smallimage: '<?= Yii::app()->params['staticUrl'] . $image['small'] ?>',largeimage: '<?= Yii::app()->params['staticUrl'] . $image['large'] ?>"><img
                                            src='<?= Yii::app()->params['staticUrl'] . $image['small'] ?>' alt=""></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="clearfix">
                        <a href="<?= Yii::app()->params['staticUrl'] ?><?= ShopProductsHelper::pathToLargeImg($product->image); ?>"
                           class="lightbox" rel='gal1' title="<?php echo $product->name.', '.$product->model.', '.FormatHelper::markup($product['price']) ?>">
                            <img
                                class="product_img"
                                src="<?= Yii::app()->params['staticUrl'] ?><?= ShopProductsHelper::pathToLargeImg($product->image); ?>"
                                title="<?php echo $product->name.', '.$product->model.', '.FormatHelper::markup($product['price']) ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="tovar-info">
                <p><?php echo $product->name ?></p>
                <span>Артикул <?php echo $product->model ?></span>
                <div class="tovar-more-info">
                    ОПИСАНИЕ
                    <?= $product->description ?>
                    <?php if ($product->manufacturers_id) { ?>
                        <br>СТРАНА ПРОИЗВОДСТВА:   <?= $product->manufacturers ?>
                    <?php } ?>
                </div>
                <?php if(!empty($product->product_options[0]) && !empty($product->product_options[0]->products_new_options_values_name)){ ?>
                <select id="filter_size">
                    <?php foreach ($product->product_options as $option) {
                            if(!empty($option->products_new_options_values_name)){
                        ?>
                        <option
                            value='<?= $option->products_options_values_id ?>'><?= $option->products_new_options_values_name ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <?php } ?>
            </div>

            <div class='inner_price  bottom-price'>

                <div class="price-main">
                       <span>
                            <?= FormatHelper::markup($product['price']) ?>
                       </span>
                    <?php if($product['old_price'] != 0){ ?>
                        <small><?= FormatHelper::markup($product['old_price']) ?></small>
                    <?php } ?>
                </div>

                <div class="btn">
                    <!--            --><?php //if(!Yii::app()->user->isGuest): ?>
                    <!--                <a class="basket" id="addToCart">В КОРЗИНУ</a>-->
                    <!--            --><?php //else: ?>
                    <!--                <a href="--><?php //echo $this->createUrl('site/login') ?><!--"-->
                    <!--                   data-options='{"width":900, "height":355, "modal": true}' class="basket lightbox">В КОРЗИНУ</a>-->
                    <!--            --><?php //endif; ?>
                    <!---->
                    <?php if (!Yii::app()->user->isGuest): ?>
                        <a class="basket addToCart">В КОРЗИНУ</a>
                    <?php else: ?>
                        <a href="<?php echo $this->createUrl('site/login') ?>"
                           data-options='{"width":900, "height":355, "modal": true}' class="basket lightbox">В КОРЗИНУ</a>
                    <?php endif; ?>
                    <input type="hidden" class="product_id" value="<?= $product->id ?>"/>
                </div>



                <div class="footer-social">
                    <script type="text/javascript">(function () {
                            if (window.pluso)if (typeof window.pluso.start == "function") return;
                            if (window.ifpluso == undefined) {
                                window.ifpluso = 1;
                                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                s.type = 'text/javascript';
                                s.charset = 'UTF-8';
                                s.async = true;
                                s.src = ('https:' == window.location.protocol ? 'https' : 'http') + '://share.pluso.ru/pluso-like.js';
                                var h = d[g]('body')[0];
                                h.appendChild(s);
                            }
                        })();
                    </script>
                    <div class="pluso" data-background="transparent" data-options="medium,round,line,horizontal,nocounter,theme=06"
                         data-services="vkontakte,facebook,google,twitter,odnoklassniki" data-url="odezhda-master.ru/"
                         data-title="<?= Yii::app()->params['title'] ?>" data-description="">
                    </div>
                </div>
            </div>

        </div>
    </div>


    <p class="title-cart-like-tovar">Популярные товары</p>

    <div class="slider-clothes">
        <div class="jcarousel-wrapper">
            <div class="jcarousel">
                <ul>
                    <?php foreach ($dataProvider->getData() as $product) { ?>
                        <li>
                            <a href="/catalog/product/<?= $product->id ?>">
                                <img
                                    src="<?= Yii::app()->params['staticUrl'] . ShopProductsHelper::pathToMidImg($product->image) ?>"
                                    alt="<?= $product->image ?>">
                            </a>

                            <div class="info">
                                <a href="/catalog/product/<?= $product->id ?>" class="name"><?= $product->name ?></a>

                                <p><?= FormatHelper::markup($product->price) ?></p>
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
