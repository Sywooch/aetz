<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $comment
 * @property integer $created
 * @property integer $updated
 * @property integer $created_user_id
 * @property integer $updated_user_id
 */
class Settings extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%settings}}';
    }


    public function rules()
    {
        return [
            [['key', 'value', 'comment'], 'required'],
            [['created', 'updated', 'created_user_id', 'updated_user_id'], 'integer'],
            [['key', 'value', 'comment'], 'string', 'max' => 255]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'comment' => Yii::t('app', 'Comment'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'created_user_id' => Yii::t('app', 'Created User Id'),
            'updated_user_id' => Yii::t('app', 'Updated User Id'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                ],
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_user_id',
                'updatedByAttribute' => 'updated_user_id',
            ],
        ];

    }

    public function getValue($key) {

        $text = Settings::find()->where(['key' => $key])->one();
        return ($text) ? $text->value : '';

    }

}
