<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//Yii::$app->assetManager->bundles = ['yii\web\JqueryAsset' => false,];
$this->registerJsFile("https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js");
/* @var $this yii\web\View */
/* @var $model frontend\models\Incidents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incidents-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="col-md-4"><?= $form->field($model, 'platform_id')->dropDownList($mapsForDropdown['platformMap']) ?></div>
    <div class="col-md-4"><?= $form->field($model, 'status_id')->dropDownList($mapsForDropdown['statusMap']) ?></div>
    <div class="col-md-4"><?= $form->field($model, 'classification_id')->dropDownList($mapsForDropdown['classificationMap']) ?></div>

    <ul class="nav nav-tabs">
        <li class="active" ><a href="#i-description" data-toggle="tab">Описание</a></li>
        <li><a href="#i-solution" data-toggle="tab">Решение</a></li>
        <li><a href="#i-solution_tmp" data-toggle="tab">Временное решение</a></li>
        <li><a href="#i-comment" data-toggle="tab">Комментарий</a></li>
    </ul>


    <div class="tab-content"><!--Табы(переключалка) -->

        <div class="tab-pane active" id="i-description"><?= $form->field($model, 'description')->textarea(['rows' => 6]) ?></div>

        <div class="tab-pane" id="i-solution"><?= $form->field($model, 'solution')->textarea(['rows' => 6]) ?></div>

        <div class="tab-pane" id="i-solution_tmp"><?= $form->field($model, 'solution_tmp')->textarea(['rows' => 6]) ?></div>

        <div class="tab-pane" id="i-comment"><?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?></div>

    </div>



    <div class="col-md-4"><?= $form->field($model, 'priority_id')->dropDownList($mapsForDropdown['priorityMap']) ?></div>

    <div class="col-md-4"><?= $form->field($model, 'type_id')->dropDownList($mapsForDropdown['typeMap']) ?></div>

    <div class="col-md-4"><?= $form->field($model, 'incident_type_id')->dropDownList($mapsForDropdown['typeIncidentMap']) ?></div>



    <div class="col-md-4"><?= $form->field($model, 'execution_time')->textInput() ?></div>
    <div class="col-md-4"><?= $form->field($model, 'creator_name')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-4"><?= $form->field($model, 'assigned_to')->dropDownList($mapsForDropdown['asignedToMap']) ?></div>


    <?= $form->field($model, 'send_sms')->checkbox() ?>
    <?= $form->field($files, 'file')->fileInput() ?>


<?php /*= $form->field($model, 'parent_id')->textInput() */?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>