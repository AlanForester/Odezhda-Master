<?php

class ShopProductsHelper {

    //    private static $dataProvider;

    //    private static $errors = [];

    public static function getModel() {
        return ShopProduct::model();
    }

    public static function getDataProvider($data = null) {
        $condition = [];
        $params = [];


        if(!empty($data['category'])){
            $categories = Yii::app()->db->createCommand()
                ->select('categories_id,parent_id')
                ->from('categories')
                ->where('parent_id=:id',[':id'=>$data['category']])
                ->queryAll();
        }


        // фильтр по категории
        if (isset($data['category']) && empty($categories)){
            // todo: решить проблему с подстановкой имени связанной таблицы
            $condition [] = 'categories_description.categories_id =:category';
            $params[':category'] = $data['category'];
        }
        elseif(isset($data['category']) && !empty($categories)){

            foreach($categories as $category){
                $condition_params[] ='categories_description.categories_id ='.$category['categories_id'];
            }
           // $condition_params[] ='categories_description.categories_id ='.$data['category'];
            $condition[]= join(' OR ',$condition_params);
        }
/*     //Можно получать parent_id и понему делать запрос без перебора:
        if($data['category']!=0){
            $category = Yii::app()->db->createCommand()
                ->select('categories_id,parent_id')
                ->from('categories')
                ->where('categories_id=:id',[':id'=>$data['category']])
                ->queryRow();
        }

        if (isset($data['category']) && empty($category)){
            // todo: решить проблему с подстановкой имени связанной таблицы
            $condition [] = 'categories_description.categories_id =:category';
            $params[':category'] = $data['category'];
        }
        elseif(isset($data['category']) && !empty($category)){
                $condition[] ='categories_description.parent_id ='.$category['parent_id'];
        }
*/
        //Формирование критерии
        $criteria = ['condition' => join(' AND ', $condition),
                     'params' => $params];
        if(!empty($data['order'])){
            $criteria ['order'] = $data['order'];
        }
        if(!empty($data['limit'])){
            $criteria['limit'] = $data['limit'];
        }
        if(!empty($data['random'])){
            $criteria['order'] = new CDbExpression('RAND()');
        }

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }

        return new CActiveDataProvider(
            'ShopProduct',
            [

                'criteria' => $criteria,
                // todo: вынести в конфиг pageSize
                'pagination' => ['pageSize' => 12],
                //                'pagination' => ['pageSize' => 9, 'currentPage' => $data['page']],
            ]
        );
    }

    public static function getProduct($id = null, $scenario = null) {
        if ($id) {
            // todo: вынести код в АР
            if (!$page = self::getModel()->findByPk($id)) {
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
        return 'preview/w50_'.str_replace("/", "_", $image);
    }
    public static function pathToMidImg($image) {
        return 'preview/w240_h320_'.str_replace("/", "_", $image);
    }
    public static function pathToLargeImg($image) {
        return 'images/'.$image;
    }

    public static function previewListImg($product) {
        $prev_img=[];
        for($i=1;$i<=6;$i++){
            $img='products_image_sm_'.$i;
            if(!empty($product->{$img})){
                $prev_img[$i]=['small'=> ShopProductsHelper::pathToSmallImg($product->{$img}),
                                'large'=> ShopProductsHelper::pathToLargeImg($product->{$img})
                              ];
            }
        }
        return $prev_img;
    }

    //    public static function getErrors($attributes = null) {
    //        return self::$errors;
    //    }
}