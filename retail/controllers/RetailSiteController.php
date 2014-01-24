<?php

/**
 * Basic "kitchen sink" controller for frontend.
 * It was configured to be accessible by `/site` route, not the `/frontendSite` one!
 *
 * @package YiiBoilerplate\Frontend
 */
class RetailSiteController extends RetailController {

    /**
     * Actions attached to this controller
     *
     * @return array
     */
    public function actions() {
        return array(
            'index' => array(
                'class' => 'LandingPageAction'
            ),
            'error' => array(
                'class' => 'SimpleErrorAction'
            )
        );
    }
    
    public function actionKarta() {
        $this->render("/site/karta");
    }

}