<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StatusCatalog */

$this->title = 'Create Status Catalog';
$this->params['breadcrumbs'][] = ['label' => 'Status Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
