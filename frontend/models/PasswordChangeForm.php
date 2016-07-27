<?php

namespace frontend\models;

use Yii;
use common\models\User;
use vova07\fileapi\behaviors\UploadBehavior;
use yii\base\Model;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $secondname
 * @property string $phone
 * @property integer $city_id
 * @property string $birthday
 * @property string $about
 * @property string $photo
 * @property integer $sex
 * @property string $auth_key
 * @property string $email_activation_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property string $vk_id
 * @property string $fb_id
 * @property string $mr_id
 * @property string $ok_id
 * @property string $li_id
 * @property string $gg_id
 * @property integer $activated
 * @property integer $created
 * @property integer $updated
 * @property integer $deleted
 */
class PasswordChangeForm extends Model
{

    public $password;
    public $passwordRepeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password'], 'string', 'min' => 6],
            [['password', 'passwordRepeat'], 'required'],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => Yii::t('user', 'New Password'),
            'passwordRepeat' => Yii::t('user', 'Password Repeat'),
        ];
    }

    public function changePassword()
    {
        if ($this->validate()) {
            $user = User::findOne(Yii::$app->user->id);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user = $user->save();
            return $user;
        }
        return null;
    }


}
