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

    public function getPostData() {
        $name = get_class(InfoPagesHelper::getModel());
        return $_POST[$name];
    }
    /**
     * Обновление параметра пользователя
     * @param array $params смотри описание updateField()
     * @return bool успешно ли произошла запись
     */
    public function updateField($params = []) {
        return InfoPagesHelper::updateField($params);
    }

    public function delete($id) {
        return InfoPagesHelper::delete($id);
    }

    public function rules() {
        return InfoPagesHelper::rules();
    }

    /**
     * Сохарение или создание нового пользователь
     * @param array $data исходные данные
     * @return bool|array массив данных пользователя или false
     */
    public function save($data) {
        return InfoPagesHelper::save($data);
    }
}
