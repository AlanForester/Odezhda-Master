<?php

/**
 * Class FileController управление группами пользователей
 */
class FileController extends BackendController {

    public $model;


    public function actionIndex() {
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct')
        ];
       // print_r($_FILES);


        // получение данных
     //   $this->model = new FileModel();
     //   $File = $this->model->getListAndParams($criteria);
        return true;

    }


    public function actionUpdate() {
        $params['field'] = Yii::app()->request->getPost('name');
        $params['id'] = Yii::app()->request->getPost('pk');
        $params['newValue'] = Yii::app()->request->getPost('value');

        $model = new FileModel();
        if (!$model->updateField($params)) {
            $this->error();
        }
    }
}
