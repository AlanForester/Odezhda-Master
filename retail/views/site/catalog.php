<?php
Yii::app()->clientScript->registerPackage('catalog');

$colors = ['grey', 'violet', 'green', 'magent', 'yellow', 'blue', 'white', 'black', 'l-magent', 'red', 'orange', 'purple'];
$sizes = ['XXXL', 'XXL', 'XL', 'M', 'S', '40', '42', '44', '46', '48', '50', '52'];
$curCategory=$currentCetegory->rel_description->categories_id
//print_r($dataProvider->getData());
//print_r($currentCategoryNumber);exit;
//print_r(FormatHelper::markupNumber($limitPrice['min_price']));
//exit;

?>
<script>
    $(document).ready(function () {
        $("#accordion").accordion({
            heightStyle: "content",
            active: <?= $currentCategoryNumber!==false?$currentCategoryNumber:999 ?>
        });

        $('#catalog_order').change(function () {
//            $(this).val();
//              location.href=location.href+'?sort='+$(this).val();
//            location.href =
//          $('#filter_order').val($(this).val());
            $('#left_options').submit();
        });

        $('#order option').each(function (index, value) {
            if ($(this).val() == '<?php echo Yii::app()->request->getQuery('order')?>') {
                $(this).attr('selected', 'selected');
            }
        });

        $("#slider-range").slider({
            range: true,
            min: <?=FormatHelper::markupNumber($limitPrice['min_price'])?:10?>,
            max: <?=FormatHelper::markupNumber($limitPrice['max_price'])?:10000?>,
            values: [ <?=Yii::app()->request->getQuery('min_price')?:$limitPrice['min_price']?:10?>, <?=Yii::app()->request->getQuery('max_price')?:$limitPrice['max_price']?:10000?> ],
            slide: function (event, ui) {
                $("#amount").html(ui.values[ 0 ] + "р. - " + ui.values[ 1 ] + " р.");
                $('#min_price').val(ui.values[ 0 ]);
                $('#max_price').val(ui.values[ 1 ]);
            }
        });

        $("#amount").html($("#slider-range").slider("values", 0) +
            "р. - " + $("#slider-range").slider("values", 1) + "р.");
    });


</script>
<form id='left_options' method="get" action='<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>'>

<div class="catalog-title">
    <div class="title">
        <p><?php echo $catName; ?></p>
    </div>
</div>
<div class="wrapper">
<div class="left-option">

    <div class="item-options">
        <!--        <div class="title">-->
        <!--            <h6>ЦВЕТ</h6>-->
        <!--            <button id='clear_color'>сбросить х</button>-->
        <!--        </div>-->
        <!--        <div class="color">-->
        <!--            --><?php
        //            foreach($colors as $color){
        //                echo '
        //                <div>
        //                    <a href="#" class="'.$color.'" title="'.$color.'"></a>
        //                    <input name="color[]" value="'.$color.'" type="checkbox" '.(in_array($color,$filter['color'])?'checked':'' ).' />
        //                </div>
        //                ';
        //            }
        //
        ?>
        <!--        </div>-->
        <!--        <div class="title">-->
        <!--            <h6>размер</h6>-->
        <!--            <button  id='clear_size'>сбросить х</button>-->
        <!--        </div>-->
        <?php
            $hideCategiries=[478,477,479, 543, 691, 692, 835, 865, 873, 938, 939, 940, 982, 988,
                             998, 999, 1002, 1034, 1111, 1112, 1113, 1114, 1163,
                             1275, 1302, 1305, 1306, 1310, 1313, 1347, 1422, 1424,
                             1425, 932,712, 833, 834, 967, 972, 1098, 1115, 1314, 1315, 1316, 1323,
                             1331, 1355, 1372 ,1411 ,1412 ,1413 ,1416 ,935 ,1130, 1341, 1324, 1326,
                             1327, 1328, 1329, 1430, 1433, 1304, 1357, 1358, 1359,
                             1360, 1361, 1362, 1429, 1408, 1410, 1336, 1406, 1421, 1431, 1432, 1420];
            $showOptions=true;

            foreach($hideCategiries as $curHiddenCategory){
               if($curHiddenCategory==$curCategory){
                   $showOptions=false;
                   break;
               }
            }
        ?>

        <?php if($showOptions){ ?>
                <div class="razmer">
        <?php
                    foreach($sizes as $size){
                        echo '
                        <div>
                            <input name="size[]" value="'.$size.'" type="checkbox" '.(in_array($size,$criteria['filter']['size'])?'checked':'' ).' />
                            <span>'.$size.'</span>
                        </div>
                        ';
                    }
        ?>
                </div>
        <?php } ?>
        <div class="title">
            <h6>цена</h6>
        </div>
        <div class="price">
            <p>

            <p id="amount" style="border:0; color:#f6931f; font-weight:bold;text-align:center;"></p>
            <input type="hidden" id="min_price" name='min_price'
                   value='<?= Yii::app()->request->getQuery('min_price') ? : $limitPrice['min_price'] ?>'>
            <input type="hidden" id="max_price" name='max_price'
                   value='<?= Yii::app()->request->getQuery('max_price') ? : $limitPrice['max_price'] ?>'>
            </p>

            <div id="slider-range"></div>
        </div>
        <!--        <button id='send_left_options'>Отправить</button>-->
        <input type='submit' id='send_left_options' value='Отправить'>

    </div>

    <div class="accord-item">
        <div id="accordion">
            <?php
            foreach ($categories as $category) {
                if ($currentCetegory->rel_description->categories_id == $category['id']) {
                    echo '<h3 class="active_elem">' . $category['name'] . '</h3>';
                } else {
                    echo '<h3>' . $category['name'] . '</h3>';
                }
                echo '<div><ul>';
                if (isset($category['children'])) {
                    foreach ($category['children'] as $child) {
                        if ($currentCetegory->rel_description->categories_id == $child['id']) {
                            echo '<li><a class="active_elem" href="' . $this->createUrl('catalog/list', ['id' => $child['id']]) . '">' . $child['name'] . '</a></li>';
                        } else {
                            echo '<li><a href="' . $this->createUrl('catalog/list', ['id' => $child['id']]) . '">' . $child['name'] . '</a></li>';
                        }
                    }
                }
                echo '<li class="all-items"><a href="' . $this->createUrl('catalog/list', ['id' => $category['id']]) . '">Все товары раздела</a></li>';
                echo '</ul></div>';
            }
            ?>

        </div>

    </div>


