<?php
/**
 * TODO: Migration description
 *
 * @package migrations
 */
class m140217_045719_insert_retail_orders extends CDbMigration
{

	public function up() 
	{

        $this->insert(
            'delivery_points',
            [
                'id' => '5',
                'name' => 'Доставка постой России',
            ]
        );

	}

	public function down() 
	{

        $this->delete('delivery_points', 'id in (5)');
	}

}

