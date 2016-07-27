<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%text}}".
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
class Text extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%text}}';
    }


    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['created', 'updated', 'created_user_id', 'updated_user_id', 'lang_id'], 'integer'],
            [['key'], 'string', 'max' => 255],
            [['value'], 'string'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'lang_id' => Yii::t('app', 'Lang'),
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

        $text = Text::find()->where(['key' => $key])->one();
        return ($text) ? $text->value : '';

    }

}
