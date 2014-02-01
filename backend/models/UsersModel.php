<?php

/**
 * Class UsersModel - работа с пользователями
 *
 */
class UsersModel extends CFormModel {

    /**
     * Получить дата провайдера
     * @param null|array $criteria [опционально] дополнительные параметры критерии (по умолчанию null)
     * @return CActiveDataProvider
     */
    public function getDataProvider($criteria = null) {
        return UsersHelper::getDataProvider($criteria);
    }

    //    public function rules() {
    //        return UsersLayer::rules();
    //    }
    //
    //    public function validate($attributes = null, $clearErrors = true) {
    //        return UsersLayer::validate($attributes, $clearErrors);
    //    }

    public function getErrors($attributes = null) {
        return UsersHelper::getErrors($attributes);
    }

    /**
     * Сохарение или создание нового пользователь
     * @param array $data исходные данные
     * @return bool|array массив данных пользователя или false
     */
    public function save($data) {
        return UsersHelper::save($data);
    }

    public function getPostData() {
        $name = get_class(UsersHelper::getModel());
        //        print_r($_POST[$name]);exit;
        return $_POST[$name];
    }

    /**
     * Обновление параметра пользователя
     * @param array $params смотри описание updateField()
     * @return bool успешно ли произошла запись
     */
    public function updateField($params = []) {
        return UsersHelper::updateField($params);
    }

    /**
     * АР модель пользователя на основе id
     * @param int $id id пользователя
     * @param string $scenario сценарий для правил
     * @return User
     */
    public function getUser($id, $scenario = null) {
        return UsersHelper::getUser($id, $scenario);
    }

    /**
     * Данные пользователя в виде массива
     * @param int $id id пользователя
     * @param string $scenario сценарий для правил
     * @return bool|array массив или false
     */
    //    public function getUserData($id, $scenario) {
    //        $user = self::getUser($id, $scenario);
    //        return ($user ? UsersLayer::fieldMapConvert($user->attributes) : false);
    //    }

    public function delete($id) {
        return UsersHelper::delete($id);
    }


}
