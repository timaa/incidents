<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PriorityCatalog */

$this->title = 'Create Priority Catalog';
$this->params['breadcrumbs'][] = ['label' => 'Priority Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="priority-catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
