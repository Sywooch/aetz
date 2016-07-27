<?php

use yii\db\Schema;
use yii\db\Migration;

class m160110_163005_create_gallery_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->defaultValue(0),
            'title' => $this->string(),
            'anounce' => $this->text(),
            'description' => $this->text(),
            'photo' => $this->string(),

            'views' => $this->integer()->defaultValue(0),
            'lang_id' => $this->integer(),
            'is_published' => $this->integer()->defaultValue(0),
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

        $this->batchInsert('{{%gallery}}',
            ['title', 'description', 'photo','created', 'updated', 'slug','is_published'],
            [
                ['Галерея 1', 'Описание контента' , 'gallery.jpg', time(), time(), 'gallery-1', 1],
                ['Галерея 2', 'Описание контента' , 'gallery.jpg', time(), time(), 'gallery-2', 1],
                ['Галерея 3', 'Описание контента' , 'gallery.jpg', time(), time(), 'gallery-3', 1],
                ['Галерея 4', 'Описание контента' , 'gallery.jpg', time(), time(), 'gallery-4', 1],
            ]
        );

    }

    public function down()
    {
        $this->dropTable('{{%gallery}}');
    }


}
