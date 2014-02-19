<?php
/**
 * TODO: Migration description
 *
 * @package migrations
 */
class m140219_140048_update_delivery_points extends CDbMigration
{

	public function up() 
	{
        $this->execute("ALTER TABLE  `delivery_points` ADD  `ispoint` INT NOT NULL DEFAULT
                        '1' COMMENT  'Точки выдачи заказа',
                        ADD  `ordering` INT NOT NULL DEFAULT  '0' COMMENT  'Позиция товара';
                       ");
        $this->execute("UPDATE  `delivery_points` SET  `ispoint` =  '0'
                        WHERE  `delivery_points`.`id` =5;
                       ");

	}

	public function down() 
	{

        $this->execute("ALTER TABLE  `delivery_points` DROP  `ispoint` ,
        DROP  `ordering` ;");
	}

}

