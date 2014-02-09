<?php
Yii::app()->clientScript->registerPackage('catalog');
Yii::app()->getClientScript()->registerScriptFile('/js/bootstrap-paginator.min.js');
Yii::app()->getClientScript()->registerCssFile('/css/bootstrap.pagination.css');
// todo: почистить код
?>
<script>
    $(document).ready(function () {
        $("#accordion").accordion({
            heightStyle: "content",
            active: 3
        });

        var options = {
            currentPage:
            <?php
                if(Yii::app()->request->getQuery('page')){
                    echo Yii::app()->request->getQuery('page');}
                else{
                     echo 1;
                }?>,
            totalPages:<?php echo $this->DataProvider->getTotalItemCount(); ?>/9,
            pageUrl: function (type, page, current) {
                return location.pathname + '?page=' + page;
            }
        }

        $('#example').bootstrapPaginator(options);
    });

</script>
<!--            active: --><?php //echo $this->currentCategoryNumber; ?>
<div class="catalog-title">
    <div class="title">
        <!--        <p>--><?php //echo $this->currentCategory['categories_name'];?><!--</p>-->
    </div>
</div>

<div class="wrapper">
<div class="left-option">
    <div class="accord-item">
        <div id="accordion">

            <?php foreach ($this->categories as $category) { ?>
                <?php if (!empty($category['children'])) { ?> <h3><?php echo $category['name']; ?></h3> <?php } ?>

                <?php if (!empty($category['children'])) { ?>
                    <div>
                        <ul>
                            <?php foreach ($category['children'] as $child) { ?>
                                <li>
                                    <a href="/catalog/list/<?php echo $child['id']; ?>"><?php echo $child['name']; ?></a>
                                </li>

                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

            <?php } ?>


        </div>

    </div>

    <div class="item-options">
        <div class="title">
            <h6>ЦВЕТ</h6>
            <button>сбросить х</button>
        </div>
        <div class="color">
            <div>
                <a href="#" class="grey" title="grey"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="violet" title="violet"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="green" title="green"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="magent" title="magent"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="yellow" title="yellow"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="blue" title="blue"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="white" title="white"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="black" title="black"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="l-magent" title="l-magent"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="red" title="red"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="orange" title="orange"></a>
                <input type="checkbox"/>
            </div>
            <div>
                <a href="#" class="purple" title="purple"></a>
                <input type="checkbox"/>
            </div>
        </div>
        <div class="title">
            <h6>размер</h6>
            <button>сбросить х</button>
        </div>
        <div class="razmer">
            <div>
                <input type="checkbox"/><span>XXXL</span>
            </div>
            <div>
                <input type="checkbox"/><span>XXL</span>
            </div>
            <div>
                <input type="checkbox"/><span>XL</span>
            </div>
            <div>
                <input type="checkbox"/><span>M</span>
            </div>
            <div>
                <input type="checkbox"/><span>S</span>
            </div>
            <div>
                <input type="checkbox"/><span>40</span>
            </div>
            <div>
                <input type="checkbox"/><span>42</span>
            </div>
            <div>
                <input type="checkbox"/><span>44</span>
            </div>
            <div>
                <input type="checkbox"/><span>46</span>
            </div>
            <div>
                <input type="checkbox"/><span>48</span>
            </div>
            <div>
                <input type="checkbox"/><span>50</span>
            </div>
            <div>
                <input type="checkbox"/><span>52</span>
            </div>
        </div>
        <div class="title">
            <h6>цена</h6>
        </div>
        <div class="price">
            <p>
                <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
            </p>

            <div id="slider-range"></div>
        </div>
    </div>

</div>
<div class="catalog-item">
    <!--<div class="filters">-->
    <!--    <div class="select">-->
    <!--        <h5>ЦВЕТ</h5>-->
    <!--        <select>-->
    <!--            <option>Все</option>-->
    <!--            <option>1</option>-->
    <!--            <option>2</option>-->
    <!--            <option>3</option>-->
    <!--        </select>-->
    <!--    </div>-->
    <!--    <div class="select">-->
    <!--        <h5>размер</h5>-->
    <!--        <select>-->
    <!--            <option>Все</option>-->
    <!--            <option>1</option>-->
    <!--            <option>2</option>-->
    <!--            <option>3</option>-->
    <!--        </select>-->
    <!--    </div>-->
    <!--    <div class="select">-->
    <!--        <h5>сезон</h5>-->
    <!--        <select>-->
    <!--            <option>Все</option>-->
    <!--            <option>1</option>-->
    <!--            <option>2</option>-->
    <!--            <option>3</option>-->
    <!--        </select>-->
    <!--    </div>-->
    <!--    <div class="price">-->
    <!--        <p>-->
    <!--            <input type="text" id="amount1" style="border:0; color:#f6931f; font-weight:bold;">-->
    <!--        </p>-->
    <!--        <div id="slider-range1"></div>-->
    <!--    </div>-->
    <!--</div>-->
    <!---->
    <?php
    // todo: кого оно тут делает?!
    function pluralForm($n, $form1, $form2, $form5) {
        $n = abs($n) % 100;
        $n1 = $n % 10;
        if ($n > 10 && $n < 20) return $form5;
        if ($n1 > 1 && $n1 < 5) return $form2;
        if ($n1 == 1) return $form1;
        return $form5;
    }
    ?>
    <div class="sort-goods-catalog">
        <p>
            Всего <?php echo $this->DataProvider->getTotalItemCount() . ' ' . pluralForm($this->DataProvider->getTotalItemCount(), 'товар', 'товара', 'товаров'); ?></p>

        <div class="sort">
            <span>Сортировать по:</span>
            <select>
                <option>По популярности</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>
        <button><i>x</i>Сбросить фильтры</button>
    </div>


    <div class="catalog-goods">
        <?php foreach ($this->DataProvider->getData() as $product) { ?>

            <div class="goods-var">
<!--                <img src="/images/kofta.png" alt=""/>-->
                <img src="http://old.om.codetek.ru//images/<?=$product->image?>" alt=""/>
                <a href="/catalog/product/<?php echo $product->id; ?>"><?php echo $product->name . ' ' . $product->model;; ?></a>
                <span><?php echo round($product->price) . 'р.'; ?></span>
                <?php if ($product->old_price != 0) { ?>
                    <h5><?php echo round($product->old_price) . 'р.'; ?></h5>
                <?php } ?>
                <button class="m-dotted fixed-info quick-view" id="#example5"
                        onclick="$('#exampleModalmore-goods').arcticmodal()">
                    Быстрый просмотр
                </button>
                <div class="choice">
                    <select>
                        <option>Размер</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                    <button class="in-basket">в корзину</button>
                </div>
            </div>
        <?php } ?>

    </div>
    <div id="example"></div>
    <div class="catalog-goods more">
        <div class="goods-var">
            <img src="/images/kofta.png" alt=""/>
            <a href="#">Кофта (75382936)</a>
            <span>350р</span>
            <h5>390р</h5>
            <button class="quick-view">Быстрый просмотр</button>
            <div class="choice">
                <select>
                    <option>Размер</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <button class="in-basket">в корзину</button>
            </div>
        </div>
        <div class="goods-var">
            <img src="/images/kofta.png" alt=""/>
            <a href="#">Кофта (75382936)</a>
            <span>350р</span>
            <h5>390р</h5>
            <button class="quick-view">Быстрый просмотр</button>
            <div class="choice">
                <select>
                    <option>Размер</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <button class="in-basket">в корзину</button>
            </div>
        </div>
        <div class="goods-var">
            <img src="/images/kofta.png" alt=""/>
            <a href="#">Кофта (75382936)</a>
            <span>350р</span>
            <h5>390р</h5>
            <button class="quick-view">Быстрый просмотр</button>
            <div class="choice">
                <select>
                    <option>Размер</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <button class="in-basket">в корзину</button>
            </div>
        </div>
        <div class="goods-var">
            <img src="/images/kofta.png" alt=""/>
            <a href="#">Кофта (75382936)</a>
            <span>350р</span>
            <h5>390р</h5>
            <button class="quick-view">Быстрый просмотр</button>
            <div class="choice">
                <select>
                    <option>Размер</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <button class="in-basket">в корзину</button>
            </div>
        </div>
        <div class="goods-var">
            <img src="/images/kofta.png" alt=""/>
            <a href="#">Кофта (75382936)</a>
            <span>350р</span>
            <h5>390р</h5>
            <button class="quick-view">Быстрый просмотр</button>
            <div class="choice">
                <select>
                    <option>Размер</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <button class="in-basket">в корзину</button>
            </div>
        </div>
        <div class="goods-var">
            <img src="/images/kofta.png" alt=""/>
            <a href="#">Кофта (75382936)</a>
            <span>350р</span>
            <h5>390р</h5>
            <button class="m-dotted fixed-info quick-view" id="#example5"
                    onclick="$('#exampleModalmore-goods').arcticmodal()">Быстрый просмотр
            </button>
            <div class="choice">
                <select>
                    <option>Размер</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <button class="in-basket">в корзину</button>
            </div>
        </div>
    </div>

    <!--<button class="any-goods">Показать еще</button>-->

</div>
</div>