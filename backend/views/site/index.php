<?php
/**
 * @var BackendSiteController $this
 */
//$this->pageTitle=Yii::app()->name;
if(Yii::app()->user->checkAccess('administrator')){
            echo "hello, I'm administrator";
        }


