<?php

namespace common\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['name','email','password'], 'required'],
            [['name'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass'=>'common\models\User', 'targetAttribute'=>'email']
        ];
    }

    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->create();

            $userRole = new UserRole();
            $userRole->user_id = $user->id;
            $userRole->role_id = Role::findOne('User')->id;
            $userRole->create();

            return true;
        }
    }
}
