<?php
/**
 * TODO: Migration description
 *
 * @package migrations
 */
class m140217_093821_create_new_options extends CDbMigration
{

	public function up()
	{
        $this->execute("CREATE TABLE `products_new_options_values` (
              `products_options_values_id` int(11) unsigned NOT NULL,
              `language_id` int(11) unsigned NOT NULL,
              `products_options_values_name` varchar(255),
              `products_options_values_thumbnail` varchar(255),
              `products_new_options_values_name` varchar(255)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8
        ");

	}

	public function down() 
	{

        $this->dropTable('products_new_options_values');
	}

}

