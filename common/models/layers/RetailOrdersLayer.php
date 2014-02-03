<?php

class RetailOrdersLayer extends RetailOrders {

    public function getList($id_list,$data=null) {
        $condition = [];
        $params = [];

        $relatedCondition= [];
        $relatedParams = [];

        // фильтр по тексту
        if (!empty($data['text_search'])) {
            $relatedCondition[] = '(' . join(
                ' OR ',
                [
                    'retail_orders.'.ShopCategoriesLayer::getFieldName('name', false) . ' LIKE :text',
                ]
            ) . ')';

            $relatedParams[':text'] = '%' . $data['text_search'] . '%';
        }

        // поле и направление сортировки
        $order_direct = null;
        $order_field = !empty($data['order_field']) ? $data['order_field'] : 'id';

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
        $criteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
        ];

        $relatedCriteria = [
            'condition' => join(' AND ', $relatedCondition),
            'params' => $relatedParams,
            'order' => 'retail_orders.'.$order_field . ($order_direct ? : '')
        ];


        //$rows = RetailOrders::getList($criteria,$relatedCriteria,$buildTree);

        return $rows;

    }

}

?>
