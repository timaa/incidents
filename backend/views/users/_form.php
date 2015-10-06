<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'readOnly' => true]) ?>

    <?= $form->field($model, 'assigned_to_id')->dropDownList($assignedToMap) ?>

    <?= $form->field($model, 'role')->dropDownList($roleMap) ?>

    <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true, 'readOnly' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readOnly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
