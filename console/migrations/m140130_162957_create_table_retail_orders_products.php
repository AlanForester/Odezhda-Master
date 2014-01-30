<?php
/**
 * Create table retail_orders_products
 *
 * @package migrations
 */
class m140130_162957_create_table_retail_orders_products extends CDbMigration
{

    public function up()
    {
        $this->execute("CREATE TABLE `retail_orders_products` (
              `retail_orders_products_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `retail_orders_id` int(11) unsigned NOT NULL DEFAULT '0',
              `products_id` int(11) NOT NULL DEFAULT '0',

              `retail_sub_orders_id` int(11) unsigned DEFAULT NULL,
              `products_model` varchar(255) DEFAULT NULL,
              `products_name` varchar(255) NOT NULL,
              `products_price` decimal(15,4) NOT NULL DEFAULT '0.0000',
              `final_price` decimal(15,4) NOT NULL DEFAULT '0.0000',
              `products_tax` decimal(7,4) NOT NULL DEFAULT '0.0000',
              `products_quantity` int(2) NOT NULL DEFAULT '0',
              `products_av` int(2) NOT NULL DEFAULT '1',
              `products_sort` varchar(20) NOT NULL DEFAULT '0',
              `priten` text,
              `checks` int(32) NOT NULL DEFAULT '0',
              `first_quant` int(16) NOT NULL DEFAULT '0',
              `products_status` tinyint(2) NOT NULL DEFAULT '0',
              `verification` int(128) NOT NULL DEFAULT '0',
              `comment` tinytext,
              PRIMARY KEY (`orders_products_id`),
              KEY `idx_retail_orders_products_orders_id` (`retail_orders_id`),
              KEY `idx_retail_orders_products_products_id` (`products_id`),
              KEY `idx_retail_sub_orders_id` (`retail_sub_orders_id`),
              CONSTRAINT `retail_orders_products_ibfk_1` FOREIGN KEY (`retail_orders_id`) REFERENCES `retail_orders` (`retail_orders_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    public function down()
    {
        $this->dropTable('retail_orders_products');
    }

}

