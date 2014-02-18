<?php

/**
 * Управление баннерами для розницы
 *
 */
class SizeModel extends CFormModel {

    /**
     * Получить дата провайдера
     * @param null|array $criteria [опционально] дополнительные параметры критерии (по умолчанию null)
     * @return CActiveDataProvider
     */

    public function getDataProvider($criteria = null) {
        return SizeHelper::getDataProvider($criteria);
    }

    public function getErrors($attributes = null) {
        return SizeHelper::getErrors($attributes);
    }

    /**
     * Сохарение или создание нового пользователь
     * @param array $data исходные данные
     * @return bool|array массив данных пользователя или false
     */
    public function save($data) {
        return SizeHelper::save($data);
    }

    public function getPostData() {
        $name = get_class(SizeHelper::getModel());
        return $_POST[$name];
    }

    /**
     * Обновление параметра пользователя
     * @param array $params смотри описание updateField()
     * @return bool успешно ли произошла запись
     */
    public function updateField($params = []) {
        return SizeHelper::updateField($params);
    }

    /**
     * АР модель пользователя на основе id
     * @param int $id id пользователя
     * @param string $scenario сценарий для правил
     * @return Size
     */
    public function getId($id, $scenario = null) {
        return SizeHelper::getId($id, $scenario);
    }

    public function delete($id) {
        return SizeHelper::delete($id);
    }
}
