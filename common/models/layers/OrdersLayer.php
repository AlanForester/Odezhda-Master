<?php
//более не используется, см. Orders
class OrdersLayer extends OrdersLegacy {
    /**
     * @var array (поле БД => требуемое поле для модели)
     */
    private static $field_map = [
        'orders_id' => 'id',
        'ur_or_fiz' => 'person_type',
        /*'customers_id' => 'customers_id',
        'customers_groups_id' => 'customers_groups_id',
        'customers_name' => 'customers_name',
        'customers_company' => 'customers_company',
        'customers_street_address' => 'customers_street_address',
        'customers_suburb' => 'customers_suburb',
        'customers_city' => 'customers_city',
        'customers_postcode' => 'customers_postcode',
        'customers_state' => 'customers_state',
        'customers_country' => 'customers_country',
        'customers_telephone' => 'customers_telephone',
        'customers_email_address' => 'customers_email_address',
        'customers_address_format_id' => 'customers_address_format_id',*/
        'delivery_adress_id' => 'delivery_address_id',
        /*'delivery_name' => 'delivery_name',
        'delivery_lastname' => 'delivery_lastname',*/
        'delivery_otchestvo' => 'delivery_middlename',
        'delivery_pasport_seria' => 'delivery_passport_serie',
        'delivery_pasport_nomer' => 'delivery_passport_number',
        'delivery_pasport_kem_vidan' => 'delivery_passport_issue_organization',
        'delivery_pasport_kogda_vidan' => 'delivery_passport_issue_date',
        /*'delivery_company' => 'delivery_company',
        'delivery_street_address' => 'delivery_street_address',
        'delivery_suburb' => 'delivery_suburb',
        'delivery_city' => 'delivery_city',
        'delivery_postcode' => 'delivery_postcode',
        'delivery_state' => 'delivery_state',
        'delivery_country' => 'delivery_country',
        'delivery_address_format_id' => 'delivery_address_format_id',
        'billing_name' => 'billing_name',
        'billing_company' => 'billing_company',
        'billing_street_address' => 'billing_street_address',
        'billing_suburb' => 'billing_suburb',
        'billing_city' => 'billing_city',
        'billing_postcode' => 'billing_postcode',
        'billing_state' => 'billing_state',
        'billing_country' => 'billing_country',
        'billing_address_format_id' => 'billing_address_format_id',
        'payment_method' => 'payment_method',
        'payment_info' => 'payment_info',
        'cc_type' => 'cc_type',
        'cc_owner' => 'cc_owner',
        'cc_number' => 'cc_number',
        'cc_expires' => 'cc_expires',
        'last_modified' => 'last_modified',
        'date_purchased' => 'date_purchased',*/
        'date_akt' => 'act_date',
        'buh_orders_id' => 'booker_orders_id',
        'nomer_akt' => 'act_number',
        /*'orders_status' => 'orders_status',
        'orders_date_finished' => 'orders_date_finished',
        'currency' => 'currency',
        'currency_value' => 'currency_value',
        'customers_fax' => 'customers_fax',
        'customers_referer_url' => 'customers_referer_url',
        'shipping_module' => 'shipping_module',
        'referer' => 'referer',
        'print_torg' => 'print_torg',    //?
        'default_provider' => 'default_provider',
        'seller_id' => 'seller_id',
        'orders_discont' => 'orders_discont',
        'orders_discont_comment' => 'orders_discont_comment',*/
    ];

    //public static $errors = [];

    /**
     * @param $row массив соответствий
     * @param bool $reverse конвертировать в прямую или обратную сторону(по умолчанию -  прямую)
     * @return mixed конвертированный по ключам массив
     *
     */
    public static function fieldMapConvert($row, $reverse = false) {
        if (!$reverse) {
            foreach (self::$field_map as $k => $v) {
                if (array_key_exists($k, $row)) {
                    $row[$v] = $row[$k];
                    unset($row[$k]);
                }
            }
        } else {
            foreach (self::$field_map as $k => $v) {
                if (isset ($row[$v])) {
                    $row[$k] = $row[$v];
                    unset($row[$v]);
                }
            }
        }

        return $row;
    }

    public static function getFieldName($field, $direct = true) {
        if ($direct) {
            // old => new
            return (array_key_exists($field, self::$field_map) ? self::$field_map[$field] : $field);
        } else {
            // new => old
            return (array_search($field, self::$field_map) ? : $field);
        }
    }

    public static function getList() {
        $result = [];
        $list = OrdersLegacy::model()->findAll();
        foreach ($list as $val) {
            $result[] = self::fieldMapConvert($val->attributes);
        }

        return $result;
    }

    /*public function setAttributes($values,$safeOnly=true)
    {
        return parent::setAttributes(self::fieldMapConvert($values, true), $safeOnly);
    }*/

    /**
     * данные для валидации для внешнего использования
     */
    public function rules() {
        $rules = parent::model()->rules();
        foreach ($rules as &$r) {
            $r[0] = join(
                ',',
                array_map(
                    function ($el) {
                        return self::getFieldName(trim($el));
                    }, explode(',', $r[0])
                )
            );
        }

        return $rules;
    }

    /*protected function afterFind()
    {
        parent::afterFind();
        //$this->setAttributes(self::fieldMapConvert($this->getAttributes(),true));
    }

    protected function afterSave() {
        parent::afterSave();

    }*/

    public function fieldMap() {
        return self::$field_map;
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}