<?php

/**
 * Class FileController управление группами пользователей
 */
class FileController extends BackendController {

    public $model;


    public function actionIndex() {

//        $model=new CatalogLegacy();
////       print_r($_FILES['image']['tmp_name']);exit;
//        if(isset($_FILES['image'])){
//            $model->attributes=$_FILES['image'];
//
//            $temp=CUploadedFile::getInstance($model,'image');
//        //    if($model->save()){
//            $temp->saveAs($_FILES['image']['tmp_name']);
//      //      }
//
//        }

       // $this->render('create', array('model'=>$modMyModel));

//        Yii::import('common.extensions.upload.upload');
        $upload=new upload($_FILES["image"]);

//        print_r($_FILES["image"]);
//        exit;
        $path=Yii::app()->request->baseUrl."/upload/" ;
//        echo $path;
//        exit;
        try{
            if($upload->uploaded)
            {
                $upload->process('/var/www/Odezhda-Master/backend/www/upload/');
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
                die;
            }
        }
        catch (Exception $excp)
        {
            echo($excp);
        }

        echo json_encode([
            'success'=>true
        ]);

        Yii::app()->end();

    }


}
