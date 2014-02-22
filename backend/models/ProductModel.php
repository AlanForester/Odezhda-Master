<?php

/**
 * Управление баннерами для розницы
 *
 */
class ProductModel extends CFormModel {

    /**
     * Получить дата провайдера
     * @param null|array $criteria [опционально] дополнительные параметры критерии (по умолчанию null)
     * @return CActiveDataProvider
     */

    public function getDataProvider($criteria = null) {
        return ProductHelper::getDataProvider($criteria);
    }

    public function getErrors($attributes = null) {
        return ProductHelper::getErrors($attributes);
    }

    /**
     * Сохарение или создание нового пользователь
     * @param array $data исходные данные
     * @return bool|array массив данных пользователя или false
     */
    public function save($data) {
        return ProductHelper::save($data);
    }

    public function getPostData() {
        $name = get_class(ProductHelper::getModel());
        return $_POST[$name];
    }

    /**
     * Обновление параметра пользователя
     * @param array $params смотри описание updateField()
     * @return bool успешно ли произошла запись
     */
    public function updateField($params = []) {
        return ProductHelper::updateField($params);
    }

    public function getOldOptionsList(){
        return ProductHelper::getOldOptionsList();
    }

    /**
     * АР модель пользователя на основе id
     * @param int $id id пользователя
     * @param string $scenario сценарий для правил
     * @return Product
     */
    public function getId($id, $scenario = null) {
        return ProductHelper::getId($id, $scenario);
    }

    public function delete($id) {
        return ProductHelper::delete($id);
    }
}
