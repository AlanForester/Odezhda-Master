<?php

class ProductHelper {

    private static $errors = [];

    public static function getModel() {
        return ShopProduct::model();
    }

    /**
     * Модель точки доставки
     * @param int $id [опционально] id точки. если не указан, вернет массив пустых данных
     * @param string $scenario [опционально] сценарий модели
     * @return Product
     */
    public static function getId($id = null, $scenario = null) {
        $model = self::getModel();
        // todo: завернуть название модели
        return ($id ? $model->findByPk($id): new ShopProduct($scenario));
    }

    public static function getOldOptionsList(){
        $old_Products = Yii::app()->db->createCommand()
            ->select('products_options_values_id as id,products_options_values_name as name')
            ->from('products_options_values')
            ->queryAll();
        $oldProductsList=[];
        foreach($old_Products  as  $elem){
            $oldProductsList[$elem['id']]=$elem['name'];
        }

        return $oldProductsList;
    }

    public static function getDataProvider($data = null) {
        $condition = [];
        $params = [];

        // Фильтр по тексту
        if (!empty($data['text_search'])) {
            $condition[] = '(' . join(
                    ' OR ',
                    [
                        '[[name]] LIKE :text',
                        '[[model]] LIKE :text',
                        '[[id]] LIKE :text',
                    ]
                ) . ')';

            $params[':text'] = '%' . $data['text_search'] . '%';
        }

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

        $page_size = $data['order_direct']?$data['order_direct']:TbArray::getValue('page_size', $data, CPagination::DEFAULT_PAGE_SIZE);
//        $page_size = $data['order_direct'];
        $criteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
            'order' => $order_field . ($order_direct ? : ''),
        ];

  //       разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }



        $dataProvider=new CActiveDataProvider(
            'ShopProduct',
            [
                'criteria' => $criteria,
                'pagination' => ($page_size == 'all' ? false : ['pageSize' => $page_size]),
            ]
        );


        foreach($dataProvider->getData() as $string){
            $data='';
            foreach($string->categories_description_table as $key => $value){
                $data.=($key==0)?$value->category:', '.$value->category;

            }
            $string->categories_name_list=$data;
        }

//        foreach($dataProvider->getData() as $string){
//            $data='';
//            foreach($string->product_options as $key => $products_old){
//                $data.=($key==0)?$products_old->products_options_values_name:', '.$products_old->products_options_values_name;
//
//            }
//           $string->newSizeString=$data;
//        }

        return $dataProvider;
    }



    public static function getErrors($attributes = null) {
        return self::$errors;
    }

    /**
     * данные для валидации для внешнего использования
     */
    public static function rules() {
        return Product::model()->getRules();
//        $rules = array_merge(InfoPage::model()->getRules(),InfoPageDescription::model()->getRules());
//        foreach ($rules as &$r) {
//            $r[0] = join(',', array_map(function ($el) {
//                return self::getModel()->getFieldMapName(trim($el));
//            }, explode(',', $r[0])));
//        }
//        return $rules;
    }

    /**
     * Обновление значения параметра пункта доставки
     * @param array $data массив данных для изменяемому полю бд
     * @return bool
     */
    public static function updateField($data) {
        // реальное имя поля
        $field = TbArray::getValue('field', $data, false);
        $id = TbArray::getValue('id', $data, false);
        $value = TbArray::getValue('value', $data, false);


        if ($id && $field && $value) {

            if (!$item = self::getId($id)) {
                return false;
            }
            $item->setAttributes([$field=>$value],false);

            return $item->save(true,[$field]);
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
        $item = self::getId($id);
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
        $item = self::getId($id, 'add');
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