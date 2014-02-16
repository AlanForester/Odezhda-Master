<script type="text/javascript">
    $(document).ready(function() {
        $('#jqeasypanel').jqEasyPanel({
            position: 'bottom'
        });
        $(".open").click(function(){
            $("#jqeasytrigger").animate({bottom:'246px'});
        });
        $(".close").click(function(){
            $("#jqeasytrigger").animate({bottom:'0px'});
        });
    });
</script>

<div id="jqeasytrigger" class="bottom">
    <a href="#" class="open" style="display: block;">
        <img src="images/bottom-basket-icon.png" alt="" />
        <p>корзина</p>
        <span>5</span>
        <p>2570р</p>
    </a>
    <a href="#" class="close" style="display: none;">
        <img src="images/bottom-basket-icon.png" alt="" />
        <p>корзина</p>
        <!-- Если корзина пустая -->
        <span class="null">5</span>
        <p>2570р</p>
        <img src="images/bottom-basket-arrow.png" alt="" class="bottom-basket-arrow" />
    </a>
</div>

<div id="jqeasypanel" class="bottom" style="height: 80px; display: none;">
    <p>В вашей корзине 4 товара</p>
    <button class="clear"><b>X</b>Очистить корзину</button>
    <p class="open-basket"><input type="checkbox"  /><span>Не открывать корзину при каждой покупке</span></p>

    <script type="text/javascript">

        jQuery(function($){

            $('.goods-slider ul#items').easyPaginate({
                step:4
            });

        });

    </script>
    <div class="goods-slider">
        <div id="container">


            <ul id="items">
                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>

                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>

                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>

                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>

                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>

                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>

                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>

                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>

                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>

                <li>
                    <p class="image"><a href="#"><img src="images/kofta.png" alt="Template preview" /></a>
                        <select class="goods-count">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </p>
                    <h3>Кофта</h3>
                    <span class="artikul">43534634</span>
                    <span class="price-g">1500р.</span>
                    <span class="price-b">3000р.</span>

                </li>


            </ul>

        </div>
    </div>

    <div class="all-price">
        <div id="jqeasytrigger" class="bottom">
            <a href="#" class="close">x</a>
        </div>
        <p class="title-price">Стоимость заказа</p>
        <span class="end-price">10 000р</span>
        <a href="#" class="zakaz">Оформить заказ</a>
    </div>
</div>