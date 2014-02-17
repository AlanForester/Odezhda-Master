<?php
/**
 * Таблица банеров для розницы
 *
 * @package migrations
 */
class m140217_015118_create_retail_banners extends CDbMigration
{

    public function up()
    {
        $this->execute("CREATE TABLE `retail_banners` (
              `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `url` varchar(255) NOT NULL,
              `images` varchar(255) NOT NULL,
              `description` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    public function down()
    {
        $this->dropTable('retail_banners');
    }

}