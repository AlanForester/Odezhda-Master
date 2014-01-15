<?php
/**
 * Controller action representing the act of home page rendering on backend.
 *
 * Everything which should be done when user opens the backend landing page is here.
 *
 * @package YiiBoilerplate\Backend
 */
class BackendHomePageAction extends CAction
{
    /**
     * We render the homepage as a controller action here.
     */
    public function run()
    {
        $user = Yii::app()->user;
        if ($user->isGuest){
            $this->controller->redirect(Yii::app()->request->baseUrl.'/site/login');
        }

        //$this->controller->layout = '//layouts/main';
        $this->controller->render('index');
    }
} 