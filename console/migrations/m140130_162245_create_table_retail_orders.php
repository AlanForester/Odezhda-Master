<?php
/**
 * Creating table retail_orders
 *
 * @package migrations
 */
class m140130_162245_create_table_retail_orders extends CDbMigration
{

    public function up()
    {
        $this->execute("CREATE TABLE `retail_orders` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `orders_id` int(11) unsigned DEFAULT NULL,
              /* при выгрузке в опт orders_id становится равен id
              нового оптового заказа 'Розничные заказы' из orders, у которого customers_id всегда 22713 */

              `delivery_points_id` int(11) unsigned DEFAULT NULL,
              `retail_orders_statuses_id` tinyint(2) unsigned DEFAULT '0',

              /* Следующие 3 поля под вопросом (связи заказа с адресами).
              В идеале далее должны остаться только они вместо последующих полей. */
              /*`address_id` int(11) unsigned NOT NULL,
              `delivery_address_id` int(11) unsigned NOT NULL,
              `billing_address_id` int(11) unsigned NOT NULL,*/

              `person_type` tinyint(1) NOT NULL DEFAULT '0',  /* юр.или физ.лицо */
              `customers_id` int(11) NOT NULL DEFAULT '0',
              `customers_groups_id` int(11) NOT NULL DEFAULT '0',
              `customers_name` varchar(64) NOT NULL,
              `customers_company` varchar(255) DEFAULT NULL,
              `customers_street_address` varchar(64) NOT NULL,
              `customers_suburb` varchar(255) DEFAULT NULL,
              `customers_city` varchar(255) NOT NULL,
              `customers_postcode` varchar(10) NOT NULL,
              `customers_state` varchar(255) DEFAULT NULL,
              `customers_country` varchar(255) NOT NULL,
              `customers_telephone` varchar(255) NOT NULL,
              `customers_email_address` varchar(96) NOT NULL,
              `customers_address_format_id` int(5) NOT NULL DEFAULT '0',
              `delivery_name` varchar(64) NOT NULL,
              `delivery_middlename` varchar(128) DEFAULT NULL,
              `delivery_lastname` varchar(255) NOT NULL,
              `delivery_passport_serie` varchar(10) DEFAULT NULL,
              `delivery_passport_number` varchar(20) DEFAULT NULL,
              `delivery_passport_issue_organization` text,   /* кем выдан */
              `delivery_passport_issue_date` date NOT NULL,  /* когда выдан */
              `delivery_company` varchar(255) DEFAULT NULL,
              `delivery_street_address` varchar(64) NOT NULL,
              `delivery_suburb` varchar(255) DEFAULT NULL,
              `delivery_city` varchar(255) NOT NULL,
              `delivery_postcode` varchar(10) NOT NULL,
              `delivery_state` varchar(255) DEFAULT NULL,
              `delivery_country` varchar(255) NOT NULL,
              `delivery_address_format_id` int(5) NOT NULL DEFAULT '0',
              `billing_name` varchar(64) NOT NULL,
              `billing_company` varchar(255) DEFAULT NULL,
              `billing_street_address` varchar(64) NOT NULL,
              `billing_suburb` varchar(255) DEFAULT NULL,
              `billing_city` varchar(255) NOT NULL,
              `billing_postcode` varchar(10) NOT NULL,
              `billing_state` varchar(255) DEFAULT NULL,
              `billing_country` varchar(255) NOT NULL,
              `billing_address_format_id` int(5) NOT NULL DEFAULT '0',
              `payment_method` varchar(255) NOT NULL,
              `payment_info` text,
              `cc_type` varchar(20) DEFAULT NULL,
              `cc_owner` varchar(64) DEFAULT NULL,
              `cc_number` varchar(255) DEFAULT NULL,
              `cc_expires` varchar(4) DEFAULT NULL,
              `last_modified` datetime DEFAULT NULL,
              `date_purchased` datetime DEFAULT NULL,
              `act_date` date DEFAULT NULL,
              `booker_orders_id` int(11) NOT NULL DEFAULT '1',
              `act_number` int(11) NOT NULL DEFAULT '0',
              `orders_status` int(5) NOT NULL DEFAULT '0',
              `orders_date_finished` datetime DEFAULT NULL,
              `currency` char(3) DEFAULT NULL,
              `currency_value` decimal(14,6) DEFAULT NULL,
              `customers_referer_url` varchar(255) DEFAULT NULL,
              `customers_fax` varchar(255) DEFAULT NULL,
              `shipping_module` varchar(255) DEFAULT NULL,
              `referer` varchar(200) DEFAULT NULL,
              `print_torg` varchar(1) NOT NULL DEFAULT 'b',
              `default_provider` tinyint(4) NOT NULL DEFAULT '0',
              `seller_id` int(16) NOT NULL DEFAULT '0',
              `orders_discont` decimal(15,0) DEFAULT '0',
              `orders_discont_comment` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `date_purchased` (`date_purchased`,`booker_orders_id`,`default_provider`),
              CONSTRAINT `retail_orders_ibfk_1` FOREIGN KEY (`delivery_points_id`) REFERENCES `delivery_points` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
              CONSTRAINT `retail_orders_ibfk_2` FOREIGN KEY (`retail_orders_statuses_id`) REFERENCES `retail_orders_statuses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    public function down()
    {
        $this->dropTable('retail_orders');
    }

}

