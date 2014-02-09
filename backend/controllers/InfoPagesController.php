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

    public function actionEdit($id, $scenario = 'edit') {
        $language_model = new Language();
        $languages = [];
        foreach ($language_model->getList() as $l) {
            $languages[$l['languages_id']] = $l['name'];
        }

        $model = new InfoPagesModel($scenario);
        if (!$item = $model->getPage($id, $scenario)){
            $this->error('Ошибка получения данных информационной страницы');
        }
        $form_action = Yii::app()->request->getPost('form_action');
        if (!empty($form_action)) {
            // записываем пришедшие с запросом значения в модель, чтобы не сбрасывать уже набранные данные в форме
            $item->setAttributes($model->getPostData(),false);
            // записываем данные
            $result = $model->save($model->getPostData());

            if (!$result) {
                // ошибка записи
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_ERROR,
                    CHtml::errorSummary($model, 'Ошибка ' . ($id ? 'сохранения' : 'добавления') . ' информационной страницы')
                );
                //$this->redirect(Yii::app()->request->urlReferrer);
//                $this->render('edit', compact('item', 'groups'));
//                return;
            } else {
                // выкидываем сообщение
                Yii::app()->user->setFlash(
                    TbHtml::ALERT_COLOR_INFO,
                    'Информационная страница ' . ($id ? 'сохранена' : 'добавлена')
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

        $this->render('edit', compact('item', 'languages'));
    }

    public function actionAdd() {
        $this->actionEdit(null, 'add');
    }

}
