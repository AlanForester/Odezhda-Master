<?php
Yii::app()->clientScript->registerPackage('index');
?>

<div class="wrapper">
<div class="main-tabs">
    <div id="tabs">
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
    </div>
</div>
</div>