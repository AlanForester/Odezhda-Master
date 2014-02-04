<?php

/**
 * Class Users
 */
class InfoPagesController extends BackendController {
    /**
     * @var
     */
    public $gridDataProvider;

    public $pageTitle = 'Информационные страницы: список';
    public $pageButton = [];
//    public $model;

    public function actionIndex() {
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct'),
            'page_size' => $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE)
        ];

        // получение данных
        $model = new InfoPagesModel();
        $gridDataProvider = $model->getDataProvider($criteria);

        $this->render('index', compact('page_size', 'criteria', 'gridDataProvider'));
    }

    /**
     * Метод для редактирования одного поля пользователя
     */
    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['pk'] = Yii::app()->request->getPost('pk');
        $params['value'] = Yii::app()->request->getPost('value');

        $model = new InfoPagesModel();
        if (!$model->updateField($params)) {
            $this->error(CHtml::errorSummary($model, 'Ошибка изменения данных пользователя'));
        }
    }

    public function actionDelete($id) {

        $model = new InfoPagesModel();
        if (!$model->delete($id)) {
            $this->error();
        } else {
            Yii::app()->user->setFlash(
                TbHtml::ALERT_COLOR_INFO,
                'Пользователь удален'
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
