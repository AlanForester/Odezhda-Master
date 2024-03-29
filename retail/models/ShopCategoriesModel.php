<?php

/**
 * Class UsersModel - работа с пользователями
 *
 */
class ShopCategoriesModel {

    public $id;
    public $image;
    public $added;
    public $status;
    public $parent_id;
    public $sort_order;
    public $modified;
    public $default_manufacturers;
    public $markup;
    public $xml_flag;

    public $language_id;
    public $name;
    public $heading_title;
    public $description;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;

    public $list=[];


    /**
     * @var array массив всех категорий.
     * Значение каждого элемента массива - массив с атрибутами категории(поля из БД)
     */
    private $allCategories = [];

    public function attributeLabels() {
        return array(
            'name' => Yii::t('labels', 'Название'),
            'parent_id' => Yii::t('labels', 'Родительская категория'),
        );
    }

    public function getCategoriesList() {
        if (!$this->list) {
            $this->list = ShopCategoriesLayer::getCategoriesList();
        }
        return $this->list;
    }

    public function getClearCategoriesList() {
        if (!$this->list) {
            $this->list = ShopCategoriesLayer::getFrontCategoriesList();
        }
        return $this->list;
    }
    
    public function getList($parent_ids,$data=null) {
        if (!$this->allCategories) {
            // todo: переместить все в прослойку
            $condition = [];
            $params = [];

            $relatedCondition= [];
            $relatedParams = [];

            //если сортировка произошла по полю name, то дерево строить не надо
            $buildTree = (($data['order_field']!='name') ? true : false);

            // фильтр по тексту
            if (!empty($data['text_search'])) {
                $relatedCondition[] = '(' . join(
                        ' OR ',
                        [
                            'rel_description.'.ShopCategoriesLayer::getFieldName('name', false) . ' LIKE :text',
                        ]
                    ) . ')';

                $relatedParams[':text'] = '%' . $data['text_search'] . '%';
            }
            elseif ($buildTree) {
                $IN_str='(';
                $i=0;
                foreach ($parent_ids as $k=>$val){
                    $i++;
                    $IN_str.=':el'.$k.($i!=count($parent_ids) ? ', ' : '');
                    $params[':el'.$k]=$val;
                }
                $IN_str.=')';
                $condition[] = ShopCategoriesLayer::getFieldName('parent_id', false) . ' IN '.$IN_str;
            }
            // фильтр по родительской категории
//            if (!empty($data['filter_categories']) || $data['filter_categories']==='0') {//вторая проверка для случая, когда parent_id=0
//                $condition[] = ShopCategoriesLayer::getFieldName('parent_id', false) . '=:category';
//                $params[':category'] = $data['filter_categories'];
//            }

            // фильтр по дате создания
//            if (!empty($data['filter_created'])) {
//                $range = $data['filter_created'];
//                $date_start = new DateTime();
//                $date_now = new DateTime();
//
//                switch ($range) {
//                    case 'past_week':
//                        $date_start->modify('-7 day');
//                        break;
//
//                    case 'past_1month':
//                        $date_start->modify('-1 month');
//                        break;
//
//                    case 'past_3month':
//                        $date_start->modify('-3 month');
//                        break;
//
//                    case 'past_6month':
//                        $date_start->modify('-6 month');
//                        break;
//
//                    case 'post_year':
//                    case 'past_year':
//                        $date_start->modify('-1 year');
//                        break;
//
//                    case 'today':
//                        $date_now->modify('+1 day');
//                        break;
//                }
//
//                if ($range == 'post_year') {
//                    $condition[] = ShopCategoriesLayer::getFieldName('added', false) . ' < :date_start';
//                } else {
//                    $condition[] = '(' . ShopCategoriesLayer::getFieldName('added', false) . ' >= :date_start AND ' . ShopCategoriesLayer::getFieldName('added', false) . ' <= :date_now)';
//                    $params[':date_now'] = $date_now->format('Y-m-d');
//                }
//
//                $params[':date_start'] = $date_start->format('Y-m-d');
//            }

            // поле и направление сортировки
            $order_direct = null;
            $order_field = ShopCategoriesLayer::getFieldName(!empty($data['order_field']) ? $data['order_field'] : 'name', false);

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
            $criteria = [
                'condition' => join(' AND ', $condition),
                'params' => $params,
            ];

            $relatedCriteria = [
                'condition' => join(' AND ', $relatedCondition),
                'params' => $relatedParams,
                'order' => 'rel_description.'.$order_field . ($order_direct ? : '')
            ];
//            print_r($criteria);print_r($relatedCriteria);exit;

            // разрешаем перезаписать любые параметры критерии
            if (isset($data['criteria'])) {
                $criteria = array_merge($criteria,$data['criteria']);
            }
            if (isset($data['relatedCriteria'])) {
                $relatedCriteria = array_merge($relatedCriteria,$data['relatedCriteria']);
            }

            $this->allCategories = ShopCategoriesLayer::getList($criteria,$relatedCriteria,$buildTree);
        }
        return $this->allCategories;

//            $this->allCategories = ShopCategoriesLayer::getList(
//                [
//                    'condition' => join(' AND ', $condition),
//                    'params' => $params,
//                    'order' => $order_field . ($order_direct ? : '')
//                ]
////            );
//            $this->allCategories = ShopCategoriesLayer::getList();
//        }
//        return $this->allCategories;
    }

    public function getActiveProvider ($criteria) {
        return ShopCategoriesLayer::getActiveProvider($criteria);
    }

    /**
     * АР модель категории на основе id
     * @param int $id id категории
     * @return User
     */
    public function getCategory($id, $scenario) {
        return ShopCategoriesLayer::getCategory($id, $scenario);
    }

    /**
     * Данные категории в виде массива
     * @param int $id id категории
     * @return bool|array массив или false
     */
    public function getCategoryData($id, $scenario) {
        $category = self::getCategory($id, $scenario);
//        print_r($category);exit;
        //return ($category ? ($id ? array_merge(ShopCategoriesLayer::fieldMapConvert($category->attributes), ShopCategoriesLayer::fieldMapConvert($category->description->attributes)) : ShopCategoriesLayer::fieldMapConvert($category->attributes)) : false);
        return ($category ? ($id ? array_merge(($category->rel_description ? ShopCategoriesLayer::fieldMapConvert($category->rel_description->getAttributes()) : []), ShopCategoriesLayer::fieldMapConvert($category->getAttributes())) : ShopCategoriesLayer::fieldMapConvert($category->getAttributes())) : false);
    }

}
