<?php

class ShopProductsHelper {

    //    private static $dataProvider;

    //    private static $errors = [];
    private static $exceptedIds = [327,1435,1354,1333,590];

    public static function getModel() {
        return ShopProduct::model();
    }

    public static function getDataProvider($data = null,$pageSize) {
        $condition = [];
        $params = [];
        // Поиск тестового значения
        if (!empty($data['text_search'])) {
            $condition_params[] = '[[name]]  LIKE :text_search';
            $condition_params[] = 't.[[model]]  LIKE :text_search';
            $condition_params[] = '[[description]]  LIKE :text_search';
            $condition[] = '( ' . join(' OR ', $condition_params) . ' )';
            $params[':text_search'] = '%' . $data['text_search'] . '%';
        }

        // Родительские категории
        if (!empty($data['category'])) {
            $categories = Yii::app()->db->createCommand()
                                        ->select('categories_id,parent_id')
                                        ->from('categories')
                                        ->where('parent_id=:id', [':id' => $data['category']])
                                        ->queryAll();
        }

        // Фильтрация по категориям
        if (isset($data['category']) && empty($categories)) {
            // todo: решить проблему с подстановкой имени связанной таблицы
            $condition [] = 'categories_description_table.categories_id =:category';
            $params[':category'] = $data['category'];
        } elseif (isset($data['category']) && !empty($categories)) {

            foreach ($categories as $category) {
                $condition_params[] = 'categories_description_table.categories_id =' . $category['categories_id'];
            }
            $condition_params[] ='categories_description_table.categories_id ='.$data['category'];
            $condition[] = '( ' . join(' OR ', $condition_params) . ' )';
        }

        $not_in_child_ids = Yii::app()->db->createCommand()
            ->select('categories_id AS id')
            ->from('categories')
            ->where(['in', 'parent_id', self::$exceptedIds])
            //->where(self::getFieldName('parent_id',false).'=0 and ',['not in', self::getFieldName('id',false), $excepted_ids])
            ->queryALL();
        foreach($not_in_child_ids as $k=>$v){
            self::$exceptedIds[]=$v['id'];
        }

        // добавляем в условие ids категорий, которые не надо выводить
        $notInCondition='categories_description_table.categories_id  NOT IN (';
        foreach (self::$exceptedIds as $i=>$id){
            $notInCondition.=$id;
            if ($i!=count(self::$exceptedIds)-1){
                $notInCondition.=",";
            }
        }
        $notInCondition.=')';
        $condition [] = $notInCondition;

        $criteria = [];
        //Фильтрация по размерам
        if (!empty($data['filter']['size'])){
            foreach ($data['filter']['size'] as $size) {
                $sizes[]='products_new_option_values.value ="'.$size.'"';
            }
            $sizes_params='( ' . join(' OR ', $sizes) . ' )';
            //получить все размеры
            $dataOptions = Yii::app()->db->createCommand("SELECT GROUP_CONCAT( pr_opt.products_options_values_id ) group_data
                                     FROM  `products_options_values` AS pr_opt
                                     LEFT JOIN products_to_new_options ON products_to_new_options.products_options_values_id = pr_opt.products_options_values_id
                                     LEFT JOIN products_new_option_values ON products_new_option_values.products_new_value_id = products_to_new_options.products_new_value_id
                                     WHERE ".$sizes_params." ")->queryRow();
            if(!empty($dataOptions)){
                if(empty($dataOptions['group_data'])){$dataOptions['group_data']=0;}
                $condition[]="
                    (
                    SELECT GROUP_CONCAT( options_values_id )
                    FROM products_attributes AS attr
                    WHERE t.products_id = attr.products_id
                    ) IN (".$dataOptions['group_data'].")";
            }
        }

        //Формирование критерии
        if (!empty($condition)) {
            $criteria['condition'] = join(' AND ', $condition);
        }
        if (!empty($params)) {
            $criteria['params'] = $params;
        }
        if (!empty($data['limit'])) {
            $criteria['limit'] = $data['limit'];
        }

        // Максимальная и минимальная цена в выборке
        $criteria_data = new CDbCriteria($criteria);
        $criteria_data->select = 'MAX([[price]]) as max_price,MIN([[price]]) as min_price';
        $priceLimit = self::getModel()->find($criteria_data);

        if (!empty($data['order'])) {
            $criteria ['order'] = $data['order'];
        }else{
            $criteria ['order']='';
        }

        if (!empty($data['random'])) {
            $criteria['order'] = new CDbExpression('RAND()');
        }

        // Фильтр по цене
        if (!empty($data['min_price']) && !empty($data['max_price'])) {
            $condition[] = 't.[[price]]>=:min_price';
            $condition[] = 't.[[price]]<=:max_price';
            $params[':min_price'] = $data['min_price'];
            $params[':max_price'] = $data['max_price'];
        }
        else{
            $condition[]='t.[[price]]<>0.0000';
        }

        // Повторное формирование критерии
        $criteria = [
            'condition' => join(' AND ', $condition),
            'params' => $params,
            'order' => $criteria['order']
        ];

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }
//        print_r($criteria);exit;

        $dataProvider = new CActiveDataProvider(
            'ShopProduct',
            [
                'criteria' => $criteria,
                'pagination' => ['pageSize' => $pageSize],
            ]
        );


        return [
                    'dataProvider' => $dataProvider,
                    'priceLimit' => $priceLimit
               ];
    }

    public static function dayProduct($category) {
        $criteria = [
            'condition' => 'category_to_product.categories_id=' . $category,
            'limit' => 1,
            'order' => new CDbExpression('RAND()')
        ];


        $priceLimit = self::getModel()->find($criteria);

        return $priceLimit;
    }

    public static function widgetDayProducts($category) {
        $criteria = [
            'condition' => 'category_to_product.categories_id=' . $category,
            'limit' => 4,
            'order' => new CDbExpression('RAND()')
        ];

        $dayProducts = self::getModel()->findAll($criteria);

        return $dayProducts;
    }

    public static function getProduct($id = null, $scenario = null) {
        if ($id) {
            // todo: вынести код в АР
            if (!$page = self::getModel()
                             ->findByPk($id)
            ) {
                return false;
            }
            $relations = $page->relations();
            if (!empty($relations)) {
                foreach ($relations as $r_name => $r_value) {
                    if (empty ($page->{$r_name})) {
                        $r_class = $r_value[1];
                        $page->{$r_name} = new $r_class();
                    }
                }
            }
        } else {
            $page = new ShopProduct($scenario);
            $relations = $page->relations();
            if (!empty($relations)) {
                foreach ($relations as $r_name => $r_value) {
                    $page->{$r_name} = new $r_value[1];
                }
            }
        }

        return $page;
    }

    public static function pathToSmallImg($image) {
        return 'preview/w50_' . str_replace("/", "_", $image);
    }

    public static function pathToMidImg($image) {
        return 'preview/w240_h320_' . str_replace("/", "_", $image);
    }

    public static function pathToLargeImg($image) {
        return 'images/' . $image;
    }

    public static function previewListImg($product) {
        $prev_img = [];
        for ($i = 1; $i <= 6; $i++) {
            $img = 'products_image_sm_' . $i;
            if (!empty($product->{$img})) {
                $prev_img[$i] = ['small' => ShopProductsHelper::pathToSmallImg($product->{$img}),
                                 'large' => ShopProductsHelper::pathToLargeImg($product->{$img})
                ];
            }
        }

        return $prev_img;
    }

    //    public static function getErrors($attributes = null) {
    //        return self::$errors;
    //    }
}