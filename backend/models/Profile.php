<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;


class Profile extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $role;
    public $status;

    public function rules()
    {
        return [

            [['firstname', 'lastname','email'], 'required'],
            [['password'], 'required', 'on' => 'default'],
            [['firstname', 'lastname', 'password'], 'string' ],
            [['role','status'], 'integer' ],

            // email has to be a valid email address
            ['email', 'email'],

        ];
    }

    public function scenarios()
    {
        return [
            'default' => ['firstname', 'lastname', 'email', 'status', 'role' ,'password'],
            'change' => ['firstname', 'lastname', 'email', 'status','role'],
        ];
    }


    public function saveProfile(){
        if ($this->validate()) {
            $user = new User();
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->email = $this->email;
            $user->role = $this->role;
            $user->status = $this->status;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }
        return null;
    }

    public function changeProfile($id)
    {
        if ($this->validate()) {
            $user = User::findOne($id);
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->email = $this->email;
            $user->role = $this->role;
            $user->status = $this->status;
            if($user->save()){
                return true;
            }
            return false;
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'photo' => Yii::t('app', 'Change photo'),
            'lastname' => Yii::t('app', 'Lastname'),
            'firstname' => Yii::t('app', 'Firstname'),
            'password' => Yii::t('app', 'Password'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
        ];
    }


}
