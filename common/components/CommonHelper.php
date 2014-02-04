<?php

class CommonHelper {

    public static function getDataProvider($modelClass, $pageSize = 10, $filter = [], $order = [], $textSearch = []) {
        $condition = $params = [];

        // фильтр по тексту
        if (!empty($textSearch['value']) && !empty($textSearch['columns'])) {
            $columnConditions = [];

            if(is_array($textSearch['columns']))
                foreach($textSearch['columns'] as $column) {
                    $columnConditions[] = '[['.$column.']] LIKE :text_search';
                }
            
            $condition[] = '(' . join(
                ' OR ',
                $columnConditions
            ) . ')';

            $params[':text_search'] = '%' . $textSearch['value'] . '%';
        }

        if ($filter) {
            foreach($filter as $fieldName => $fieldValue) {
                $condition[] = '[['.$fieldName.']]=:'.$fieldName;
                $params[':'.$fieldName] = $fieldValue;
            }
        }
        /*if (!empty($data['filter_status'])) {
            $condition[] = '[[retail_orders_statuses_id]]=:status';
            $params[':status'] = $data['filter_status'];
        }

        if (!empty($data['filter_deliverypoint'])) {
            $condition[] = '[[delivery_points_id]]=:delivery_point';
            $params[':delivery_point'] = $data['filter_deliverypoint'];
        }*/


        $criteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
            //'order' => $orderField . ($orderDirection ? : ''),
        ];

        // поле и направление сортировки
        if (!empty($order['field']) && !empty($order['direction'])) {
            $orderDirection = null;
            $orderField = '[[' . (!empty($order['field']) ? $order['field'] : 'id') . ']]';

            if (isset($order['direction'])) {
                switch ($order['direction']) {
                    case 'up':
                        $orderDirection = ' ASC';
                        break;
                    case 'down':
                        $orderDirection = ' DESC';
                        break;
                }
            }
            $criteria['order'] = $orderField . ($orderDirection ? : '');
        }

        // разрешаем перезаписать любые параметры критерии
        /*if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }*/

        return new CActiveDataProvider(
            $modelClass,
            [
                'criteria' => $criteria,
                'pagination' => ($pageSize == 'all' ? false : ['pageSize' => $pageSize]),
            ]
        );
    }

    public static function updateField($modelClass, $data = []) {
        $field = TbArray::getValue('field', $data, false);
        $rowId = TbArray::getValue('id', $data, false);
        $value = TbArray::getValue('value', $data, false);

        if ($rowId && $field && $value) {
            if (!$model = $modelClass::model()->findByPk($rowId)) {
                return false;
            }
            $model->{$field} = $value;

            return $model->save(true, [$field]);
        }

        return false;
    }

}