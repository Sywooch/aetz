<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $subject
 * @property string $body
 * @property string $manager_email
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 * @property integer $updated_user_id
 */
class Feedback extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%feedback}}';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'body'], 'required'],
            [['body'], 'string'],
            [['status', 'created', 'updated', 'created_user_id', 'updated_user_id'], 'integer'],
            [['name', 'email', 'phone', 'subject', 'manager_email'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'subject' => Yii::t('app', 'Subject'),
            'body' => Yii::t('app', 'Body'),
            'manager_email' => Yii::t('app', 'Manager Email'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'updated_user_id' => Yii::t('app', 'Updated User Id'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created'],
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

    public function getManagerEmail(){
        return Settings::getValue('manager_email');
    }

    public function sendEmail()
    {
        $this->manager_email = $this->getManagerEmail();
        $this->save();

        return \Yii::$app->mailer->compose('feedback', [
            'username' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'body' => $this->body
        ])
            ->setFrom(\Yii::$app->params['adminEmail'])
            ->setTo($this->manager_email)
            ->send();
    }
}
