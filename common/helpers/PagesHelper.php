<?php

class ShopCategoriesLayer {

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

}