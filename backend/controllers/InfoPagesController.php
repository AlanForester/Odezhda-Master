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
    public $model;
    public function actionIndex() {
        $criteria = [
            'text_search' => $this->userStateParam('text_search'),
            'order_field' => $this->userStateParam('order_field'),
            'order_direct' => $this->userStateParam('order_direct'),
            'page_size' => $this->userStateParam('page_size', CPagination::DEFAULT_PAGE_SIZE)
        ];

        // получение данных
        //$this->model = new InfoPagesModel();
//        $gridDataProvider = $this->model->getDataProvider($criteria); //UsersLayer::getActiveProvider();

        $this->render('index', compact('page_size', 'criteria', 'gridDataProvider'));
    }

}
