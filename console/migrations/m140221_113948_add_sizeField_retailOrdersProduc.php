<?php
/**
 * TODO: Migration description
 *
 * @package migrations
 */
class m140221_113948_add_sizeField_retailOrdersProduc extends CDbMigration
{

	public function up() 
	{
        $this->execute("ALTER TABLE `retail_orders_products` ADD `params` varchar(255) NOT NULL COMMENT 'Размер товара';");

	}

	public function down() 
	{
        $this->execute("ALTER TABLE  `retail_orders_products` DROP  `size`;");
	}

}

