<?php

use yii\db\Schema;
use yii\db\Migration;

class m160121_180909_create_text_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%text}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(),
            'value' => $this->text(),
            'lang_id' => $this->smallInteger(),
            'created' => $this->integer(),
            'updated' => $this->integer(),
            'created_user_id' => $this->integer(),
            'updated_user_id' => $this->integer(),

        ], $tableOptions);

        $this->batchInsert('{{%text}}',
            ['key', 'value'],
            [
                ['email', 'info@aetz.kz'],
                ['address', 'ул. Орлыколь 2/1, Астана'],
                ['phone', '+7 (7172) 57 06 70'],
                ['copyright', '© 2016. Все права защищены, www.aetz.kz, Астанинский электротехнический завод '],
                ['main_article', '<div class="video"><iframe width="100%" height="100%" src="https://www.youtube.com/embed/6Z6sSijyBaE" frameborder="0" allowfullscreen></iframe></div><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable...</p>'],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%text}}');
    }
}
