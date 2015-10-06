<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PlatformCatalog */

$this->title = 'Update Platform Catalog: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Platform Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="platform-catalog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
