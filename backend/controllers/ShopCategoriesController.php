<?php

/**
 * Class Users
 */
class ShopCategoriesController extends BackendController {
    /**
     * @var
     */
    public $gridDataProvider;

    public $pageTitle = 'Менеджер категорий: список';
    public $pageButton = [];
    public $model;
    public $groups = [];

    public function actionIndex($id = 0) {
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
//            'filter_groups' => $this->userStateParam('filter_groups'),
//            'filter_created' => $this->userStateParam('filter_created'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct')
        ];

        // получение данных
        $model = new ShopCategoriesModel();
        $categories = $model->findByParentId($id);
        $this->gridDataProvider = new CArrayDataProvider($categories, [
            'keyField' => 'id',
            //            'pagination' => [
            //                'pageSize'=>100,
            //            ],
        ]);

//        print_r($this->layout);exit;

        $vars = compact('id','criteria');

        if ($this->isAjax){
            $this->renderPartial('index',$vars);
            Yii::app()->end();
        }

        $this->render('index',$vars);
    }

    /**
     * Метод для редактирования одного поля пользователя
     */
    //    public function actionUpdate() {
    //        $params['field'] = Yii::app()->request->getPost('name');
    //        $params['id'] = Yii::app()->request->getPost('pk');
    //        $params['newValue'] = Yii::app()->request->getPost('value');
    //
    //        $model = new UsersModel();
    //        if (!$model->updateField($params)) {
    //            $this->error();
    //        }
    //    }
    //
    public function actionEdit($id, $scenario = 'edit') {
        //        $groups_model = new GroupsModel();
        //        $groups = [];
        //        foreach ($groups_model->getList() as $g) {
        //            $groups[$g['id']] = $g['name'];
        //        }

        $model = new ShopCategoriesModel($scenario);

        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {
            $model->setAttributes($_POST['ShopCategoriesModel'], false);
            //             print_r($model);exit;
            // отправляем в модель данные
            $result = $model->save($_POST['ShopCategoriesModel']);

            if (!$result) {
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($model, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' категории')
                );
                //$this->redirect(Yii::app()->request->urlReferrer);
                $this->render('edit', compact('model', 'groups'));
                return;
            } else {
                // выкидываем сообщение
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Категория ' . ($id ? 'сохранена' : 'добавлена')
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

        $category = $model->getCategoryData($id, $scenario);
//        print_r($category);exit;
        //        print_r($category);exit;
        if ($category) {
            $model->setAttributes($category, false);
        } else
            $this->error();
        //print_r($model);exit;
        $this->render('edit', compact('model', 'groups'));
    }

    public function actionAdd() {
        $this->actionEdit(null, 'add');
    }

    public function actionDelete($id) {
        $model = new ShopCategoriesModel();

        if (!$model->delete($id)) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Выбранная категория и все ее дочерние категории удалены'
            );
        }
    }

    //    public function actionMass() {
    //        $mass_action = Yii::app()->request->getParam('mass_action');
    //        $ids = array_unique(Yii::app()->request->getParam('ids'));
    //        switch ($mass_action) {
    //            case 'delete':
    //                foreach ($ids as $id) {
    //                    $this->actionDelete($id);
    //                }
    //                break;
    //        }
    //
    //        $this->actionIndex();
    //    }
}
