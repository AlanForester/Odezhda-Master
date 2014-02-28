<?php $count=isset($count) ? $count :0;
//todo что-то с этим решить
if(Yii::app()->user->id){
    $reg=true;
    $customer_id=Yii::app()->user->id;
    $products=[];
    if (!empty($customer_id)){
        $model = new CartModel();
        $product_ids=$model->getUserProducts($customer_id);
        if($product_ids){
            $catalogModel = new CatalogModel();
            foreach($product_ids as $id=>$count){
                if ($product = $catalogModel->productById($id)) {
                    $products[]=$product;
                }
            }
        }
    //    print_r($product_ids);exit;
    }
}else{
    $catalogModel = new CatalogModel();
    if(!empty($_SESSION['products'])){
        foreach($_SESSION['products'] as $value){
            if ($product = $catalogModel->productById($value['product_id'])) {
                $products[$value['product_id'].'_'.$value['params']][]=$product;
                $products[$value['product_id'].'_'.$value['params']][]=$value;
            }
        }
    }
}

?>

<div id="jqeasytrigger" class="bottom-panel">

    <a href="#" class="open" style="display: block;">
        <img src="../../../images/bottom-basket-icon.png" alt="" />
        <span class="col"><?php echo CartModel::countProducts();?></span>
    </a>
    <a href="#" class="close" style="display: none;">
        <img src="../../../images/bottom-basket-icon.png" alt="" />
        <p>корзина</p>
        <!-- Если корзина пустая -->
        <span class="null col"><?php echo(CartModel::countProducts());?></span>
<!--        <p class="sum">--><?php //echo(CartModel::countPrices());?><!--</p>-->
        <img src="../../../images/bottom-basket-arrow.png" alt="" class="bottom-basket-arrow" />
    </a>
</div>

