<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Incidents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incidents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'closed_date')->textInput() ?>

    <?= $form->field($model, 'platform_id')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'classification_id')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'execution_time')->textInput() ?>

    <?= $form->field($model, 'creator_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creator_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assigned_to')->textInput() ?>

    <?= $form->field($model, 'send_sms')->textInput() ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'solution')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'solution_tmp')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comment')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
