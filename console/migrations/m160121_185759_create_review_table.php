<?php

use yii\db\Schema;
use yii\db\Migration;

class m160121_185759_create_review_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'model_name' => $this->string(),
            'model_id' => $this->integer(),
            'rating' => $this->double(),
            'review' => $this->text(),
            'created' => $this->integer(),
            'updated' => $this->integer(),
            'is_published' => $this->smallInteger()->defaultValue(0),
        ]);

        $this->batchInsert('{{%review}}',
            ['user_id', 'model_name', 'model_id', 'review', 'created', 'updated', 'is_published'],
            [
                ['1', 'product', '2', 'Отличный товар.', time(), time(), 1],
                ['2', 'product', '1', 'Хорошие цени.', time(), time(), 1 ]
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%review}}');
    }
}
