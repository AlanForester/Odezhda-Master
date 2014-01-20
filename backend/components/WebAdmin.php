<?php

class WebAdmin extends CWebUser {
    private $_model = null;
    
    function getRole() {
        if($user = $this->getModel()){
            if($user->admin_groups_id==1){
                return 'administrator';    
            }
            if($user->admin_groups_id==2){
                return 'manager';    
            }
            if($user->admin_groups_id==3){
                return '011';    
            }
            if($user->admin_groups_id==4){
                return 'ira';    
            }
            if($user->admin_groups_id==5){
                return '555';    
            }
            if($user->admin_groups_id==6){
                return 'group2';    
            }
            if($user->admin_groups_id==7){
                return 'sklad';    
            }
            if($user->admin_groups_id==8){
                return 'developers';    
            }
            if($user->admin_groups_id==9){
                return 'photo';    
            }
            if($user->admin_groups_id==10){
                return 'otpravki';    
            }
            if($user->admin_groups_id==11){
                return 'lapana_ru';    
            }
        }
    }
 
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = UsersLayer::findByPk(Yii::app()->user->id, array('select' => 'admin_groups_id'));
        }        
        return $this->_model;
    }
}