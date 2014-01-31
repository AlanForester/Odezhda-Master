<?php
/**
 * Create table retail_orders_statuses
 *
 * @package migrations
 */
class m140130_162144_create_table_retail_orders_statuses extends CDbMigration
{

    public function up()
    {
        $this->execute("CREATE TABLE `retail_orders_statuses` (
              `id` tinyint(2) unsigned NOT NULL,
              `name` varchar(64) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $this->execute("INSERT INTO `retail_orders_statuses` VALUES
              (0,'В корзине'),(1,'Оформлен'),(2,'Проверен оператором'),(3,'Собран'),(4,'Отправлен')");
    }

    public function down()
    {
        $this->dropTable('retail_orders_statuses');
    }

}

