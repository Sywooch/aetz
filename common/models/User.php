<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $password;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['password'], 'string'],
            [['role'], 'integer'],
            [['activated', 'sex'], 'boolean'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }


    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }


    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }


    public function scenarios()
    {
        return [
            'social' => ['firstname', 'lastname', 'email', 'sex', 'photo', 'birthday', 'fb_id', 'vk_id', 'gg_id', 'li_id', 'mr_id', 'tw_id', 'ok_id', 'activated'],
            'default' => ['firstname', 'lastname', 'secondname', 'email', 'sex', 'photo', 'birthday', 'activated', 'phone', 'password', 'city_id', 'about'],
        ];
    }
    

    public function getId()
    {
        return $this->getPrimaryKey();
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }


    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }


    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }


    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'password' => Yii::t('app', 'Password'),
            'lastname' => Yii::t('app', 'Lastname'),
            'secondname' => Yii::t('app', 'Secondname'),
            'phone' => Yii::t('app', 'Phone'),
            'city_id' => Yii::t('app', 'City ID'),
            'birthday' => Yii::t('app', 'Birthday'),
            'BirthdayDay' => Yii::t('app', 'Birthday'),
            'BirthdayMonth' => Yii::t('app', 'Birthday'),
            'BirthdayYear' => Yii::t('app', 'Birthday'),
            'photo' => Yii::t('app', 'Photo'),
            'about' => Yii::t('app', 'About'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'role' => Yii::t('app', 'Role'),
            'views' => Yii::t('app', 'Views'),
            'activated' => Yii::t('app', 'Activated'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }

}