</div>
<div class="catalog-item">
<!--    <div class="filters">-->
<!--        <div class="select">-->
<!--            <h5>ЦВЕТ</h5>-->
<!--            <select>-->
<!--                <option>Все</option>-->
<!--                <option>1</option>-->
<!--                <option>2</option>-->
<!--                <option>3</option>-->
<!--            </select>-->
<!--        </div>-->
<!--        <div class="select">-->
<!--            <h5>размер</h5>-->
<!--            <select>-->
<!--                <option>Все</option>-->
<!--                <option>1</option>-->
<!--                <option>2</option>-->
<!--                <option>3</option>-->
<!--            </select>-->
<!--        </div>-->
<!--        <div class="select">-->
<!--            <h5>сезон</h5>-->
<!--            <select>-->
<!--                <option>Все</option>-->
<!--                <option>1</option>-->
<!--                <option>2</option>-->
<!--                <option>3</option>-->
<!--            </select>-->
<!--        </div>-->
<!--        <div class="price">-->
<!--            <p>-->
<!--                <input type="text" id="amount1" style="border:0; color:#f6931f; font-weight:bold;">-->
<!--            </p>-->
<!---->
<!--            <div id="slider-range1"></div>-->
<!--        </div>-->
<!--    </div>-->

<div class="sort-goods-catalog">
    <p>Всего <?php echo $totalCount . ' ' . FormatHelper::plural($totalCount, 'товар', 'товара', 'товаров'); ?></p>

    <div class="sort">
        <span>Сортировать:</span>
        <?php
        echo CHtml::dropDownList(
            'order',
            Yii::app()->request->getQuery('order'),
            [
                'hits' => 'По популярности',
                'date' => 'По дате добавления',
                'price_down' => 'От дешевых к дорогим',
                'price_up' => 'От дорогих к дешевым'
            ],
            [
                'id' => 'catalog_order'
            ]
        );
        ?>
    </div>
    <!--        <button><i>x</i>Сбросить фильтры</button>-->
</div>

