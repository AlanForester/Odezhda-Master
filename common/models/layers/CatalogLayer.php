<?php

class CatalogLayer {
    /**
     * @var array (поле БД => требуемое поле для модели)
     */
    private static $field_map = [
        'products_id' => 'id',
        'products_price' => 'price',
        'products_old_price' => 'old_price',
        'products_tax_class_id' => 'tax',
        'products_ordered' => 'count_orders',


        'products_quantity' => 'quantity',
        'products_date_added' =>'date_add',
        'products_last_modified'=>'date_last',
        // если товар виртуальный - код равняется 0
        'products_weight'=>'weight',
        'products_model'=>'model',


        //порядок сортировки
        'products_sort_order'=>'order',

        'products_quantity_order_min'=>'min_quantity',
        //шаг заказа
        'products_quantity_order_units'=>'step',


        //грппа checkbox
        'products_status' => 'status',
        'products_to_xml' => 'xml',
        //таблица описание товара
            'products_name' => 'name',
            'products_description' => 'description',
                //таблица категории товара
                    'categories_name' =>'category',
        //таблица производителя товара
            'manufacturers_name' => 'manufacturers',
        //meta
            'products_head_title_tag' => 'meta_title',
            'products_head_desc_tag' => 'meta_description',
            'products_head_keywords_tag' => 'meta_keywords',
        //фото
            'products_image' => 'image'
    ];

    public static $errors = [];
    /**
     * @param $row массив соответствий
     * @param bool $reverse конвертировать в прямую или обратную сторону(по умолчанию -  прямую)
     * @return mixed конвертированный по ключам массив
     *
     */
    public static function fieldMapConvert($row, $reverse = false) {
        if (!$reverse) {
            foreach (self::$field_map as $k => $v) {
                if (array_key_exists($k, $row)) {
                    $row[$v] = $row[$k];
                    unset($row[$k]);
                }
            }
        } else {
            foreach (self::$field_map as $k => $v) {
                if (isset ($row[$v])) {
                    $row[$k] = $row[$v];
                    unset($row[$v]);
                }
            }
        }

        return $row;
    }


    public static function getListAndParams($data) {
        $result = [];

        $criteria_data=array_merge(
            $data['main'],
            ['with'=>
                ['description'=>$data['description'],
                'categories_description'=>$data['categories_description'],
                'manufacturers',
                'catalog_options_values']]);


        $criteria = new CDbCriteria($criteria_data);
        //TODO: костыль не отрабытывает лимит , переписать для data active , тоже БК
        if(empty($data['categories_description']['condition'])){
              $criteria->limit=100;
        }



        $list = CatalogLegacy::model()->findall($criteria);

//        print_r($list);
//        exit;
        foreach ($list as $key => $val) {
            $result[$key] = self::fieldMapConvert($val->attributes);
            if(!empty($val->description->attributes)){
                $result[$key]+=self::fieldMapConvert($val->description->attributes);
            }
            if(!empty($val->manufacturers->attributes)){
                $result[$key]+=self::fieldMapConvert($val->manufacturers->attributes);
            }
//            Через запятую
            $result[$key]['categories_list']='';
            foreach($val->categories_description as $key_up => $val_up){

                if(!empty($val_up['categories_id'])){
                    if($key_up!=0){
                        $result[$key]['categories_list'].=', ';
                    }
                    $result[$key]['categories_list'].=$val_up['categories_name'];
                }
            }
//            Через запятую
            $result[$key]['catalog_options_values']='';
            foreach($val->catalog_options_values as $key_up => $val_up){

                if(!empty($val_up['products_options_values_name'])){
                    if($key_up!=0){
                        $result[$key]['catalog_options_values'].=', ';
                    }
                    $result[$key]['catalog_options_values'].=$val_up['products_options_values_name'];
                }
            }

            //Полная запись
//            if(!empty($val->catalog_options_values)){
//                foreach($val->catalog_options_values as $key_up => $val_up){
//                     $result[$key]['catalog_options_values'][$key_up]=$val_up->attributes;
//                }
//            }

        }
//

        return $result;
    }


//    public static function getCatalog($id = null, $scenario = null) {
//
//        return ($id ? CatalogLegacy::model()->with('description')->findByPk($id) : new CatalogLegacy($scenario));
//
////        echo '<pre>';
////        $catalog_data=CatalogLegacy::model()->with('description')->findByPk($id);
////        $catalog_data->attributes=$catalog_data->description->attribute;
////        print_r($catalog_data->description->attributes);
////        exit;
//    }

