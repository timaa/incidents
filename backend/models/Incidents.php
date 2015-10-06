<?php

namespace backend\models;

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
        return [
            [['created_date', 'closed_date', 'platform_id', 'status_id', 'classification_id', 'description', 'priority_id', 'type_id', 'execution_time', 'creator_name', 'creator_id', 'assigned_to', 'send_sms', 'parent_id', 'solution', 'solution_tmp', 'comment'], 'required'],
            [['created_date', 'closed_date', 'execution_time'], 'safe'],
            [['platform_id', 'status_id', 'classification_id', 'priority_id', 'assigned_to', 'send_sms', 'parent_id', 'comment'], 'integer'],
            [['description', 'solution', 'solution_tmp'], 'string'],
            [['type_id', 'creator_name'], 'string', 'max' => 150],
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
            'created_date' => 'Created Date',
            'closed_date' => 'Closed Date',
            'platform_id' => 'Platform ID',
            'status_id' => 'Status ID',
            'classification_id' => 'Classification ID',
            'description' => 'Description',
            'priority_id' => 'Priority',
            'type_id' => 'Type',
            'execution_time' => 'Execution Time',
            'creator_name' => 'Creator Name',
            'creator_id' => 'Creator ID',
            'assigned_to' => 'Assigned To',
            'send_sms' => 'Send Sms',
            'parent_id' => 'Parent ID',
            'solution' => 'Solution',
            'solution_tmp' => 'Solution Tmp',
            'comment' => 'Comment',
        ];
    }
}
