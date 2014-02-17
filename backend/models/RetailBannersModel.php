<?php

/**
 * Управление баннерами для розницы
 *
 */
class RetailBannersModel extends CFormModel {

    /**
     * Получить дата провайдера
     * @param null|array $criteria [опционально] дополнительные параметры критерии (по умолчанию null)
     * @return CActiveDataProvider
     */
    public function getDataProvider($criteria = null) {
        return RetailBannersHelper::getDataProvider($criteria);
    }

    public function getErrors($attributes = null) {
        return RetailBannersHelper::getErrors($attributes);
    }

    /**
     * Сохарение или создание нового пользователь
     * @param array $data исходные данные
     * @return bool|array массив данных пользователя или false
     */
    public function save($data) {
        return RetailBannersHelper::save($data);
    }

    public function getPostData() {
        $name = get_class(RetailBannersHelper::getModel());
        return $_POST[$name];
    }

    /**
     * Обновление параметра пользователя
     * @param array $params смотри описание updateField()
     * @return bool успешно ли произошла запись
     */
    public function updateField($params = []) {
        return RetailBannersHelper::updateField($params);
    }

    /**
     * АР модель пользователя на основе id
     * @param int $id id пользователя
     * @param string $scenario сценарий для правил
     * @return RetailBanners
     */
    public function getBanner($id, $scenario = null) {
        return RetailBannersHelper::getBanner($id, $scenario);
    }

    public function delete($id) {
        return RetailBannersHelper::delete($id);
    }
}
