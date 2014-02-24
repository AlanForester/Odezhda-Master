<?php
/**
 * TODO: Migration description
 *
 * @package migrations
 */
class m140224_163150_create_table_retail_discount_cart extends CDbMigration
{

    public function up()
	{
        $this->execute("CREATE TABLE `retail_discount_cart` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT,
              `code` varchar(10) NOT NULL COMMENT  'Уникальный код',
              `status` int(2) NOT NULL DEFAULT '0' COMMENT  'Статус кода',
              `activated` DATE DEFAULT NULL COMMENT  'Дата активации',
              UNIQUE KEY `code` (`code`)
              )
        ");

	}

	public function down() 
	{
        $this->dropTable('retail_discount_cart');
	}

}

