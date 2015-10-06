<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Users;

/**
 * UsersSearch represents the model behind the search form about `backend\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fio', 'mobile_number', 'email'], 'safe'],
            [['assigned_to_id'], 'integer'],
            [['role'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'assigned_to_id' => $this->assigned_to_id!=1 ?$this->assigned_to_id :null,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
