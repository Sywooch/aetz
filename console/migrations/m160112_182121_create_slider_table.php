<?php

use yii\db\Schema;
use yii\db\Migration;

class m160112_182121_create_slider_table extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->defaultValue(0),
            'title' => $this->string(),
            'anounce' => $this->text(),
            'description' => $this->text(),
            'photo' => $this->string(),
            'link' => $this->string(),

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

        $this->batchInsert('{{%slider}}',
            ['title', 'anounce', 'photo','created', 'updated', 'is_published'],
            [
                ['Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece oft has roots in a classical Latin literature from 45 BC, making itt has roots in a over 2000 years old. Richard McClintock, a Latin professor at' , 'slider1.jpg', time(), time(), 1],
                ['Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece oft has roots in a classical Latin literature from 45 BC, making itt has roots in a over 2000 years old. Richard McClintock, a Latin professor at' , 'slider1.jpg', time(), time(), 1],
                ['Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece oft has roots in a classical Latin literature from 45 BC, making itt has roots in a over 2000 years old. Richard McClintock, a Latin professor at' , 'slider1.jpg', time(), time(), 1],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%slider}}');
    }


}
