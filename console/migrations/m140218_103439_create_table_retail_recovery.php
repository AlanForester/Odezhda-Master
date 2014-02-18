<?php
/**
 * Миграция создания таблицы по васстановлению пользователя(забыл пароль)
 *
 * @package migrations
 */
class m140218_103439_create_table_retail_recovery extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("CREATE TABLE `retail_recovery` (
              `customer_id` int(11) unsigned NOT NULL,
              `hash` varchar(255) NOT NULL
              )
        ");
    }

    public function safeDown()
    {
        $this->dropTable('retail_recovery');
    }

}

