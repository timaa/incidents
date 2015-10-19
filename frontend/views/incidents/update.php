<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Incidents */

$this->title = 'Update Incidents: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incidents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incidents-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'files' => $files,
        'mapsForDropdown' => $mapsForDropdown,
    ]) ?>

</div>
