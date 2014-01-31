<?php

/**
 * Class FileController управление группами пользователей
 */
class FileController extends BackendController {

    public $model;


    public function actionIndex() {

        $modMyModel=new MyModel;

        if(isset($_FILES['images'])){
            $modMyModel->attributes=$_POST['MyModel'];
            $modMyModel->id_image=CUploadedFile::getInstance($modMyModel,'image');
            if($modMyModel->save()){
                $modMyModel->id_image->saveAs('path/to/localFile');
                // перенаправляем на страницу, где выводим сообщение об
                // успешной загрузке
            }
        }

       // $this->render('create', array('model'=>$modMyModel));


//       print_r($_);



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
