<?php

/**
 * Class UsersModel - работа с пользователями
 *
 */
class InfoPagesModel extends CFormModel {
    /**
     * Получить дата провайдера
     * @param null|array $criteria [опционально] дополнительные параметры критерии (по умолчанию null)
     * @return CActiveDataProvider
     */
    public function getDataProvider($criteria = null) {
        return InfoPagesHelper::getDataProvider($criteria);
    }

    public function getErrors($attributes = null) {
        return InfoPagesHelper::getErrors($attributes);
    }

    public function getPage($id, $scenario = null) {
        return InfoPagesHelper::getPage($id, $scenario);
    }
    /**
     * Обновление параметра пользователя
     * @param array $params смотри описание updateField()
     * @return bool успешно ли произошла запись
     */
    public function updateField($params = []) {
        return InfoPagesHelper::updateField($params);
    }

    public function rules() {
        return InfoPagesHelper::rules();
    }
}
