<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AssignedToCatalog */

$this->title = 'Update Assigned To Catalog: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assigned To Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assigned-to-catalog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
