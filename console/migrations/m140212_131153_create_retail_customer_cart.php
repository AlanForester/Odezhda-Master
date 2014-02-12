<?php
/**
 * TODO: Migration description
 *
 * @package migrations
 */
class m140212_131153_create_retail_customer_cart extends CDbMigration
{

	public function safeUp()
	{
        $this->execute("CREATE TABLE `retail_customer_cart` (
              `customers_id` int(11) unsigned NOT NULL,
              `products_id` int(11) unsigned NOT NULL,
              `products_count` int(11) unsigned NOT NULL,
              `products_params` varchar(255) NOT NULL,
              `date_added` date NOT NULL
              )
        ");
	}

	public function safeDown()
	{
        $this->dropTable('retail_customer_cart');
	}

}

