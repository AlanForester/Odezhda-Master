<?php
/**
 * Create table delivery_points
 *
 * @package migrations
 */
class m140130_162049_create_table_delivery_points extends CDbMigration
{

    public function up()
    {
        $this->execute("CREATE TABLE `delivery_points` (
              `delivery_points_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
              `name` varchar(64) NOT NULL,
              `description` varchar(128) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    public function down()
    {
        $this->dropTable('delivery_points');
    }

}

