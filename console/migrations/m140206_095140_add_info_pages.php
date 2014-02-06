<?php
/**
 * TODO: Migration description
 *
 * @package migrations
 */
class m140206_095140_add_info_pages extends CDbMigration
{
    public $insertFields=[
        9=>'Как получить',
        10=>'Что с моим заказом?',
        11=>'Сервисы',
        12=>'О нас',
        13=>'Вакансии',
        14=>'Партнерам',
        15=>'Сертификаты',
        16=>'Наши скидки',
        17=>'Преимущества',
        18=>'Пункты самовывоза',
        19=>'Правила продажи',
        20=>'Франшиза',
    ];
	public function safeUp()
	{
        foreach ($this->insertFields as $id => $name){
            $this->insert('pages', [
                'pages_id' => $id,
                'pages_date_added' => new CDbExpression('NOW()'),
                'pages_last_modified' => new CDbExpression('NOW()'),
                'pages_status' => '1',
            ]);

            $this->insert('pages_description', [
                'pages_id' => $id,
                'language_id' => '1',
                'pages_name' => $name,
                'pages_description' => $name,
            ]);
        }
	}

	public function down() 
	{
        $fields = implode(",", array_keys($this->insertFields));
        $this->delete('pages', 'pages_id in ('.$fields.')');
        $this->delete('pages_description', 'pages_id in ('.$fields.')');
	}

}

