<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AssignedToCatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assigned To Catalogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assigned-to-catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Assigned To Catalog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'class' => \yii\grid\ActionColumn::className(),
                'buttons'=>[
                    'new'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['/assigned-to-catalog/add-member',"groupId" => $model->id]); //glyphicon-user
                        return \yii\helpers\Html::a( '<span class="glyphicon  glyphicon-plus "></span>', $customurl,
                            ['title' => Yii::t('yii', 'Добавить пользователей группы'), 'data-pjax' => '0']);
                    },

                ],
                'template'=>'{new} {view}  {delete} {update}',
            ],

        ],
    ]); ?>

</div>
