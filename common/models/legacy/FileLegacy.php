<?php

/**
 * Class GroupsModel - работа с группамми пользователей
 *
 */

class FileLegacy extends CActiveRecord {
    public $image;

    public function rules(){
        return array(
            array('image', 'file', 'types'=>'jpg, gif, png'),
        );
    }
    
}
