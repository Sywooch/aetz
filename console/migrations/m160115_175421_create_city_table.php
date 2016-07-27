<?php

use yii\db\Schema;
use yii\db\Migration;

class m160115_175421_create_city_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer(),

            'latitude' => $this->double(),
            'longitude' => $this->double(),

            'title' => $this->string(),
            'is_published' => $this->smallInteger()->defaultValue(0),

        ], $tableOptions);


        $this->batchInsert('{{%city}}',
            ['title', 'country_id', 'is_published', 'latitude', 'longitude'],
            [
                ['Алматы', '1', '1', '43.238253', '76.945465'],
                ['Астана', '1', '1', '51.128422', '71.430564'],
                ['Актау', '1', '1', '43.635379', '51.169135'],
                ['Актобе', '1', '1', '50.300411', '57.154636'],
                ['Атырау', '1', '1', '47.105241', '51.910101'],
                ['Жезказган', '1', '1', '47.800225', '67.713605'],
                ['Караганда', '1', '1', '49.806406', '73.085485'],
                ['Кокшетау', '1', '1', '53.284635', '69.377554'],
                ['Костанай', '1', '1', '53.214917', '63.631031'],
                ['Кызылорда', '1', '1', '44.83986', '65.50268'],
                ['Павлодар', '1', '1', '52.285577', '76.940947'],
                ['Петропавловск', '1', '1', '54.865472', '69.135602'],
                ['Семей', '1', '1', '50.416526', '80.25617'],
                ['Талдыкорган', '1', '1', '45.018028', '78.383596'],
                ['Тараз', '1', '1', '42.901183', '71.378309'],
                ['Уральск', '1', '1', '51.212173', '51.367069'],
                ['Усть-Каменогорск', '1', '1', '49.948759', '82.628459'],
                ['Шымкент', '1', '1', '42.317301', '69.589709'],
            ]);
    }

    public function down()
    {
        $this->dropTable('{{%city}}');
    }


}
