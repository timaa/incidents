<?php

namespace frontend\models;

use backend\models\Users;
use Yii;

/**
 * This is the model class for table "incidents".
 *
 * @property integer $id
 * @property string $created_date
 * @property string $closed_date
 * @property integer $platform_id
 * @property integer $status_id
 * @property integer $classification_id
 * @property string $description
 * @property integer $priority
 * @property string $type
 * @property integer $incident_type
 * @property string $execution_time
 * @property string $creator_name
 * @property string $creator_id
 * @property integer $assigned_to
 * @property integer $send_sms
 * @property integer $parent_id
 * @property string $solution
 * @property string $solution_tmp
 * @property integer $comment
 */
class Incidents extends \yii\db\ActiveRecord
{
    private $oldAttrSaveArray=[];
    public static $executionTime =[
        1 => 24*60*60,// Стандартный
        2 => 12*60*60,// Высокий,
        3 => 2*60*60, // Наивысший
        4 => 120*60*60, // Низкий
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'incidents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        /*Решить с именем (cretator_name)*/
        return [
            [['created_date', 'platform_id', 'status_id', 'classification_id', 'description', 'priority_id', 'type_id', 'incident_type_id', 'creator_id', 'assigned_to', 'parent_id'], 'required'],
            [['created_date', 'closed_date', 'execution_time', 'file_id'], 'safe'],
            [['platform_id', 'type_id', 'status_id', 'classification_id', 'priority_id', 'incident_type_id', 'assigned_to', 'send_sms', 'parent_id'], 'integer'],
            [['description', 'solution', 'solution_tmp','comment'], 'string'],
            [[ 'creator_name'], 'string', 'max' => 150],
            [['creator_id'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_date' => 'Дата открытия',
            'closed_date' => 'Дата Решения',
            'platform_id' => 'Платформа',
            'status_id' => 'Статус',
            'classification_id' => 'Классификация',
            'description' => 'Описание',
            'priority_id' => 'Приоритет',
            'type_id' => 'Тип',
            'incident_type_id' => 'Тип инцидента',
            'execution_time' => 'Срок исполнения',
            'creator_name' => 'Инициатор',
            'creator_id' => 'Creator ID',
            'assigned_to' => 'Назначено в команду',
            'send_sms' => 'Отправить смс',
            'parent_id' => 'Parent ID',
            'solution' => 'Решение',
            'solution_tmp' => 'Временное решение',
            'comment' => 'Комментарий',
            'file_id' => 'File id',
        ];
    }

    public function beforeValidate()
    {

        if ($this->isNewRecord && $this->scenario == "create") {
            $this->created_date = date("Y-m-d h:i:s");
            $this->creator_id = \Yii::$app->user->id;
            $this->parent_id =10020;
        }
        return parent::beforeValidate();
    }

    public function afterFind()
    {
        $this->oldAttrSaveArray = $this->attributes; // Сохраняем значения для сравнения с измененным
        return parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes) // После сохранения в базе сохарняем изменения
    {
        $this->getDiffAttribute($this->oldAttrSaveArray, $this->attributes, $this->id);
        return parent::afterSave($insert, $changedAttributes);
    }


    public function getAssignedToCatalog()
    {
        return $this->hasOne(AssignedToCatalog::className(),['id'=>'assigned_to']);
    }

    public function getClassificationCatalog()
    {
        return $this->hasOne(ClassificationCatalog::className(),['id'=>'classification_id']);
    }

    public function getFiles()
    {
        return $this->hasOne(Files::className(),['id'=>'file_id']);
    }

    public function getPlatformCatalog()
    {
        return $this->hasOne(PlatformCatalog::className(),['id'=>'platform_id']);
    }

    public function getPriorityCatalog()
    {
        return $this->hasOne(PriorityCatalog::className(),['id'=>'priority_id']);
    }

    public function getStatusCatalog()
    {
        return $this->hasOne(StatusCatalog::className(),['id'=>'status_id']);
    }

    public function getTypeCatalog()
    {
        return $this->hasOne(TypeCatalog::className(),['id'=>'type_id']);
    }

    public function getTypeIncidentCatalog()
    {
        return $this->hasOne(TypeIncidentCatalog::className(),['id'=>'incident_type_id']);
    }

    private function getDiffAttribute(array $from, array $to, $incident_id)
    {
        $fio = Users::findOne(['id' => \Yii::$app->user->id])->fio;
        foreach ($from as $key => $value ) {
            if ( $from[$key] != $to[$key] ) {
                $history = new History();
                $history->from = "$from[$key]";
                $history->to = $to[$key];
                $history->attr_name = $key;
                $history->username = $fio;
                $history->incident_id = $incident_id;
                $history->date = date("Y-m-d h:i:s");
                $history->save();
            }
        }
    }
}
