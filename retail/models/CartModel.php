<?php

/**
 * Корзина
 */
class CartModel {
    private $tableName='retail_customer_cart';
    private $orderTables=['retail_orders','retail_orders_products','retail_orders_statuses'];
    private static  $tblName='retail_customer_cart';
    private static $sizeTable='products_options_values';
    /**
     * Метод для добавления или обновелния товара в корзине
     * @param $data - массив данных для добавления
     * @return bool результат добавления
     */
    public function addToCart($data){
        if(!empty($data['product_id'])){

        }
        return false;
    }

    public function addToSession($data){
        if(!empty($data['product_id'])){
            return ($this->hasProduct($data['customer_id'],$data['product_id'],$data['params']) ?
                $this->updateProduct($data['customer_id'],$data['product_id'],'plus',$data['params']) :
                $this->insertProduct($data)
            );
        }
        return false;
    }
    /**
     * Метод для проверки, есть ли у пользователя customer_id в корзине товар product_id
     * Используется для определения: вставить или обновить запись в бд
     * @param $customer_id пользователь
     * @param $product_id товар
     * @return bool
     */
    public function hasProduct($customer_id, $product_id, $params){
        $result = Yii::app()->db->createCommand()
            ->select('*')
            ->from($this->tableName)
            ->where('customer_id=:customer_id and product_id=:product_id and params=:params',
                array(':customer_id'=>$customer_id, ':product_id'=>$product_id,':params'=>$params))
            ->queryRow();
        return !empty($result) ? true : false;
    }

    /**
     * Если у пользователя есть в корзине товар, то изменяем поле count на 1
     * @param $customer_id пользователь
     * @param $product_id товар
     * @param $change как изменять(увеличивать или уменьшать)
     * по-умолчанию - увеличиваем
     */
    public function updateProduct($customer_id, $product_id, $change='plus',$params){
        $count= Yii::app()->db->createCommand()
            ->select('count')
            ->from($this->tableName)
            ->where('customer_id=:customer_id and product_id=:product_id and params=:params', array(':customer_id'=>$customer_id, ':product_id'=>$product_id, ':params'=>$params))
            ->queryRow()
            ['count'];
        switch ($change) {
            case 'plus':
                $count++;
                break;
            case 'minus':
                $count--;
                break;
        }
        return Yii::app()->db->createCommand()->update($this->tableName, array(
            'count'=> $count,
        ), 'customer_id=:customer_id and product_id=:product_id and params=:params', array(':customer_id'=>$customer_id, ':product_id'=>$product_id, ':params'=>$params));
    }

    /**
     * Если у пользователя в корзине товара нет - вставляем
     * @param $data - данные для добавления в таблицу
     */
    public function insertProduct($data){
        return Yii::app()->db->createCommand()
            ->insert($this->tableName, [
                'customer_id'=>$data['customer_id'],
                'product_id'=>$data['product_id'],
                'params'=>$data['params'],
                'added'=>$data['added'],
                'count'=>1
            ]);
    }

