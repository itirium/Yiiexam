<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $rememberMe = true;
    public $status;
    private $_user = false;
    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'on' => 'default'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()):
            $user = $this->getUser();
            if (
                !$user ||
                !$user->validatePassword($this->password)):
                $this->addError($attribute, 'Невірне ім`я або гасло.');
            endif;
        endif;
    }
    public function getUser()
    {
        if ($this->_user === false):
            $this->_user = User::findByUsername($this->username);
        endif;
        return $this->_user;
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Ім`я користувача',
            'password' => 'Гасло',
            'rememberMe' => 'Запам`ятати мене'
        ];
    }
    public function login()
    {
        if ($this->validate()):
            $this->status = ($user = $this->getUser()) ? $user->status : User::STATUS_NOT_ACTIVE;
            if ($this->status === User::STATUS_ACTIVE):
                return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }
}
