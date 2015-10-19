<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property string $attr_name
 * @property string $date
 * @property string $username
 * @property string $incident_id
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['incident_id'], 'required'],
            [['date'], 'safe'],
            [['from', 'to'], 'string', 'max' => 200],
            [['attr_name'], 'string', 'max' => 30],
            [['username'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'attr_name' => 'Attr Name',
            'date' => 'Date',
            'username' => 'Username',
            'incident_id' => 'Incident ID',
        ];
    }
}
