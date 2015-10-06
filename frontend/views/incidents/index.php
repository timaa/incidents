<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IncidentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Incidents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Incidents', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_date',
            'closed_date',
            'platform_id',
            'status_id',
            // 'classification_id',
            // 'description:ntext',
            // 'priority',
            // 'type',
            // 'incident_type',
            // 'execution_time',
            // 'creator_name',
            // 'creator_id',
            // 'assigned_to',
            // 'send_sms',
            // 'parent_id',
            // 'solution:ntext',
            // 'solution_tmp:ntext',
            // 'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
