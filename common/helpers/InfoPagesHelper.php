<?php

class InfoPagesHelper {

    private static $dataProvider;

    private static $errors = [];

    public static function getModel() {
        return InfoPage::model();
    }

    /**
     * Модель информационной страницы
     * @param int $id [опционально] id страницы. если не указан, вернет массив пустых данных
     * @param string $scenario [опционально] сценарий страницы
     * @return InfoPage
     */
    public static function getPage($id = null, $scenario = null) {
        if ($id){
            $page = self::getModel()->findByPk($id);
            $relations=$page->relations();
            if (!empty($relations)){
                foreach($relations as $r_name => $r_value){
                    if (empty ($page->{$r_name})){
                        $r_class = $r_value[1];
                        $page->{$r_name} = new $r_class();
                    }
                }
            }
        } else {
            $page = new InfoPage($scenario);
            $relations=$page->relations();
            if (!empty($relations)){
                foreach($relations as $r_name => $r_value){
                    $r_class = $r_value[1];
                    $page->{$r_name} = new $r_class();
                }
            }
        }
        return $page;
    }

    public static function getDataProvider($data = null) {
        $condition = ['language_id=:language_id'];
        $params = [':language_id'=>1];

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
            'with'=>['page_description'=>$relatedCriteria]
        ];

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }

        return new CActiveDataProvider(
            'InfoPage',
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
        $rules = array_merge(InfoPage::model()->getRules(),InfoPageDescription::model()->getRules());
        foreach ($rules as &$r) {
            $r[0] = join(',', array_map(function ($el) {
                return self::getModel()->getFieldMapName(trim($el));
            }, explode(',', $r[0])));
        }
        return $rules;
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
            $id=$pk[InfoPage::model()->getFieldMapName('id',false)];
        }
        $value = TbArray::getValue('value', $data, false); //(!empty($data['newValue']) ? $data['newValue'] : false);
        // все все данные верны, сохраняем
        if ($id && $field && $value) {
            if (!$page = self::getPage($id)) {
                return false;
            }
            $dataToSave=[
                $field=>$value,
                InfoPage::model()->getFieldMapName('modified',false)=>new CDbExpression('NOW()')
            ];
            $page->setAttributes($dataToSave,false);
            return $page->withRelated->save(true, ['page_description']);
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

        $page = self::getPage($id);
        if ($page) {
            return $page->delete();
        }

        return false;
    }

}