    public static function getCatalog($id = null, $scenario = null) {
        if ($id){
            $catalog = CatalogLegacy::model()->findByPk($id);


            if (!empty($catalog)){
                $relations=$catalog->relations();
                foreach($relations as $r_name => $r_value){
                    if (empty ($catalog->{$r_name})){
                        $catalog->{$r_name} = new ShopCategoriesDescriptionLegacy();
                    }
                }
            }

        } else {
            $catalog = new CatalogLegacy($scenario);
            $relations=$catalog->relations();
            if (!empty($relations)){

                foreach($relations as $r_name => $r_value){
                    $r_class = $r_value[1];
                    $catalog->{$r_name} = new $r_class();
                }
            }
        }
        return $catalog;
    }



    public static function getFieldName($field, $direct = true) {
        if ($direct) {
            // old => new
            return (array_key_exists($field, self::$field_map) ? self::$field_map[$field] : $field);
        } else {
            // new => old
            return (array_search($field, self::$field_map) ? : $field);
        }
    }

    public static function getList() {
        $result = [];
        $list = CatalogLegacy::model()->findall();
        foreach ($list as $val) {
            $result[] = self::fieldMapConvert($val->attributes);
        }

        return $result;
    }







    public static function save($data) {

        //fileupload
        if(!empty($data['images'])){
            $upload=new upload($data['images']);

            try{
                $sizes = [0=>['path'=>'catalog/'],
                         1=>['x'=>'50','y'=>'75','path'=>'catalog/small'],
                         2=>['x'=>'223','y'=>'330','path'=>'catalog/middle'],
                         3=>['x'=>'600','y'=>'900','path'=>'catalog/large']];
                foreach($sizes as $size){
                    if(isset($size['x'])){
                        $upload->image_resize = true;
                        $upload->image_x = $size['x'];
                        $upload->image_y = $size['y'];
//                        $upload->image_crop='TB';
                        $upload->image_ratio_y= true;
                    }

                    if($upload->uploaded)
                    {
                        $upload->process(realpath('backend/www/images').'/'.$size['path']);
                    }
                    else
                    {
                        echo(" file not uploaded ");
                    }
                    if($upload->processed) {
                        $Name = $upload->file_dst_name;
                    }
                    else
                    {
                        echo("upload not processed");
                    }
                }
            }
            catch (Exception $excp)
            {
                echo($excp);
            }
        }


       // $id = TbArray::getValue('id', $data);
        $id=isset($data['id']) ? $data['id'] : null;
        //$id=$data['id'];
        // модель группы
        $catalog = self::getCatalog($id, 'add');
        if (!$catalog) {
            return false;
        }

        if ($id) {
            // обновление группы

        } else {
            // если есть пустой id в параметрах - удаяем
            if (array_key_exists('id', $data)) {
                unset($data['id']);

            }
            $data['date_add'] = new CDbExpression('NOW()');
        }
        $data['date_last'] = new CDbExpression('NOW()');
//        print_r($data);
//        exit;
        // задаем значения, получаем реальные имена полей
        //$catalog->setAttributes(self::fieldMapConvert($data, true), false);

        $catalog->setAllData(self::fieldMapConvert($data, true), false);


        if (!$catalog->save()) {
            self::$errors = $catalog->getErrors();
            return false;
        }


        return self::fieldMapConvert($catalog->attributes);
        // сохраняем и переворачиваем в виртуальные данные
        //        return ($user->save() ? self::fieldMapConvert($user->attributes) : false);
    }



    public static function validate($attributes = null, $clearErrors = true) {
        //        $model = self::getUser();
        //        $model->setAttributes(self::fieldMapConvert($attributes, true));
        return CatalogLegacy::model()
            ->validate($attributes, $clearErrors);
        //        return UserLegacy::validate($attributes,$clearErrors);
    }

