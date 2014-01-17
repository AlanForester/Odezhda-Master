<?php

class PhpAuthManager extends CPhpAuthManager{
    public function init(){
        // Èåğàğõèş ğîëåé ğàñïîëîæèì â ôàéëå auth.php â äèğåêòîğèè config ïğèëîæåíèÿ
        if($this->authFile===null){
            $this->authFile=Yii::getPathOfAlias('application.config.overrides.auth').'.php';
        }
        parent::init(); 
        if(!Yii::app()->user->isGuest){ 
            $this->assign(Yii::app()->user->role, Yii::app()->user->id);
        }
    }
}