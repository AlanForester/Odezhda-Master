<?php

/**
 * Class CatalogController управление группами пользователей
 */
class CatalogController extends BackendController {
    /**
     * @var
     */
    public $gridDataProvider;

    public $pageTitle = 'Управление товарами: список';
    public $pageButton = [];
    public $model;

    public $categories = [];
    public $options = [];
    public $manufacturers_list = [];
    public $languages_list = [];


//    private function error($msg = 'Something wrong in your request!') {
//        throw new CHttpException(400, Yii::t('err', $msg));
//    }

    public function actionIndex() {
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct'),
            'filter_category' => $this->userStateParam('filter_category')
        ];

        // пагинация
        $page_size = $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE);



        // получение данных
        //todo Alex: Заместо CformModel  используем AR
        $this->model = new CatalogModel();
        $catalog = $this->model->getListAndParams($criteria);

/*
        $this->gridDataProvider=new CActiveDataProvider('WorksCategoryUsersLinks',
            array(
                'criteria'=>array(
                    'condition'=>'t.uid=1',
                    'with'=>array('fileDetails','file','userDetails','categoryName'),
                    'together'=>true,
                    'group'=>'t.fid',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                    'pageVar'=>'page',
                ),

            ));

        echo '<pre>';
        print_r($catalog);
        exit;
*/

        $this->gridDataProvider = new CArrayDataProvider($catalog, [
            'keyField' => 'id',
            'pagination' => [
                'pageSize' => ($page_size == 'all' ? count($catalog) : $page_size),
            ],
        ]);
        //todo Alex: Заместо CformModel  используем AR
       $categories_model = new ShopCategoriesModel();
       $this->categories[''] = '- По категории -';

//        $this->categories[''] = $categories_model->getClearCategoriesList();


       foreach ($categories_model->getCategoriesList() as $g) {
           $this->categories[$g['id']] = $g['name'];
       }

        $this->render('index', ['page_size' => $page_size, 'criteria' => $criteria]);
    }



    public function actionList() {
        $model = new CatalogModel();
        $result = [];
        $list = $model->getList();

        if ($list) {
            foreach ($model->getList() as $g) {
                $result[$g['id']] = $g['name'];
            }
             json_encode($result);
            Yii::app()->end();
        } else {
            throw new CHttpException(400, Yii::t('err', 'Something wrong in your request!'));
        }
    }

    public function actionEdit($id, $scenario = 'edit') {

        $categories_model = new ShopCategoriesModel();
        foreach ($categories_model->getCategoriesList() as $g) {
            $this->categories[$g['id']] = $g['name'];
        }
        $manufacturers_model = new ManufacturersModel();
        foreach ($manufacturers_model->getList() as $g) {
            $this->manufacturers_list[$g['id']] = $g['name'];
        }

        $language_model = new Language();
        foreach ($language_model->getList() As $l) {
         $this->languages_list[$l['languages_id']]= $l['name'];
        }

        $model = new CatalogModel($scenario);

        $form_action = Yii::app()->request->getPost('form_action');

//       print_r($_FILES['CatalogModel']);


        if (!empty($form_action)) {

            if($data=$_POST['CatalogModel']){
                $data=$_POST['CatalogModel'];
            }
            if(!empty($_FILES)){
                $data['image']=$_FILES['CatalogModel']['name']['image'];
            }


            $model->setAttributes($data, false);

            if(!empty($_FILES)){
                //todo:БК
                foreach($_FILES['CatalogModel'] as $key=>$field){
                    $data['images'][$key]=$field['image'];
                   // unset($_FILES['CatalogModel'][$key]['image']);
                }
//                print_r($_FILES);exit;
//
//                $data['images']=$_FILES['CatalogModel'];



            }


            // отправляем в модель данные
//            print_r($_POST['CatalogModel']);
//            exit;
            $result = $model->save($data);

            if (!$result) {
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($model, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' товара')
                );
                //$this->redirect(Yii::app()->request->urlReferrer);
                $this->render('edit', compact('model', 'catalog'));
                return;
            } else {
                // выкидываем сообщение
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Товар ' . ($id ? 'сохранен' : 'добавлен')
                );
                if ($form_action == 'save') {
                    $this->redirect(['index']);
                    return;
                } else {
                    $this->redirect(['edit', 'id' => $result['id']]);
                    return;
                }
            }
        }

        $catalog = $model->getCatalogData($id, $scenario);


        if ($catalog) {
            $model->setAttributes($catalog, false);
        } else
            $this->error();




        $this->render('edit', compact('model', 'catalog'));
    }

    public function actionAdd() {
        $this->actionEdit(null, 'add');
    }


    public function actionDelete($id) {
        $model = new CatalogModel();

        if (!$model->delete($id)) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Продукт удален'
            );
        }
    }

    public function actionMass() {
        $mass_action = Yii::app()->request->getParam('mass_action');
        $ids = array_unique(Yii::app()->request->getParam('ids'));
        switch ($mass_action) {
            case 'delete':
                foreach ($ids as $id) {
                    $this->actionDelete($id);
                }
                break;
        }

        $this->actionIndex();
    }

    /**
     * Метод для редактирования одного поля пользователя
     */
    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['newValue'] = Yii::app()->request->getPost('value');

        $model = new CatalogModel();

        if(!$model->updateField($params)) {
             $this->error();
        }
    }




    /*public function actionInfo($id) {
        $this->model = new CatalogModel();
        $model = $this->model->getCatalogData($id,'edit');
        $response['catalog'] = $model;
        //$response['with'] = $model->with;
        echo CJSON::encode($response);
        Yii::app()->end();
    }*/

    public function actionSelectOptions($id) {
        $productOptions = [];
        $product = ShopProduct::model()->with('products_new_option_values')->findByPk($id);
        //echo '<pre>'.print_r($product,1);exit;

        if(!empty($product->products_new_option_values)) {
            foreach ($product->products_new_option_values as $option) {
                $productOptions[$option['id']] = $option['value'];
            }
        }
        $this->renderPartial('select_options', compact('product','productOptions','id'));
        Yii::app()->end();
    }

    //todo: возможно, стоит совместить с index (скопировано оттуда)
    public function actionBootbox($id = null) {

        $criteria = ['page_size' => 10];

        //todo CformModel => AR
        $this->model = new CatalogModel();
        $catalog = $this->model->getListAndParams($criteria);

        $gridDataProvider = new CArrayDataProvider($catalog, [
            'keyField' => 'id',
            'pagination' => [
                'pageSize' => $criteria['page_size'],
            ],
        ]);
        //todo CformModel => AR
        $categories_model = new ShopCategoriesModel();
        $this->categories[''] = '- По категории -';

        foreach ($categories_model->getCategoriesList() as $g) {
            $this->categories[$g['id']] = $g['name'];
        }

        $this->renderPartial('bootbox', compact('criteria','gridDataProvider','id'));
    }

}
