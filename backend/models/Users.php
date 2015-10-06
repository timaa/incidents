<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Users".
 *
 * @property string $id
 * @property string $fio
 * @property integer $assigned_to_id
 * @property integer $role_id
 * @property string $mobile_number
 * @property string $email
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', ], 'required'],
            [['assigned_to_id'], 'integer'],
            [['role'], 'string'],
            [['id'], 'string', 'max' => 12],
            [['fio'], 'string', 'max' => 150],
            [['mobile_number'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 70]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Фио',
            'assigned_to_id' => 'Команда',
            'role' => 'Роль',
            'mobile_number' => 'Номер телефона',
            'email' => 'Email',
        ];
    }


}
