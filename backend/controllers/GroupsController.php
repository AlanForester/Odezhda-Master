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
    public $model;

    public function actionIndex() {
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct')
        ];

        // пагинация
        $page_size = $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE);

        // получение данных
        $this->model = new GroupsModel();
        $groups = $this->model->getListAndParams($criteria);
        $this->gridDataProvider = new CArrayDataProvider($groups, [
            'keyField' => 'id',
            'pagination' => [
                'pageSize' => ($page_size == 'all' ? count($groups) : $page_size),
            ],
        ]);

        $this->render('index', ['page_size' => $page_size, 'criteria' => $criteria]);
    }



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
