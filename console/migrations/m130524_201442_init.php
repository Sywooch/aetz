<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'firstname' => Schema::TYPE_STRING,
            'lastname' => Schema::TYPE_STRING,
            'secondname' => Schema::TYPE_STRING,
            'username' => Schema::TYPE_STRING,
            'auth_key' => Schema::TYPE_STRING,
            'password_hash' => Schema::TYPE_STRING,
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'phone' => Schema::TYPE_STRING,
            'city_id' => Schema::TYPE_INTEGER,
            'birthday' => Schema::TYPE_DATE,
            'sex' => Schema::TYPE_SMALLINT . ' DEFAULT 0',
            'role' => Schema::TYPE_SMALLINT . ' DEFAULT 0',

            'vk_id' => Schema::TYPE_STRING,
            'fb_id' => Schema::TYPE_STRING,
            'mr_id' => Schema::TYPE_STRING,
            'ok_id' => Schema::TYPE_STRING,
            'li_id' => Schema::TYPE_STRING,
            'gg_id' => Schema::TYPE_STRING,
            'tw_id' => Schema::TYPE_STRING,

            'activated' => Schema::TYPE_SMALLINT . ' DEFAULT 0',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated' => Schema::TYPE_INTEGER . ' NOT NULL',
            'deleted' => Schema::TYPE_SMALLINT . ' DEFAULT 0'

        ], $tableOptions);

        $this->batchInsert('{{%user}}',
            ['firstname', 'lastname', 'secondname', 'phone', 'city_id', 'birthday',  'auth_key', 'password_hash', 'email', 'role', 'activated', 'created', 'updated', 'deleted'],
            [
                ['Malika', 'Arabbay', 'Balataykizi', '87716252926', '3', '1991-02-07',  'KSIUVGQArA59pE-EZFY4CCD8MpvIOvE0', '$2y$13$wQeo.4DFTOlAn4f/bzwPnOymmn5k9ijj7a4eSB8QXEm30VIEiIqJu', 'malikarabbay@gmail.com', '10', '1', time(), time(), '0'],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
