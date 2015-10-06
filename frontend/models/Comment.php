<?php

namespace frontend\models;

use Yii;
use common\models\AdUser;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $incident_id
 * @property integer $text
 * @property string $user_id
 * @property string $created_date
 */
class Comment extends \yii\db\ActiveRecord
{
    public $username;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['incident_id', 'text', 'user_id', 'created_date'], 'required'],
            [['incident_id', 'text'], 'string'],
            [['created_date','file_id'], 'safe'],
            [['user_id'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'incident_id' => 'Incident ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'created_date' => 'Created Date',
        ];
    }
    public function beforeValidate()
    {
        $this->created_date = date("Y-m-d H:i:s");
        $this->user_id = Yii::$app->user->id;
        return parent::beforeValidate();
    }
    public function afterFind()
    {
      $user = AdUser::findIdentity($this->user_id);
      $this->username = $user->fullname;
        return parent::afterFind();
    }

    public function getFiles()
    {
        return $this->hasOne(Files::className(), ['id'=>'file_id']);
    }

}
