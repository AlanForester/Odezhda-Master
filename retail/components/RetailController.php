<?php

/**
 * Base class for controllers at frontend.
 *
 * Includes all assets required for frontend and also registers Google Analytics widget if there's code specified.
 *
 * @package YiiBoilerplate\Frontend
 *
 */
class RetailController extends CController {
    /** @var array This will be pasted into breadcrumbs widget in layout */
    public $breadcrumbs = [];

    /** @var название страницы */
    public $pageTitle;

    public $assets_retail;

    /**
     * What to do before rendering the view file.
     *
     * We include Google Analytics code if ID was specified and register the frontend assets.
     *
     * @param string $view
     * @return bool
     */
    public function beforeRender($view) {
        $result = parent::beforeRender($view);
        $this->addGoogleAnalyticsCode();
        $this->registerAssets();

        $this->setTitle($this->pageTitle);
        return $result;
    }

    private function addGoogleAnalyticsCode() {
        $gaid = @Yii::app()->params['google.analytics.id'];
        if ($gaid)
            $this->widget('frontend.widgets.GoogleAnalytics.GoogleAnalyticsWidget', compact('gaid'));
    }

    private function registerAssets() {
        Yii::app()->bootstrap->register();
        $publisher = Yii::app()->assetManager;
        $libraries = $publisher->publish(ROOT_DIR . '/common/packages');

        $frontend = $publisher->publish(ROOT_DIR . '/frontend/packages');

        $this->assets_retail = $publisher->publish(ROOT_DIR . '/retail/packages');
    }

    protected function error($msg = 'Ошибка',$code = 400) {
        throw new CHttpException($code, Yii::t('err', $msg));
    }

    public function setTitle($title){
        $this->pageTitle = ($title?$title.' - ':'').Yii::app()->params['title'];
    }
}
