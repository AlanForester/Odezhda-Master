<?php

/**
 * Class GroupsController управление группами пользователей
 */
class GroupsController extends BackendController {
    /**
     * @var
     */
    public $gridDataProvider;

    public $pageTitle = 'Группы пользователей';
    public $pageButton = [];

    public function actionList() {
        $model = new GroupsModel();
        $result = [];
        $list = $model->getList();

        if ($list) {
            foreach ($model->getList() as $g) {
                $result[$g['id']] = $g['name'];
            }
            echo json_encode($result);
            Yii::app()->end();
        } else {
            throw new CHttpException(400, Yii::t('err', 'Something wrong in your request!'));
        }

    }
}