    public static function getErrors($attributes = null) {
        //        print_r(UserLegacy::model());exit;
        //        return UserLegacy::model()->getErrors($attributes);
        return self::$errors;
    }

    /**
     * данные для валидации для внешнего использования
     */
    public static function rules() {
        $rules = CatalogLegacy::model()
            ->rules();
        foreach ($rules as &$r) {
            $r[0] = join(
                ',',
                array_map(
                    function ($el) {
                        return self::getFieldName(trim($el));
                    }, explode(',', $r[0])
                )
            );
        }

        return $rules;
    }

    public static function delete($id) {
        $Catalog = self::getCatalog($id);
        if ($Catalog) {
            return $Catalog->delete();
        }

        return false;
    }


//    public static function delete($id) {
//        $parent = self::getCatalog($id);
//        //print_r($parent);exit;
//        if (!($parent && $parent->delete())) {
//            return false;
//        } else {
//            $children = self::findByParentId($id);
//
//            foreach ($children as $val) {
//                $child = self::getCatalog($val['id']);
//                //print_r($child);exit;
//                if (!($child && $child->delete())) {
//                    return false;
//                }
//            }
//            return true;
//        }
//    }

    /**
     * Обновление значения параметра пользователя
     *
     * @param array $data массив данных для изменяемому полю бд. ключи: id - первичный ключ,field - название изменяемого поля,
     * newValue - новое значение поля
     *
     * @return bool
     */
    public static function updateField($data) {
        // реальное имя поля
        $field = self::getFieldName($data['field'], false);
        $catalog_id = TbArray::getValue('id', $data, false); //(!empty($data['id']) ? $data['id'] : false);
        $value = TbArray::getValue('newValue', $data, false); //(!empty($data['newValue']) ? $data['newValue'] : false);

        $data_params=['id'=>$catalog_id,$data['field']=>$value];
//        print_r($data_params);
//        exit;
        // все все данные верны, сохраняем
        if ($catalog_id && $field && $value!='') {
            $catalog = self::getCatalog($catalog_id);

//            echo '<pre>';



            //$catalog->{$field} = $value;

//            return $Catalog->save(true, [$field]);
           $catalog->setAllData(self::fieldMapConvert(  $data_params, true), false);

            if (!$catalog->save()) {
                self::$errors = $catalog->getErrors();
                return false;
            }


            return self::fieldMapConvert($catalog->attributes);
        }

        return false;
    }


    //front
    public static function frontCatalogData($data){
       // $data['main'];

      foreach($data as $data_key => $data_val){
            $temp= array_merge(
                $data_val,['with'=>
                    ['description'=>['description'],
                     'categories_description'=>['categories_description'],
                     'manufacturers']]);

            $criteria = new CDbCriteria($temp);
            $criteria->limit=6;

            $list = CatalogLegacy::model()->findall($criteria);

            //Преобразование
            foreach ($list as $key => $val) {
                $result[$key] = self::fieldMapConvert($val->attributes);
                if(!empty($val->description->attributes)){
                    $result[$key]+=self::fieldMapConvert($val->description->attributes);
                }
                if(!empty($val->manufacturers->attributes)){
                    $result[$key]+=self::fieldMapConvert($val->manufacturers->attributes);
                }
//                $result[$key]['categories_list']='';
//                foreach($val->categories_description as $key_up => $val_up){
//
//                    if(!empty($val_up['categories_id'])){
//                        if($key_up!=0){
//                            $result[$key]['categories_list'].=', ';
//                        }
//                        $result[$key]['categories_list'].=$val_up['categories_name'];
//                    }
//                }
            }

            $tabs[$data_key]=$result;
      }

//
//
//        $temp= array_merge(
//            $data['old_model'],['with'=>
//            ['description'=>['description'],
//                'categories_description'=>['categories_description'],
//                'manufacturers']]);
//
//        $criteria = new CDbCriteria($temp);
//        $criteria->limit=6;
//
//
//        $list = CatalogLegacy::model()->findall($criteria);
//
//        foreach ($list as $key => $val) {
//            $result[$key] = self::fieldMapConvert($val->attributes);
//            if(!empty($val->description->attributes)){
//                $result[$key]+=self::fieldMapConvert($val->description->attributes);
//            }
//            if(!empty($val->manufacturers->attributes)){
//                $result[$key]+=self::fieldMapConvert($val->manufacturers->attributes);
//            }
//            $result[$key]['categories_list']='';
//            foreach($val->categories_description as $key_up => $val_up){
//
//                if(!empty($val_up['categories_id'])){
//                    if($key_up!=0){
//                        $result[$key]['categories_list'].=', ';
//                    }
//                    $result[$key]['categories_list'].=$val_up['categories_name'];
//                }
//            }
//        }
//
//        $tabs['old_model']=$result;
//
//        $temp= array_merge(
//            $data['leaders'],['with'=>
//            ['description'=>['description'],
//                'categories_description'=>['categories_description'],
//                'manufacturers']]);
//
//        $criteria = new CDbCriteria($temp);
//        $criteria->limit=6;
//
//
//        $list = CatalogLegacy::model()->findall($criteria);
//
//        foreach ($list as $key => $val) {
//            $result[$key] = self::fieldMapConvert($val->attributes);
//            if(!empty($val->description->attributes)){
//                $result[$key]+=self::fieldMapConvert($val->description->attributes);
//            }
//            if(!empty($val->manufacturers->attributes)){
//                $result[$key]+=self::fieldMapConvert($val->manufacturers->attributes);
//            }
//            $result[$key]['categories_list']='';
//            foreach($val->categories_description as $key_up => $val_up){
//
//                if(!empty($val_up['categories_id'])){
//                    if($key_up!=0){
//                        $result[$key]['categories_list'].=', ';
//                    }
//                    $result[$key]['categories_list'].=$val_up['categories_name'];
//                }
//            }
//        }
//
//        $tabs['leaders']=$result;

        return $tabs;

    }


