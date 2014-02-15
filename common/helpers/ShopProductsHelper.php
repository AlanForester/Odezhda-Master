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



        if(!empty($data['text_search'])){
            $condition_params[]='[[name]]  LIKE :text_search';
            $condition_params[]='t.[[model]]  LIKE :text_search';
            $condition_params[]='[[description]]  LIKE :text_search';
            $condition[]= '( '.join(' OR ',$condition_params).' )';
            $params[':text_search'] = '%'.$data['text_search'].'%';
        }

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
            $condition[]= '( '.join(' OR ',$condition_params).' )';
        }

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

        $criteria_data = new CDbCriteria($criteria);
        $criteria_data->select='MAX([[price]]) as max_price,MIN([[price]]) as min_price';
        $priceLimit = self::getModel()->find($criteria_data);


        if(!empty($data['min_price']) && !empty($data['max_price'])){
            $condition[]='t.[[price]]>=:min_price';
            $condition[]='t.[[price]]<=:max_price';
            $params[':min_price'] = $data['min_price'];
            $params[':max_price'] = $data['max_price'];
        }

//        if(!empty($data['filter']['size'])){
//            foreach($data['filter']['size'] as $size){
//                $condition_params[]="product_options.products_options_values_name='".$size."'";
//            //    print_r($size);
//            }
//            $criteria['with']['product_options']['condition']= '( '.join(' OR ',$condition_params).' )';
//        }
//        print_r($criteria);
//        exit;

        //Повторное формирование критерии
        $criteria = ['condition' => join(' AND ', $condition),
                     'params' => $params,
                      'order'=>$criteria['order']];

        // разрешаем перезаписать любые параметры критерии
        if (isset($data['criteria'])) {
            $criteria = array_merge($criteria, $data['criteria']);
        }



        $dataProvider=new CActiveDataProvider(
            'ShopProduct',
            [

                'criteria' => $criteria,
                // todo: вынести в конфиг pageSize
                'pagination' => ['pageSize' => 12],
                //                'pagination' => ['pageSize' => 9, 'currentPage' => $data['page']],
            ]
        );

        return [
            'dataProvider'=>$dataProvider,
            'priceLimit'=>$priceLimit
        ];
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