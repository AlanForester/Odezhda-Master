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
            <?php if(!Yii::app()->user->isGuest): ?>
                <button class="in-basket addToCart">в корзину</button>
            <?php else: ?>
                <button class="in-basket" onclick="$('#aLog').trigger('click');">в корзину</button>
            <?php endif; ?>
            <input type="hidden" class="product_id" value="<?=$product->id ?>"/>
        </div>
    </div>
    <?php }?>