    //front
    public static function frontCatalogList($offset,$data_desc,$category_id=0){
        $data= array_merge(
            $data_desc['new_model'],['with'=>
            ['description'=>'description',
                'categories_description'=>$data_desc['categories_description'],
                'manufacturers'=>'manufacturers'
            ]
            ]);

        $criteria = new CDbCriteria($data);
        $count = CatalogLegacy::model()->count($data);
        //todo:limit
        $criteria->limit=6;
        $criteria->offset=$offset;
//            print_r($criteria);
//            exit;
        $result=[];
        $list = CatalogLegacy::model()->findall($criteria);

        $current_category = ShopCategoriesLegacy::model()->with('rel_description')->findByPk($category_id);
        if($category_id!=0){
             $current_category = $current_category->attributes +$current_category->rel_description->attributes;
        }


            foreach ($list as $key => $val) {
                $result[$key] = self::fieldMapConvert($val->attributes);
                if(!empty($val->description->attributes)){
                    $result[$key]+=self::fieldMapConvert($val->description->attributes);
                }
                if(!empty($val->manufacturers->attributes)){
                    $result[$key]+=self::fieldMapConvert($val->manufacturers->attributes);
                }
                $result[$key]['categories_list']='';
                foreach($val->categories_description as $key_up => $val_up){

                    if(!empty($val_up['categories_id'])){
                        if($key_up!=0){
                            $result[$key]['categories_list'].=', ';
                        }
                        $result[$key]['categories_list'].=$val_up['categories_name'];
                    }
                }
            }

        return ['list'=>$result,'count'=>$count,'current_category'=>$current_category];
    }

    public static function productById($id){
       $list = self::getCatalog($id);

        if($list){
            $result = self::fieldMapConvert($list->attributes);
            if(!empty($list->description->attributes)){
                $result+=self::fieldMapConvert($list->description->attributes);
            }
            if(!empty($list->manufacturers->attributes)){
                $result+=self::fieldMapConvert($list->manufacturers->attributes);
            }
            if(empty($result['manufacturers'])){
                 $result['manufacturers']='неизвестно';
            }

            $result['categories_list']='';
            foreach($list->categories_description as $key_up => $val_up){

                if(!empty($val_up['categories_id'])){
                    if($key_up!=0){
                        $result['categories_list'].=', ';
                    }
                    $result['categories_list'].=$val_up['categories_name'];
                }
            }
            return $result;
        }
        return false;
    }




}