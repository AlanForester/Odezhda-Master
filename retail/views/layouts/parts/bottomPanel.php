<?php $count=isset($count) ? $count :0;?>
    <div class="bottom-panel-wrapper">
        <div class="see-goods">
            <a href="<?php echo $this->createUrl('cart/show')?>"
               data-options='{"width":900, "height":480, "modal": true}'
               class="lightbox" id="openCart">
                В корзине
            </a>
            <h5><?php echo($count);?></h5>
        </div>
    </div>
