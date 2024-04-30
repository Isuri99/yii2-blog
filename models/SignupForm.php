<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model
{

    public $username;
    public $password;
    public $password_repeat;


    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat'], 'required'],
            [['username', 'password'],'string', 'min'=>4, 'max'=>16],
            ['password_repeat', 'compare','compareAttribute'=>'password'],

                //inline validator defined as an anonymous function
           ['username', function ($attribute, $params, $validator) {

                $existingUser = User::find()->where(['username' => $this->$attribute])->one();
                if ($existingUser !== null){
                    $this->addError($attribute, 'Username "' .$this->$attribute . '" is already taken. ');
                }


            }]
        ];
    }

    public function signup()
    {

        $user = new User();
        $user->username = $this->username;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->access_token = \Yii::$app->security->generateRandomString();
        $user->auth_key = \Yii::$app->security->generateRandomString();


        if ($user->save()){
          /* $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('author');
            $auth->assign($authorRole, $user->getId());*/
            return true;
        }
        \Yii::error("User was not saved.". VarDumper::dumpAsString($user->errors));

        return false;
    }
}