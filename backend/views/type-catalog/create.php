<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TypeCatalog */

$this->title = 'Create Type Catalog';
$this->params['breadcrumbs'][] = ['label' => 'Type Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
