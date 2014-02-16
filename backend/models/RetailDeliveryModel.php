<?php

/**
 * Управление точками доставки для розницы
 *
 */
class RetailDeliveryModel extends CFormModel {

    /**
     * Получить дата провайдера
     * @param null|array $criteria [опционально] дополнительные параметры критерии (по умолчанию null)
     * @return CActiveDataProvider
     */
    public function getDataProvider($criteria = null) {
        return RetailDeliveryHelper::getDataProvider($criteria);
    }

    public function getErrors($attributes = null) {
        return RetailDeliveryHelper::getErrors($attributes);
    }

    /**
     * Сохарение или создание нового пользователь
     * @param array $data исходные данные
     * @return bool|array массив данных пользователя или false
     */
    public function save($data) {
        return RetailDeliveryHelper::save($data);
    }

    public function getPostData() {
        $name = get_class(RetailDeliveryHelper::getModel());
        return $_POST[$name];
    }

    /**
     * Обновление параметра пользователя
     * @param array $params смотри описание updateField()
     * @return bool успешно ли произошла запись
     */
    public function updateField($params = []) {
        return RetailDeliveryHelper::updateField($params);
    }

    /**
     * АР модель пользователя на основе id
     * @param int $id id пользователя
     * @param string $scenario сценарий для правил
     * @return RetailDelivery
     */
    public function getUser($id, $scenario = null) {
        return RetailDeliveryHelper::getUser($id, $scenario);
    }

    public function delete($id) {
        return RetailDeliveryHelper::delete($id);
    }
}
