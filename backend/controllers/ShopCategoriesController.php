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
    public $categories = [];

    public function actionIndex($parent_id = 0) {//TODO было id стало parent_id
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'filter_categories' => $this->userStateParam('filter_categories'),
//            'filter_created' => $this->userStateParam('filter_created'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct')
        ];
//        print_r($id);exit;
//        print_r($criteria);exit;
        // пагинация
//        $page_size = $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE);

        // получение данных
        $model = new ShopCategoriesModel();
//        $gridDataProvider = $model->getActiveProvider($criteria);

        $categories = $model->getList($parent_id,$criteria);
//        print_r($categories);exit;


//        print_r($categories);exit;
        $gridDataProvider = new CArrayDataProvider($categories, [
            'keyField' => 'id',
                        'pagination' => [
                            'pageSize'=>count($categories),
                        ],
        ]);

        $vars = compact('id','criteria','gridDataProvider');

        $groups_model = new ShopCategoriesModel();
        $this->categories[''] = '- По категории -';
        foreach ($groups_model->getCategoriesList() as $g) {
            $this->categories[$g['id']] = $g['name'];
        }

        if ($this->isAjax){
            $this->renderPartial('grids',$vars);
            Yii::app()->end();
        }

        $this->render('index',$vars);
    }

    /**
     * Метод для редактирования одного поля пользователя
     */
        public function actionUpdate() {
            $params['field'] = Yii::app()->request->getPost('name');
            $params['id'] = Yii::app()->request->getPost('pk');
            $params['newValue'] = Yii::app()->request->getPost('value');

            $model = new ShopCategoriesModel();
            if (!$model->updateField($params)) {
                $this->error();
            }
        }

    public function actionEdit($id, $scenario = 'edit') {
        $language_model = new Language();
        $languages = [];
        foreach ($language_model->getList() as $l) {
            $languages[$l['languages_id']] = $l['name'];
        }

        $parentCategories_model = new ShopCategoriesModel();
        $parentCategories = [];
        foreach ($parentCategories_model->getCategoriesList() as $p) {
            $parentCategories[$p['id']] = $p['name'];
        }

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
                $this->render('edit', compact('model', 'languages', 'parentCategories'));
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
        if ($category) {
            $model->setAttributes($category, false);
        } else
            $this->error();
        $this->render('edit', compact('model', 'languages','parentCategories'));
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
}
