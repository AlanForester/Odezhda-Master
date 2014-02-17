<?php

/**
 * Уставка демо-данных в таблицу баннеров
 *
 * @package migrations
 */
class m140217_025208_insert_retail_banners extends CDbMigration {

    public function up() {

        $this->insert(
            'retail_banners',
            [
                'id' => '1',
                'name' => 'Баннер на главной 1',
                'url' => '/catalog/list/930',
                'images' => '/images/skidka1.jpg',
                'description' => null
            ]
        );

        $this->insert(
            'retail_banners',
            [
                'id' => '2',
                'name' => 'Баннер на главной 2',
                'url' => '/catalog/list/930',
                'images' => '/images/skidka2.jpg',
                'description' => null
            ]
        );

        $this->insert(
            'retail_banners',
            [
                'id' => '3',
                'name' => 'Баннер на главной 3',
                'url' => '/catalog/list/930',
                'images' => '/images/skidka3.jpg',
                'description' => null
            ]
        );

    }

    public function down() {
        $this->delete('retail_banners', 'id in (1,2,3)');
    }

}

