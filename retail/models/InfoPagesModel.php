<?php

/**
 * Class UsersModel - работа с пользователями
 *
 */
class InfoPagesModel {

    /**
     * Возврашает информационную страницу по указанному id
     * @param $id
     * @return mixed
     */
    public function getInfoPage($id){
        return InfoPagesHelper::getPage($id);
//        return InfoPagesHelper::getInfoPage($id);
    }
}
