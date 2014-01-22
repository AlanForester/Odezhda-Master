<?php

/**
 * Base class for the controllers in backend entry point of application.
 *
 * In here we have the behavior common to all backend routes, such as registering assets required for UI
 * and enforcing access control policy.
 *
 * @package YiiBoilerplate\Backend
 */
abstract class BackendController extends CController {
    /** @var array This will be pasted into breadcrumbs widget in layout */
    public $breadcrumbs = [];

    /** @var array This will be pasted into menu widget in sidebar portlet in two-column layout */
    public $menu = array();

    public $assets_backend = null;

    public $pageTitle = '';
    public $pageButton = [];

    public $isAjax = false;

    public function run($aid) {
        // тестовое решение
        $this->isAjax = (Yii::app()->request->getParam('ajax') ? true : false);
        $this->layout = ($this->isAjax ? '_content' : 'main');
        parent::run($aid);
    }

    /**
     * Получить параметр из сессии или запроса. Запрос имеет более высокий приоритет перед данными
     * из сессии. Полученный параметр будет перезаписн в пользовательские данные
     * @param string $param имя параметра
     * @param null $default [опционально] значение по умолчанию
     * @return mixed найденное и записанное значение
     */
    private function userStateParam($param, $default = null) {
        $data = Yii::app()->request->getParam(
            $param,
            Yii::app()->user->getState($param, $default)
        );

        Yii::app()->user->setState($param, $data);
        return $data;
    }

    /**
     * Rules for CAccessControlFilter.
     *
     * We allow all actions to logged in users and disable everything for others.
     *
     * @see http://www.yiiframework.com/doc/api/1.1/CController#accessRules-detail
     *
     * @return array
     */
    public function accessRules() {
        return [
            // разрешаем все для группы админов
            //            [
            //                'allow',
            //                'role' => ['administrator']
            //            ],

            // todo: после прикручивания системы прав, включить управление по ролям
            // запрещаем все для неавторизированных
            [
                'deny',
                'users' => ['?'],
            ],
        ];
    }

    public function filters() {
        return [
            'accessControl',
        ];
    }

    /**
     * Before rendering anything we register all of CSS and JS assets we require for backend UI.
     *
     * @see CController::beforeRender()
     *
     * @param string $view
     * @return bool
     */
    protected function beforeRender($view) {
        $result = parent::beforeRender($view);
        $this->registerAssets();
        return $result;
    }

    private function registerAssets() {
        $publisher = Yii::app()->assetManager;
        //        $libraries = $publisher->publish(ROOT_DIR . '/common/packages');
        Yii::app()->bootstrap->register();

        $this->assets_backend = $publisher->publish(ROOT_DIR . '/backend/packages');
    }

    /**
     * Регистрация стилей и сркиптов для темы оформления. Данную функцию следует вызывать в нужном layoyt'е,
     * т.е. требуется перекрывать многие стили bootstrap'а
     */
    public function registerTemplateAssets() {
        // === СТИЛИ ===
        // форма и элементы
        Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/chosen.css');

        // файлы темы ace
        Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/font-awesome.min.css');
        Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/ace.min.css');
        Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/ace-responsive.min.css');
        Yii::app()->getClientScript()->registerCssFile($this->assets_backend . '/theme/css/ace-skins.min.css');


        // === СКРИПТЫ ===
        Yii::app()->getClientScript()->registerScriptFile($this->assets_backend . '/bootbox.min.js');
        Yii::app()->getClientScript()->registerScriptFile($this->assets_backend . '/theme/js/chosen.jquery.min.js');
        Yii::app()->getClientScript()->registerScriptFile($this->assets_backend . '/theme/js/ace-elements.min.js');
        Yii::app()->getClientScript()->registerScriptFile($this->assets_backend . '/theme/js/ace.min.js');
    }
}
