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
                    'rel_description.customers_name' . ' LIKE :text',
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
            'order' => 'rel_description.'.$order_field . ($order_direct ? : '')
        ];

        $result = [];
        $searchField = 'customers_name';
        $criteria=array_merge($criteria,
            ['with'=>['rel_description'=>$relatedCriteria]],
            ['select'=>'*, (SELECT COUNT(*) FROM '.$this->tableName().' AS c WHERE (c.id = t.id)) AS childCount,
                (SELECT `'.$searchField.'` FROM '.$this->tableName().' AS d WHERE (d.id = t.id)) AS parentName
            '],
            ['alias'=>'t']);

        $criteria = new CDbCriteria($criteria);

        $list = $this->findAll($criteria);
        foreach ($list as $val) {
            $result[] = array_merge(ShopCategoriesLayer::fieldMapConvert($val->rel_description->getAttributes()), ShopCategoriesLayer::fieldMapConvert($val->getAttributes()),['childCount'=>$val->childCount, 'parentName'=>(!empty($val->parentName) ? $val->parentName : 'Корень')]);
        }

        return $result;

        //return $this->allCategories;

    }

}

?>
