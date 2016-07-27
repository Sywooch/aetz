<?php

use yii\db\Schema;
use yii\db\Migration;

class m160109_190626_create_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(0),
            'model_name' => $this->string(),
            'title' => $this->string(),
            'description' => $this->text(),
            'icon' => $this->string(),
            'photo' => $this->string(),

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

        $this->batchInsert('{{%category}}',
            ['parent_id', 'model_name', 'title', 'description', 'created', 'updated', 'slug','is_published'],
            [
                [0, 'article', 'О компании', 'Описание контента', time(), time(), 'o_kompanii', 1],
                [0, 'article', 'Услуги', 'Описание контента', time(), time(), 'uslugi', 1],
                [0, 'product', 'Трансформаторные подстанции', 'Описание контента', time(), time(), 'transformatorniye', 1],
                [0, 'product', 'Распределительные устройства среднего напряжения', 'Описание контента', time(), time(), 'raspredeleniye', 1],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
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
