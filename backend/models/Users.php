<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $fio
 * @property integer $assigned_to_id
 * @property string $role
 * @property string $mobile_number
 * @property string $email
 * @property integer $send_sms
 * @property integer $send_email
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fio'], 'required'],
            [['assigned_to_id', 'send_sms', 'send_email'], 'integer'],
            [['id'], 'string', 'max' => 12],
            [['fio'], 'string', 'max' => 150],
            [['role'], 'string', 'max' => 64],
            [['mobile_number'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 70],
            [['send_sms', 'send_email'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'assigned_to_id' => 'Assigned To ID',
            'role' => 'Role',
            'mobile_number' => 'Mobile Number',
            'email' => 'Email',
            'send_sms' => 'Send Sms',
            'send_email' => 'Send Email',
        ];
    }
}
