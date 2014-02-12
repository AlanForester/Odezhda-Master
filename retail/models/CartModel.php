<?php

/**
 * Корзина
 */
class CartModel {
    private $tableName='retail_customer_cart';
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
     * Если у пользователя есть в корзине товар, то увеличиваем поле count на 1
     * @param $customer_id пользователь
     * @param $product_id товар
     */
    public function updateProduct($customer_id, $product_id){
        $count= Yii::app()->db->createCommand()
            ->select('count')
            ->from($this->tableName)
            ->where('customer_id=:customer_id and product_id=:product_id', array(':customer_id'=>$customer_id, ':product_id'=>$product_id))
            ->queryRow()
            ['count'];
        return Yii::app()->db->createCommand()->update($this->tableName, array(
            'count'=> ++$count,
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
     * @param $id идентификатор пользователя
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
}
