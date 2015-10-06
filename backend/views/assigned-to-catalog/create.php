<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AssignedToCatalog */

$this->title = 'Create Assigned To Catalog';
$this->params['breadcrumbs'][] = ['label' => 'Assigned To Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assigned-to-catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
