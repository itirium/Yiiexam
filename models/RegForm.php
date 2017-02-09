<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;
use Yii;
use app\models\User;

class RegForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $status;
    public function rules()
    {
        return [
            [['username', 'email', 'password'],'filter', 'filter' => 'trim'],
            [['username', 'email', 'password'],'required'],
            ['username', 'string', 'min' => 4, 'max' => 255],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Гасла різні." ],
            ['username', 'unique',
                'targetClass' => User::className(),
                'message' => 'Це ім`я вже зайнято.'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Ця поштова скринька вже зайнята.'],
            ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' =>[
                User::STATUS_NOT_ACTIVE,
                User::STATUS_ACTIVE
            ]],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Ім`я користувача',
            'email' => 'Поштова скринька',
            'password' => 'Гасло',
            'password_repeat' => 'Повторіть Гасло'
        ];
    }
    public function reg()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}