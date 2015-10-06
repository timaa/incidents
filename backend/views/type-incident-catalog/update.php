<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TypeIncidentCatalog */

$this->title = 'Update Type Incident Catalog: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Type Incident Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-incident-catalog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
