<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fio',
            ['attribute'=>'assigned_to_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'assigned_to_id',
                    $assignedToMap,
                    ['class' => 'form-control']
                )
            ],
            'role',
            'mobile_number',
            'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
