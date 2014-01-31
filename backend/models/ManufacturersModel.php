<?php

/**
 * Class GroupsModel - работа с группамми пользователей
 *
 */
class ManufacturersModel extends CFormModel {

    public $id;
    public $name;

    /**
     * @var array массив всех пользователей.
     * Значение каждого элемента массива - массив с атрибутами пользователя(поля из БД)
     */
    private $list = [];
    private $allGroups = [];





    public function getListAndParams($data) {
        if (!$this->allGroups) {

            $condition = [];
            $params = [];

            // фильтр по тексту
            if (!empty($data['text_search'])) {
                $condition[] = '(' . join(
                        ' OR ',  [ GroupsLayer::getFieldName('name', false) . ' LIKE :text']

                    ) . ')';

                $params[':text'] = '%' . $data['text_search'] . '%';
            }

            // поле и направление сортировки
            $order_direct = null;

            $order_field = GroupsLayer::getFieldName(!empty($data['order_field']) ? $data['order_field'] : 'name', false);
 /*           echo $data['order_field'];
            exit;*/

            if (isset($data['order_direct'])) {
                switch ($data['order_direct']) {
                    case 'up':
                        $order_direct = ' ASC';
                        break;
                    case 'down':
                        $order_direct = ' DESC';
                        break;
                }
            }

            $this->allGroups = GroupsLayer::getListAndParams(
                [
                    'condition' => join(' AND ', $condition),
                    'params' => $params,
                    'order' => $order_field . ($order_direct ? : '')
                ]
            );
        }
        return $this->allGroups;
    }





    /**
     * @return array задает возвращает массив всех групп пользователей
     */
    public function getList() {
        if (!$this->list) {
            $this->list = ManufacturersLayer::getList();
        }
        return $this->list;
    }


    public function getGroup($id, $scenario) {
        return GroupsLayer::getGroup($id, $scenario);
    }

    public function getGroupData($id, $scenario) {
        $group = self::getGroup($id, $scenario);
        return ($group ? GroupsLayer::fieldMapConvert($group->attributes) : false);
    }

    public function save($data) {
        return GroupsLayer::save($data);
    }

    public function rules() {
        return GroupsLayer::rules();
    }

    public function validate($attributes = null, $clearErrors = true) {
        return GroupsLayer::validate($attributes, $clearErrors);
    }

    public function getErrors($attributes = null) {
        return GroupsLayer::getErrors($attributes);
    }

    public function delete($id) {
        return GroupsLayer::delete($id);
    }

    public function updateField($params = []) {
        return GroupsLayer::updateField($params);
    }

}
