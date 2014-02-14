<?php

/**
 * Корзина
 */
class CartModel {
    private $tableName='retail_customer_cart';
    private $orderTables=['retail_orders','retail_orders_products','retail_orders_statuses'];
    private static  $tblName='retail_customer_cart';
    /**
     * Метод для добавления или обновелния товара в корзине
     * @param $data - массив данных для добавления
     * @return bool результат добавления
     */
    public function addToCart($data){
        if(!empty($data['product_id'])){
            return ($this->hasProduct($data['customer_id'],$data['product_id']) ?
                $this->updateProduct($data['customer_id'],$data['product_id']) :
                $this->insertProduct($data)
            );
//            if($this->hasProduct($data['customer_id'],$data['product_id'])){
//                $this->updateProduct($data['customer_id'],$data['product_id']);
//            } else {
//                $this->insertProduct($data);
//            }
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
    public function hasProduct($customer_id, $product_id){
        $result = Yii::app()->db->createCommand()
            ->select('*')
            ->from($this->tableName)
            ->where('customer_id=:customer_id and product_id=:product_id', array(':customer_id'=>$customer_id, ':product_id'=>$product_id))
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
    public function updateProduct($customer_id, $product_id, $change='plus'){
        $count= Yii::app()->db->createCommand()
            ->select('count')
            ->from($this->tableName)
            ->where('customer_id=:customer_id and product_id=:product_id', array(':customer_id'=>$customer_id, ':product_id'=>$product_id))
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
        ), 'customer_id=:customer_id and product_id=:product_id', array(':customer_id'=>$customer_id, ':product_id'=>$product_id));
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
//        $count=0;
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
     * Метод для нахождения количества единиц одного товаров в корзине текущего пользователя
     * @param $product_id идентификатор товара
     * @return int
     */
    public function countItemsOfProduct($product_id){
        $customer_id=Yii::app()->user->id;
//        $count=0;
        if (!empty($customer_id)){
            $count = Yii::app()->db->createCommand()
                ->select('count AS c')
                ->from($this->tableName)
                ->where('customer_id=:customer_id and product_id=:product_id', array(':customer_id'=>$customer_id, ':product_id'=>$product_id))
                ->queryRow()['c'];
        }
        return $count;
    }

    /**
     * Метод нахождения товаров в корзине пользователя
     * если в корзине есть товары возвращает ассоциативный массив id_товара => количество
     * если в корзине товаров нет - false
     * @param $customer_id
     * @return bool
     */
    public function getUserProducts($customer_id){
        $product_ids = Yii::app()->db->createCommand()
            ->select('product_id, count')
            ->from($this->tableName)
            ->where('customer_id=:id', array(':id'=>$customer_id))
            ->queryAll();
        if(!empty($product_ids)){
            foreach($product_ids as $val){
                $ids[$val['product_id']]=$val['count'];
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
    public function deleteProduct($customer_id, $product_id){
        return Yii::app()->db->createCommand()
            ->delete($this->tableName, 'customer_id=:customer_id and product_id=:product_id', array(':customer_id'=>$customer_id, ':product_id'=>$product_id));
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
     */
    public function makeOrder($customer_id){
        $products = Yii::app()->db->createCommand()
            ->select('*')
            ->from($this->tableName)
            ->where('customer_id=:id', array(':id'=>$customer_id))
            ->queryAll();
        if(!empty($products)){
            Yii::app()->db->createCommand()
                ->insert($this->orderTables[0], [
                    'customers_id'=>$customer_id,
                ]);
            $order_id=Yii::app()->db->getLastInsertID();
            if ($order_id){
                foreach($products as $product){
                    Yii::app()->db->createCommand()
                        ->insert($this->orderTables[1], [
                            'retail_orders_id'=>$order_id,
                            'products_id'=>$product['product_id'],
                            'products_quantity'=>$product['count'],
                        ]);
                }
                return Yii::app()->db->createCommand()
                    ->delete($this->tableName, 'customer_id=:customer_id', array(':customer_id'=>$customer_id));

            }
        }
        return false;
    }
}
