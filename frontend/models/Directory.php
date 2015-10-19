<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "directory".
 *
 * @property string $model
 * @property string $key
 * @property string $value
 * @property string $param
 */
class Directory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'directory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'key', 'param'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'model' => 'Model',
            'key' => 'Key',
            'value' => 'Value',
            'param' => 'Param',
        ];
    }

    public static function getCatalog()
    {
        $array = [];
        $directory = Directory::find()->groupBy(['model'])->select(['model'])->asArray()->all();
        $catalog = Directory::find()->asArray()->all();
        foreach ($directory as $dir) {
            $array[$dir['model']] = ArrayHelper::map(Directory::find()->where(['model'=>$dir['model']])->asArray()->all(),'key','value');
        }
        return $array;
    }
}
