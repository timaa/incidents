<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Incidents */

$this->title = 'Create Incidents';
$this->params['breadcrumbs'][] = ['label' => 'Incidents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
