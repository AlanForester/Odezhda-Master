<?php

class RetailOrdersHelper {

    public static function getDataProvider($data = null) {
        $condition = [];
        $params = [];

        // фильтр по тексту
        if (!empty($data['text_search'])) {
            $condition[] = '(' . join(
                ' OR ',
                [
                    '[[customers_name]] LIKE :text',
                    '[[customers_company]] LIKE :text',
                    '[[customers_street_address]] LIKE :text',
                    '[[customers_suburb]] LIKE :text',
                    '[[customers_city]] LIKE :text',
                    '[[customers_postcode]] LIKE :text',
                    '[[customers_state]] LIKE :text',
                    '[[customers_country]] LIKE :text',
                    '[[customers_telephone]] LIKE :text',
                    '[[customers_email_address]] LIKE :text',
                    '[[delivery_name]] LIKE :text',
                    '[[delivery_middlename]] LIKE :text',
                    '[[delivery_lastname]] LIKE :text',
                    '[[delivery_company]] LIKE :text',
                    '[[delivery_street_address]] LIKE :text',
                    '[[delivery_suburb]] LIKE :text',
                    '[[delivery_city]] LIKE :text',
                    '[[delivery_postcode]] LIKE :text',
                    '[[delivery_state]] LIKE :text',
                    '[[delivery_country]] LIKE :text',
                    '[[billing_name]] LIKE :text',
                    '[[billing_company]] LIKE :text',
                    '[[billing_street_address]] LIKE :text',
                    '[[billing_suburb]] LIKE :text',
                    '[[billing_city]] LIKE :text',
                    '[[billing_postcode]] LIKE :text',
                    '[[billing_state]] LIKE :text',
                    '[[billing_country]] LIKE :text',
                    //'[[payment_method]] LIKE :text',
                    //'[[payment_info]] LIKE :text',
                    '[[customers_fax]] LIKE :text'
                ]
            ) . ')';

            $params[':text'] = '%' . $data['text_search'] . '%';
        }

        /*if (!empty($data['filter_groups'])) {
            $condition[] = '[[group_id]]=:group';
            $params[':group'] = $data['filter_groups'];
        }*/

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

        //$page_size = TbArray::getValue('page_size', $data, CPagination::DEFAULT_PAGE_SIZE);

        $criteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
            'order' => $order_field . ($order_direct ? : ''),
        ];

        // разрешаем перезаписать любые параметры критерии
        /*if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }*/

        return new CActiveDataProvider(
            'RetailOrders',
            [
                'criteria' => $criteria,
                'pagination' => ($data['page_size'] == 'all' ? false : ['pageSize' => $data['page_size']]),
            ]
        );
    }

}
