<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Incidents;

/**
 * IncidentsSearch represents the model behind the search form about `backend\models\Incidents`.
 */
class IncidentsSearch extends Incidents
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'platform_id', 'status_id', 'classification_id', 'priority_id', 'incident_type_id', 'assigned_to', 'send_sms', 'parent_id', 'comment'], 'integer'],
            [['created_date', 'closed_date', 'description', 'type_id', 'execution_time', 'creator_name', 'creator_id', 'solution', 'solution_tmp'], 'safe'],
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
        $query = Incidents::find()->with(['statusCatalog']);

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
            'id' => $this->id,
            'created_date' => $this->created_date,
            'closed_date' => $this->closed_date,
            'platform_id' => $this->platform_id,
            'status_id' => $this->status_id,
            'classification_id' => $this->classification_id,
            'priority_id' => $this->priority_id,
            'incident_type_id' => $this->incident_type_id,
            'execution_time' => $this->execution_time,
            'assigned_to' => $this->assigned_to,
            'send_sms' => $this->send_sms,
            'parent_id' => $this->parent_id,
            'comment' => $this->comment,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type', $this->type_id])
            ->andFilterWhere(['like', 'creator_name', $this->creator_name])
            ->andFilterWhere(['like', 'creator_id', $this->creator_id])
            ->andFilterWhere(['like', 'solution', $this->solution])
            ->andFilterWhere(['like', 'solution_tmp', $this->solution_tmp]);

        return $dataProvider;
    }
}
