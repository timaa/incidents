<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $url
 * @property integer $for_comment
 * @property integer $for_incident
 * @property string $name
 * @property string $real_name
 *
 */
class Files extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'name','real_name'], 'required'],
            [['file'],'file'],
            [['url'], 'string', 'max' => 150],
            [['name','real_name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
/*            'for_comment' => 'For Comment',
            'for_incident' => 'For Incident',*/
            'name' => 'Name',
        ];
    }

    public function setPath()
    {
        $root = Yii::getAlias("@frontend");
        $this->real_name = $this->file->name;
        $this->name = Yii::$app->getSecurity()->generateRandomString().".".$this->file->extension;
        return $root.DIRECTORY_SEPARATOR."files".DIRECTORY_SEPARATOR.$this->name;
    }
}
