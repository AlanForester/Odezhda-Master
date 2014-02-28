<?php
/**
 * Created by PhpStorm.
 * User: Zimovid
 * Date: 26.02.14
 * Time: 15:20
 */

class OrdersHelper {
    public static function getModel() {
        return Orders::model();
    }
    public static function getDataProvider($data = null){
        $condition = [];
        $params = [];
        // поле и направление сортировки
        $order_direct = null;
        $order_field = '[[' . (!empty($data['order_field']) ? $data['order_field'] : 'id') . ']]';

        if (isset($data['order_direct'])) {
            switch ($data['order_direct']) {
                case 'up':
                    $order_direct = ' ASC';
                    break;
                case 'down':
                    $order_direct = ' DESC';
                    break;
            }
        }

        $page_size = TbArray::getValue('page_size', $data, CPagination::DEFAULT_PAGE_SIZE);

        $criteria = [
            'select' =>" *",
            'condition' => join(' AND ', $condition),
            'params' => $params,
            'order' => $order_field . ($order_direct ? : ''),
        ];

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }

//        return new CActiveDataProvider(
//            'Orders',
//            [
//                'criteria' => $criteria,
//                'pagination' => ($page_size == 'all' ? false : ['pageSize' => $page_size]),
//            ]
//        );
        $dataProvider=new CActiveDataProvider(
            'Orders',
            [
                'criteria' => $criteria,
                'pagination' => ($page_size == 'all' ? false : ['pageSize' => $page_size]),
            ]
        );

        foreach($dataProvider->getData() as $string){

                 $query = Yii::app()->db->createCommand()
                    ->select(array('ROUND (SUM(  `final_price` *  `products_quantity` ), 2) AS sum'))
                    ->from('orders_products')
                    ->where('orders_id=:id', array(':id'=>$string->id))
                    ->queryRow();

            $string->final_price=$query['sum'];
            //print_r($query);exit;
        }

        return $dataProvider;
    }
    public static function getOrder($id = null, $scenario = null) {
        $model = self::getModel();
        return ($id ? $model->findByPk($id) : new $model($scenario));
    }

    public static function getOrderWithInfo($id = null, $scenario = null) {
        $model = self::getModel();
        if($id)
            return $model->with('customer')->findByPk($id);
        else {
            $result = new $model($scenario);
            $result->customer = new Customer($scenario);
            return $result;
        }
    }
} 