<?php
/**
 * Created by PhpStorm.
 * User: taipov
 * Date: 23.09.2015
 * Time: 11:37
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Добавить права доступа к пользователю';
$this->params['breadcrumbs'][] = ['label' => 'Права доступа', 'url' => ['create']];
?>
    <h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'roles')->dropDownList($roles) ?>
<?= $form->field($model, 'userId')->textInput(); ?>
<?= $form->field($model, 'login')->textInput(); ?>
<?php
if ($alert)
{
    echo Alert::widget([
        'options' => [
            'class' => 'alert-success',
        ],
        'body' => 'Права успешно добавлены!',
    ]);
}
?>
    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>