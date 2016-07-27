<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_165716_create_feedback_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'subject' => $this->string(),
            'body' => $this->text(),
            'manager_email' => $this->string(),
            'status' => $this->integer(),

            'created' => $this->integer(),
            'updated' => $this->integer(),
            'created_user_id' => $this->integer(),
            'updated_user_id' => $this->integer(),

        ], $tableOptions);

        $this->batchInsert('{{%feedback}}',
            ['name', 'email', 'body','manager_email', 'created', 'updated', 'status'],
            [
                ['Иван', 'ivan@gmail.com', 'Сообщени от Ивана', 'manager@yii2cms.com', time(), time(), 1],
                ['Петр', 'petr@gmail.com', 'Сообщени от Петра', 'manager@yii2cms.com', time(), time(), 2],
                ['Вася', 'vasya@gmail.com', 'Сообщени от Васи', 'manager@yii2cms.com', time(), time(), 2],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%feedback}}');
    }
}
