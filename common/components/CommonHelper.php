<?php

class CommonHelper {

    public static function getDataProvider($data = null,$modelClass) {
        $condition = $params = [];

        // фильтр по тексту
        if (!empty($data['text_search']['value']) && !empty($data['text_search']['columns'])) {
            $columnConditions = [];

            if(is_array($data['text_search']['columns']))
                foreach($data['text_search']['columns'] as $column) {
                    $columnConditions[] = '[['.$column.']] LIKE :text_search';
                }
            
            $condition[] = '(' . join(
                ' OR ',
                $columnConditions
            ) . ')';

            $params[':text_search'] = '%' . $data['text_search']['value'] . '%';
        }

        //фильтры по значениям
        if(!empty($data['filters'])) {
            foreach($data['filters'] as $fieldName => $fieldValue) {
                if($fieldValue != '') {
                    $condition[] = '[['.$fieldName.']]=:'.$fieldName;
                    $params[':'.$fieldName] = $fieldValue;
                }
            }
        }

        $criteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
        ];

        // поле и направление сортировки
        if (!empty($data['order']['field']) && !empty($data['order']['direction'])) {
            $orderDirection = null;
            $orderField = '[[' . (!empty($data['order']['field']) ? $data['order']['field'] : 'id') . ']]';

            if (isset($data['order']['direction'])) {
                switch ($data['order']['direction']) {
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
                'pagination' => ($data['page_size'] == 'all' ? false : ['pageSize' => $data['page_size']]),
            ]
        );
    }

    public static function updateField($data = [], $modelClass) {
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