<?php

use yii\db\Schema;
use yii\db\Migration;

class m160109_163949_create_example_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%example}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->defaultValue(0),
            'title' => $this->string(),
            'anounce' => $this->text(),
            'description' => $this->text(),
            'photo' => $this->string(),

            'views' => $this->integer()->defaultValue(0),
            'lang_id' => $this->smallInteger(),
            'is_published' => $this->smallInteger()->defaultValue(0),
            'sort_index' => $this->integer(),

            'created' => $this->integer(),
            'updated' => $this->integer(),
            'created_user_id' => $this->integer(),
            'updated_user_id' => $this->integer(),

            'slug' => $this->string(),
            'meta_title' => $this->string(),
            'meta_keywords' => $this->string(),
            'meta_description' => $this->string(),

        ], $tableOptions);

        $this->batchInsert('{{%example}}',
            ['title', 'anounce', 'description', 'photo','created', 'updated', 'slug','is_published'],
            [
                ['Образец 1', 'Анонс контента' , 'Описание контента' , 'example.png', time(), time(), 'example-1', 1],
                ['Образец 2', 'Анонс контента' , 'Описание контента' , 'example.png', time(), time(), 'example-2', 1],
                ['Образец 3', 'Анонс контента' , 'Описание контента' , 'example.png', time(), time(), 'example-3', 1],
                ['Образец 4', 'Анонс контента' , 'Описание контента' , 'example.png', time(), time(), 'example-4', 1],
                ['Образец 5', 'Анонс контента' , 'Описание контента' , 'example.png', time(), time(), 'example-5', 1],
                ['Образец 6', 'Анонс контента' , 'Описание контента' , 'example.png', time(), time(), 'example-6', 1],
                ['Образец 7', 'Анонс контента' , 'Описание контента' , 'example.png', time(), time(), 'example-7', 1],
                ['Образец 8', 'Анонс контента' , 'Описание контента' , 'example.png', time(), time(), 'example-8', 1],
                ['Образец 9', 'Анонс контента' , 'Описание контента' , 'example.png', time(), time(), 'example-9', 1],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%example}}');
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