<div class="catalog-goods">
    <?php foreach ($dataProvider->getData() as $product) { ?>
        <div class="goods-var">
            <!--                <img src="/images/kofta.png" alt=""/>-->

            <a href="<?php echo $this->createUrl('catalog/product', ['id' => $product->id]) ?>"><img
                    class="goods-var-image" src="<?= Yii::app()->params['staticUrl'] ?>images/<?= $product['image'] ?>"
                    alt=""/></a>
            <a class='good-var-name'
               href="<?php echo $this->createUrl('catalog/product', ['id' => $product->id]) ?>"><?php echo $product->name . ' ' . $product->model; ?></a>

            <span><?= FormatHelper::markup($product->price) ?></span>
            <?php if ($product->old_price != 0) { ?>
                <h5><?= FormatHelper::markup($product->old_price) ?></h5>
            <?php } ?>
            <!---->
            <!--                <button class="m-dotted fixed-info quick-view" id="#example5"-->
            <!--                        onclick="$('#exampleModalmore-goods').arcticmodal()">Быстрый просмотр-->
            <!--                </button>-->
            <a href='<?php echo $this->createUrl('catalog/preview', ['id' => $product->id]) ?>'
               data-options='{"width":743, "height":535, "modal": true}' class='lightbox quick-view' rel="group1">Быстрый
                просмотр</a>

            <div class="choice">
                <?php if (!empty($product->product_options)) { ?>
                    <select class="product_size">
                        <?php foreach ($product->product_options as $option) { ?>
                            <option
                                value='<?= $option->products_options_values_id ?>'><?= $option->products_options_values_name ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
                <?php if (!Yii::app()->user->isGuest): ?>
                    <a class="in-basket addToCart">в корзину</a>
                <?php else: ?>
                    <a class="in-basket addToCart">в корзину</a>
<!--                    <a href="--><?php //echo $this->createUrl('site/login') ?><!--"-->
<!--                       data-options='{"width":900, "height":355, "modal": true}' class="in-basket lightbox" >в-->
<!--                        корзину</a>-->
                <?php endif; ?>
                <input type="hidden" class="product_id" value="<?= $product->id ?>"/>
            </div>
        </div>
    <?php } ?>
</div>

<?php
// todo: временное решение

$this->widget(
    'retail.widgets.LinkPager',
    [
        'pages' => $pages,
    ]
)

?>



<!--<div class="catalog-goods more">-->
<!--    <div class="goods-var">-->
<!--        <img src="/images/kofta.png" alt="" />-->
<!--        <a href="#">Кофта (75382936)</a>-->
<!--        <span>350р</span>-->
<!--        <h5>390р</h5>-->
<!--        <button class="quick-view">Быстрый просмотр</button>-->
<!--        <div class="choice">-->
<!--            <select>-->
<!--                <option>Размер</option>-->
<!--                <option>1</option>-->
<!--                <option>2</option>-->
<!--                <option>3</option>-->
<!--            </select>-->
<!--            <button class="in-basket">в корзину</button>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="goods-var">-->
<!--        <img src="/images/kofta.png" alt="" />-->
<!--        <a href="#">Кофта (75382936)</a>-->
<!--        <span>350р</span>-->
<!--        <h5>390р</h5>-->
<!--        <button class="quick-view">Быстрый просмотр</button>-->
<!--        <div class="choice">-->
<!--            <select>-->
<!--                <option>Размер</option>-->
<!--                <option>1</option>-->
<!--                <option>2</option>-->
<!--                <option>3</option>-->
<!--            </select>-->
<!--            <button class="in-basket">в корзину</button>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="goods-var">-->
<!--        <img src="/images/kofta.png" alt="" />-->
<!--        <a href="#">Кофта (75382936)</a>-->
<!--        <span>350р</span>-->
<!--        <h5>390р</h5>-->
<!--        <button class="quick-view">Быстрый просмотр</button>-->
<!--        <div class="choice">-->
<!--            <select>-->
<!--                <option>Размер</option>-->
<!--                <option>1</option>-->
<!--                <option>2</option>-->
<!--                <option>3</option>-->
<!--            </select>-->
<!--            <button class="in-basket">в корзину</button>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="goods-var">-->
<!--        <img src="/images/kofta.png" alt="" />-->
<!--        <a href="#">Кофта (75382936)</a>-->
<!--        <span>350р</span>-->
<!--        <h5>390р</h5>-->
<!--        <button class="quick-view">Быстрый просмотр</button>-->
<!--        <div class="choice">-->
<!--            <select>-->
<!--                <option>Размер</option>-->
<!--                <option>1</option>-->
<!--                <option>2</option>-->
<!--                <option>3</option>-->
<!--            </select>-->
<!--            <button class="in-basket">в корзину</button>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="goods-var">-->
<!--        <img src="/images/kofta.png" alt="" />-->
<!--        <a href="#">Кофта (75382936)</a>-->
<!--        <span>350р</span>-->
<!--        <h5>390р</h5>-->
<!--        <button class="quick-view">Быстрый просмотр</button>-->
<!--        <div class="choice">-->
<!--            <select>-->
<!--                <option>Размер</option>-->
<!--                <option>1</option>-->
<!--                <option>2</option>-->
<!--                <option>3</option>-->
<!--            </select>-->
<!--            <button class="in-basket">в корзину</button>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="goods-var">-->
<!--        <img src="/images/kofta.png" alt="" />-->
<!--        <a href="#">Кофта (75382936)</a>-->
<!--        <span>350р</span>-->
<!--        <h5>390р</h5>-->
<!--        <button class="m-dotted fixed-info quick-view" id="#example5" onclick="$('#exampleModalmore-goods').arcticmodal()">Быстрый просмотр</button>-->
<!--        <div class="choice">-->
<!--            <select>-->
<!--                <option>Размер</option>-->
<!--                <option>1</option>-->
<!--                <option>2</option>-->
<!--                <option>3</option>-->
<!--            </select>-->
<!--            <button class="in-basket">в корзину</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--<button class="any-goods">Показать еще</button>-->

</div>
</div>
</form>
