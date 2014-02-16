<?php

class RetailDeliveryHelper {

    private static $errors = [];

    public static function getModel() {
        return RetailDelivery::model();
    }

    /**
     * Модель точки доставки
     * @param int $id [опционально] id точки. если не указан, вернет массив пустых данных
     * @param string $scenario [опционально] сценарий модели
     * @return RetailDelivery
     */
    public static function getDelivery($id = null, $scenario = null) {
        $model = self::getModel();
        // todo: завернуть название модели
        return ($id ? $model->findByPk($id) : new RetailDelivery($scenario));
    }

    public static function getDataProvider($data = null) {
        $condition = [];
        $params = [];

        // фильтр по тексту
        if (!empty($data['text_search'])) {
            $condition[] = '(' . join(
                    ' OR ',
                    [
                        '[[name]] LIKE :text',
                        '[[id]] LIKE :text',
                    ]
                ) . ')';

            $params[':text'] = '%' . $data['text_search'] . '%';
        }

        // поле и направление сортировки
        $order_direct = null;
        $order_field = '[[' . (!empty($data['order_field']) ? $data['order_field'] : 'name') . ']]';

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

        $relatedCriteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
            'order' => $order_field . ($order_direct ? : ''),
        ];
        $criteria=[
//            'with'=>['page_description'=>$relatedCriteria]
        ];

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }

        return new CActiveDataProvider(
            'RetailDelivery',
            [
                'criteria' => $criteria,
                'pagination' => ($page_size == 'all' ? false : ['pageSize' => $page_size]),
            ]
        );
    }

    public static function getErrors($attributes = null) {
        return self::$errors;
    }

    /**
     * данные для валидации для внешнего использования
     */
    public static function rules() {
        return RetailDelivery::model()->getRules();
//        $rules = array_merge(InfoPage::model()->getRules(),InfoPageDescription::model()->getRules());
//        foreach ($rules as &$r) {
//            $r[0] = join(',', array_map(function ($el) {
//                return self::getModel()->getFieldMapName(trim($el));
//            }, explode(',', $r[0])));
//        }
//        return $rules;
    }

    /**
     * Обновление значения параметра пользователя
     * @param array $data массив данных для изменяемому полю бд. ключи: pk - первичные ключи(в том числе и связанных таблиц),field - название изменяемого поля,
     * value - новое значение поля
     * @return bool
     */
    public static function updateField($data) {
        // реальное имя поля
        $field = TbArray::getValue('field', $data, false); //self::getFieldName($data['field'], false);
        $pk = (TbArray::getValue('pk', $data, false)); //(!empty($data['id']) ? $data['id'] : false);
        if ($pk){
            $id=$pk[RetailDelivery::model()->getFieldMapName('id',false)];
        }
        $value = TbArray::getValue('value', $data, false); //(!empty($data['newValue']) ? $data['newValue'] : false);
        // все все данные верны, сохраняем
        if ($id && $field && $value) {
            if (!$item = self::getDelivery($id)) {
                return false;
            }
            $dataToSave=[
                $field=>$value,
                //RetailDelivery::model()->getFieldMapName('modified',false)=>new CDbExpression('NOW()')
            ];
            $item->setAttributes($dataToSave,false);
            return $item->save(true);
        }

        return false;
    }

    /**
     * Удаление информационной страницы по id
     * (удаляет основную и все связанные таблицы(afterDelete))
     * @param $id - id информационной страницы
     * @return bool успешность удаления
     */
    public static function delete($id) {
        $item = self::getDelivery($id);
        if ($item) {
            return $item->delete();
        }
        return false;
    }

    /**
     * Создание или обновление пользователя на основе данных из формы
     * @param array $data исходные данные из формы
     * @return bool|array массив данных пользователя или false
     */
    public static function save($data) {
        $id = TbArray::getValue('id', $data);

        // модель пользователя
        $item = self::getDelivery($id, 'add');
        if (!$item) {
            return false;
        }

        if ($id) {
            // обновление пользователя

        } else {
            // если есть пустой id в параметрах - удаляем
            if (array_key_exists('id', $data)) {
                unset($data['id']);
            }
//            $data['added'] = new CDbExpression('NOW()');
        }
//        $data['modified'] = new CDbExpression('NOW()');

        // задаем значения, получаем реальные имена полей
        $item->setAttributes($data, false);

        if (!$item->save(true)) {
            self::$errors = $item->getErrors();
            return false;
        }

        return $item;

    }

}