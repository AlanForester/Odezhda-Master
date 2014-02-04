<?php foreach($this->list as $product){ ?>
   <div class="goods-var">
        <img src="/images/kofta.png" alt="" />
        <a href="#"><?php echo $product['name'].' '.$product['model']?></a>
        <span><?php echo round($product['price']).'р'; ?></span>
        <h5><?php echo round($product['old_price']).'р'; ?></h5>
        <button class="m-dotted fixed-info quick-view" id="#example5" onclick="$('#exampleModalmore-goods').arcticmodal()">Быстрый просмотр</button>
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
    <?php }?>
