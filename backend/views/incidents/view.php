<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Incidents */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incidents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidents-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_date',
            'closed_date',
            'platform_id',
            'status_id',
            'classification_id',
            'description:ntext',
            'priority',
            'type',
            'incident_type',
            'execution_time',
            'creator_name',
            'creator_id',
            'assigned_to',
            'send_sms',
            'parent_id',
            'solution:ntext',
            'solution_tmp:ntext',
            'comment',
        ],
    ]) ?>

</div>
