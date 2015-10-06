<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ClassificationCatalog */

$this->title = 'Create Classification Catalog';
$this->params['breadcrumbs'][] = ['label' => 'Classification Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classification-catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
