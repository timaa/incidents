<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PlatformCatalog */

$this->title = 'Create Platform Catalog';
$this->params['breadcrumbs'][] = ['label' => 'Platform Catalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="platform-catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
