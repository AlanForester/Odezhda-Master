<?php foreach($dayProducts as $product) { ?>
<div class="tovar-day">
    <p>товар дня</p>
    <img src="<?= Yii::app()->params['staticUrl'] ?>" alt="Товар дня">
    <a href="/catalog/product/<?php echo $product->id; ?>"><?php echo $product->name . ' (' . $product->model . ')'; ?></a>
    <span><?=FormatHelper::markup($product->price) ?></span>
    <h5><?=FormatHelper::markup($product->old_price) ?></h5>
</div>
<?php } ?>