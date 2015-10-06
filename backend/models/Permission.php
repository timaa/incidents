<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Permission extends Model
{
    public $roles;
    public $userId;
    public $login;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roles'], 'required'],
            [['userId'], 'integer'],
            [['userId', 'login'], 'safe'],
            [['login'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'roles' => 'Роли пользователей',
            'userId' => 'Id пользователя ',
            'login' => 'Логин пользователя'
        ];
    }


}