    /**
     * Метод для нахождения количества товаров в корзине текущего пользователя
     * @return int
     */
    public static function countProducts(){
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $count = Yii::app()->db->createCommand()
                ->select('SUM(count) AS c')
                ->from(self::$tblName)
                ->where('customer_id=:id', array(':id'=>$customer_id))
                ->queryRow()['c'];
        }
        return (isset($count) ? $count : 0);
    }

    /**
     * Метод для нахождения общей суммы товаров в корзине текущего пользователя
     * @return int
     */
    public static function countPrices(){
        $customer_id=Yii::app()->user->id;
        if (!empty($customer_id)){
            $cartModel = new CartModel();
            $product_ids=$cartModel->getUserProducts($customer_id);
            $sum = 0;
            if($product_ids){
                $catalogModel = new CatalogModel();
                foreach($product_ids as $id=>$items){
                    foreach($items as $value){
                        if ($product = $catalogModel->productById($id)) {
                            $sum+=$product->price*$value['count'];
                        }
                    }
                }
            }
        }
        return FormatHelper::markup($sum);
    }

    /**
     * Метод для нахождения общей суммы единицы товара в корзине текущего пользователя
     * @return int
     */
    public function countPriceOfProduct($product_id, $params){
        $customer_id=Yii::app()->user->id;
        $sum=0;
        if (!empty($customer_id)){
            $catalogModel = new CatalogModel();
            $count=$this->countItemsOfProduct($product_id, $params);
                if ($product = $catalogModel->productById($product_id)) {
                    $sum=$product->price*$count;
        }
        }
        return $sum;
    }

    /**
     * Метод для нахождения количества единиц одного товаров в корзине текущего пользователя
     * @param $product_id идентификатор товара
     * @return int
     */
    public function countItemsOfProduct($product_id, $params){
        $customer_id=Yii::app()->user->id;
//        $count=0;
        if (!empty($customer_id)){
            $count = Yii::app()->db->createCommand()
                ->select('count AS c')
                ->from($this->tableName)
                ->where('customer_id=:customer_id and product_id=:product_id and params=:params ', array(':customer_id'=>$customer_id, ':product_id'=>$product_id, ':params'=>$params))
                ->queryRow()['c'];
        }
        return $count;
    }

    /**
     * Метод нахождения товаров в корзине пользователя
     * если в корзине есть товары возвращает ассоциативный массив id_товара => [0] =>[размер, количество]
     * Пример
     *     [124163] => Array
                (
                [0] => Array
                (
                [params] => 103
                [count] => 3
                )

                [1] => Array
                (
                [params] => 106
                [count] => 1
                )
            )
     * если в корзине товаров нет - false
     * @param $customer_id
     * @return bool
     */
    public function getUserProducts($customer_id){
        $product_ids = Yii::app()->db->createCommand()
            ->select('product_id, count, params')
            ->from($this->tableName)
            ->where('customer_id=:id', array(':id'=>$customer_id))
            ->queryAll();
        if(!empty($product_ids)){
            foreach($product_ids as $val){
                  $ids[$val['product_id']][]=['params'=>$val['params'], 'count'=>$val['count']];

            }
            return $ids;
        }
        return false;
    }

    /**
     * Метод для удаления одного товара из корзины
     * @param $customer_id
     * @param $product_id
     */
    public function deleteProduct($customer_id, $product_id,$params){
        return Yii::app()->db->createCommand()
            ->delete($this->tableName, 'customer_id=:customer_id and product_id=:product_id and params=:params', array(':customer_id'=>$customer_id, ':product_id'=>$product_id, ':params'=>$params));
    }

    /**
     * Метод для удаления всех товаров из корзины
     * @param $customer_id
     */
    public function deleteAll($customer_id){
        return Yii::app()->db->createCommand()
            ->delete($this->tableName, 'customer_id=:customer_id', array(':customer_id'=>$customer_id));
    }

    /**
     * Метод для оформления заказа
     * удаляем данные из таблицы корзинки и перемещаем в таблицы заказов
     * @param $customer_id
     * @param $params параметры из формы подтверждения
     */
    public function makeOrder($customer_id, $params){
        $customerModel=new CustomerModel();
        $customer=$customerModel->getCustomer($customer_id);
        $customer->setAttributes(['phone'=>$params['phone']],false);
        if(!$customer->save(false)){
            return false;
        }

        $delivery=$params['pickup_method'];
        
        $products = Yii::app()->db->createCommand()
            ->select('*')
            ->from($this->tableName)
            ->where('customer_id=:id', array(':id'=>$customer_id))
            ->queryAll();

        if(!empty($products)){
            Yii::app()->db->createCommand()
                ->insert($this->orderTables[0], [
                    'customers_id'=>$customer_id,
                    'delivery_points_id'=>$delivery,
                ]);
            $order_id=Yii::app()->db->getLastInsertID();
            if ($order_id){
                foreach($products as $product){
                    Yii::app()->db->createCommand()
                        ->insert($this->orderTables[1], [
                            'retail_orders_id'=>$order_id,
                            'products_id'=>$product['product_id'],
                            'quantity'=>$product['count'],
                        ]);
                }
                return Yii::app()->db->createCommand()
                    ->delete($this->tableName, 'customer_id=:customer_id', array(':customer_id'=>$customer_id));

            }
        }
        return false;
    }

    public static function getSizeById($id){
        return Yii::app()->db->createCommand()
            ->select('products_options_values_name AS name')
            ->from(self::$sizeTable)
            ->where('products_options_values_id=:id', array(':id'=>$id))
            ->queryRow()['name'];
    }
}
