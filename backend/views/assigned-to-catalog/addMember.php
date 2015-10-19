<?php
/**
 * Created by PhpStorm.
 * User: taipov
 * Date: 16.10.2015
 * Time: 11:19
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>



<div class="center_content">
    <div class="central_block_title">
                    <?= "<h3><a style='color:#d43f3a' href='".Url::toRoute('/messages/groups')."'>Назад</a></h3>"; ?>
<div id="addMember">
            <input style="margin-right: 10px;" id="search-member" type="text" name="userId" class="form-control" placeholder="Вводите ФИО или логин">

</div>
        <div class="users-form" style="display: none">

            <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'readOnly' => true]) ?>

            <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true, 'readOnly' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
            <?= $form->field($model, 'send_sms')->checkbox() ?>
            <?= $form->field($model, 'send_email')->checkbox() ?>
            <input type="hidden" name= "groupId" value="<?=$groupId?>">
            <input  id="users-id" type="hidden" name="user_id">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
<?php if ($error): ?>
    <div class="alert alert-danger" role="alert">Данный логин не был найден в базе...</div>
<?php endif;?>


<table class="table table-condensed">
    <thead>
    <?php if (count($members)>0):?>
    <tr>
        <th>ФИО</th>
        <th>email</th>
        <th>Телефон</th>
        <th>Оповещать по смс</th>
        <th>Оповещать по email</th>
        <th>Удалить</th>
    </tr>
    <?php endif;?>
    </thead>
    <tbody>

    <?php foreach ($members as $member):?>
        <tr>
            <td><?=$member->fio?></td>
            <td><?=$member->email?></td>
            <td><?=$member->mobile_number?></td>
            <td><?=$member->send_sms? "Да":"Нет"?></td>
            <td><?=$member->send_email? "Да":"Нет"?></td>
            <td>
                <a href="<?=Yii::$app->getUrlManager()->createUrl(['users/update', "id"=>$member->id]);?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a href="<?=Yii::$app->getUrlManager()->createUrl(['/assigned-to-catalog/delete-from-group', "memberId"=>"$member->id", "groupId"=>$groupId]);?>">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
    <?php endforeach;?>

    </tbody>
</table>
</div>
</div>
