<?php

use yii\db\Schema;
use yii\db\Migration;

class m160108_194403_create_image_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),

            'filename' => $this->string(),
            'item_id' => $this->integer(),
            'is_main' => $this->smallInteger()->defaultValue(0),
            'model_name' => $this->string(),
            'title' => $this->string(),


        ], $tableOptions);

        $this->batchInsert('{{%image}}',
            ['filename', 'item_id', 'model_name'],
            [
                ['news.jpg', '1', 'news'],
                ['news.jpg', '1', 'news'],
                ['news.jpg', '1', 'news'],
                ['news.jpg', '1', 'news'],
                ['news.jpg', '1', 'news'],
                ['news.jpg', '1', 'news'],
                ['news.jpg', '1', 'news'],
                ['news.jpg', '1', 'news'],
                ['news.jpg', '1', 'news'],

                ['gallery1.jpg', '1', 'gallery'],
                ['gallery2.jpg', '1', 'gallery'],
                ['gallery3.jpg', '1', 'gallery'],
                ['gallery3.jpg', '1', 'gallery'],
                ['gallery2.jpg', '1', 'gallery'],
                ['gallery1.jpg', '1', 'gallery'],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%image}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
