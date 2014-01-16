<?php

/**
 * Base class for the controllers in backend entry point of application.
 *
 * In here we have the behavior common to all backend routes, such as registering assets required for UI
 * and enforcing access control policy.
 *
 * @package YiiBoilerplate\Backend
 */
abstract class BackendController extends CController
{
    /** @var array This will be pasted into breadcrumbs widget in layout */
    public $breadcrumbs = array();

    /** @var array This will be pasted into menu widget in sidebar portlet in two-column layout */
    public $menu = array();

    public $assets_backend = null;

    /**
     * Additional behavior associated with different routes in the controller.
     *
     * This is base class for all backend controllers, so we apply CAccessControlFilter
     * and on all actions except `actionDelete` we make the YiiBooster library to be available.
     *
     * @see http://www.yiiframework.com/doc/api/1.1/CController#filters-detail
     * @see http://www.yiiframework.com/doc/api/1.1/CAccesControlFilter
     * @see http://yii-booster.clevertech.biz/getting-started.html#initialization
     *
     * @return array
     */

    /**
     * Rules for CAccessControlFilter.
     *
     * We allow all actions to logged in users and disable everything for others.
     *
     * @see http://www.yiiframework.com/doc/api/1.1/CController#accessRules-detail
     *
     * @return array
     */
    public function accessRules()
    {
        return array(
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
        );
    }

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /**
     * Before rendering anything we register all of CSS and JS assets we require for backend UI.
     *
     * @see CController::beforeRender()
     *
     * @param string $view
     * @return bool
     */
    protected function beforeRender($view)
    {
        $result = parent::beforeRender($view);
        $this->registerAssets();
        return $result;
    }

    private function registerAssets()
    {
        $publisher = Yii::app()->assetManager;
        $libraries = $publisher->publish(ROOT_DIR . '/common/packages');
        Yii::app()->bootstrap->register();
        // NOTE that due to limitations of CClientScript.registerPackage
        // we cannot specify the javascript files to be registered before closing </body> tag.
        // So our only option until Yii 2 is to open up the package and manually register everything in it.

        $this->assets_backend = $publisher->publish(ROOT_DIR . '/backend/packages');
    }
}
