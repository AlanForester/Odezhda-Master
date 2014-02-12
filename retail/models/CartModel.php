<?php

/**
 * Корзина
 */
class CartModel {
    private $tableName='retail_customer_cart';
    /**
     * Метод для добавления товара в корзину
     * @param $data - массив данных для добавления
     * @return bool результат добавления
     */
    public function addToCart($data){
        if(!empty($data['product_id'])){
            $result = Yii::app()->db->createCommand()
                ->insert($this->tableName, [
                    'customer_id'=>$data['customer_id'],
                    'product_id'=>$data['product_id'],
                    'params'=>$data['params'],
                    'added'=>$data['added'],
                    'count'=>1
            ]);
            return $result;
        }
        return false;
    }

    /**
     * Метод для нахождения количества товаров в корзине текущего пользователя
     * @param $id идентификатор пользователя
     * @return int
     */
    public function countProducts($id){
        $count = Yii::app()->db->createCommand()
            ->select('SUM(count) AS c')
            ->from($this->tableName)
            ->where('customer_id=:id', array(':id'=>$id))
            ->queryRow();
        return (!empty($count['c']) ? $count['c'] : 0);
    }
}
