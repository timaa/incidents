<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\IncidentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incidents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_date') ?>

    <?= $form->field($model, 'closed_date') ?>

    <?= $form->field($model, 'platform_id') ?>

    <?= $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'classification_id') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'incident_type') ?>

    <?php // echo $form->field($model, 'execution_time') ?>

    <?php // echo $form->field($model, 'creator_name') ?>

    <?php // echo $form->field($model, 'creator_id') ?>

    <?php // echo $form->field($model, 'assigned_to') ?>

    <?php // echo $form->field($model, 'send_sms') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'solution') ?>

    <?php // echo $form->field($model, 'solution_tmp') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
