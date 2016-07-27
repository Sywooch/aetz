<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_190015_create_settings_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(),
            'value' => $this->string(),
            'comment' => $this->string(),
            'created' => $this->integer(),
            'updated' => $this->integer(),
            'created_user_id' => $this->integer(),
            'updated_user_id' => $this->integer(),

        ], $tableOptions);

        $this->batchInsert('{{%settings}}',
            ['key', 'value', 'comment'],
            [
                ['manager_email', 'manager@greengo.kz', 'email for feedback'],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');
    }
}
