<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TypeIncidentCatalog */

$this->title = 'Create Type Incident Catalog';
$this->params['breadcrumbs'][] = ['label' => 'Type Incident Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-incident-catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
