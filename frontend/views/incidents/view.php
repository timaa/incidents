<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\Incidents */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incidents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

/*$user = \common\models\AdUser::findIdentity(Yii::$app->user->id);
print_r($user);
die();*/
?>












<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Посмотреть историю
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Название модали</h4>
            </div>
            <div class="modal-body">
             <?php foreach($history as $change):?>
                 <div>
                     <h3><?= $change->username?></h3>
                     <h6>Дата:<?= $change->date?></h6>
                     <span>Изменил поле:<b><?= $model->attributeLabels()[$change->attr_name]?></b></span>
                     <div>C:<?= $catalogs["$change->attr_name"] ? $catalogs["$change->attr_name"][$change->from] : $change->from;?></div>
                     <div>На:<?= $catalogs["$change->attr_name"] ? $catalogs["$change->attr_name"][$change->to] : $change->to;?></div>
                 </div>
                 <hr>
                <?php endforeach;?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
















<div class="incidents-view">

   <!-- <h1><?/*= Html::encode($this->title) */?></h1>-->
<!--
    <p>
        <?/*= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>
-->
    <div class="incident-main">
        <ul>
            <li>
                <div class="incident-header">
                  <h3>  Инцидент № <?= $model->id?>  </h3>
                </div>
            </li>
            <li>
                <b>Платформа </b>
                <div><?= $model->platformCatalog->name ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('created_date')?> </b>
                <div><?= $model->created_date ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('closed_date')?> </b>
                <div><?= $model->closed_date ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('status_id')?> </b>
                <div><?= $model->statusCatalog->name ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('classification_id')?> </b>
                <div><?= $model->classificationCatalog->name ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('description')?> </b>
                <div><?= $model->description ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('priority_id')?> </b>
                <div><?= $model->priorityCatalog->name ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('type_id')?> </b>
                <div><?= $model->typeCatalog->name ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('incident_type_id')?> </b>
                <div><?= $model->typeIncidentCatalog->name ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('execution_time')?> </b>
                <div><?= $model->execution_time ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('creator_name')?> </b>
                <div><?= $model->creator_name ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('assigned_to')?> </b>
                <div><?= $model->assignedToCatalog->name ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('solution')?> </b>
                <div><?= $model->solution ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('solution_tmp')?> </b>
                <div><?= $model->solution_tmp ?></div>
            </li>
            <li>
                <b><?= $model->getAttributeLabel('comment')?> </b>
                <div><?= $model->comment ?></div>
            </li>



        </ul>
        <?php if (!empty($model->file_id)):?>
            <div class="files">

                <h4> <span class="glyphicon glyphicon-paperclip"></span>  Прикрепленные файлы</h4>
                <hr>
                <div class="file"><a href="<?= Url::toRoute(["incidents/download-file","id"=>$model->file_id]) ?>"><span class="glyphicon glyphicon-download-alt"></span><?= $model->files->real_name?></a></div>
            </div>
        <?php endif;?>

    </div>

</div>

<div class="comments">

<?php $form = ActiveForm::begin(['action' => Url::toRoute("incidents/comment"),'options' => ['enctype' => 'multipart/form-data']])?>
<?= $form->field($comment, 'text')->textarea() ?>
<?= $form->field($comment, 'incident_id')->hiddenInput(['value' => $model->id])->label(false) ?>
<?= $form->field($file,'file')->fileInput()?>

<div class="form-group">
    <?= Html::submitButton($comment->isNewRecord ? 'Create' : 'Update', ['class' => $comment->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>

<?php foreach($comments as $cmt): ?>
    <div class="media">
        <div class="media-left">
            <a href="#">
                <img width="40px" class="media-object" src="http://portal.ums.uz/index.php?r=profile%2Fgetphoto&amp;id=<?=$cmt->user_id?>" alt="...">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><b><?= $cmt->username?></b></h4>
            <?=$cmt->text?>
            <?php if (!empty($cmt->files)):?>
            <div class="panel panel-default" style="margin:10px 0 0 0;">
                <div class="panel-body">
                    Вложение:<br>
                    <span class="glyphicon glyphicon-download-alt"></span>
                    <a class="attachment_file" href="<?= Url::toRoute(["incidents/download-file","id"=>$cmt->files->id])?>"><?= $cmt->files->real_name?></a>                                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>











<style>
  .incident-main{
      margin:0 auto;
      width: 980px;
      border: 1px solid transparent;
      border-radius: 4px;
      -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
      box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
  }
  .incident-header{
      background-color: #f5f5f5;
      min-height: 40px;
  }
  .incident-main li{
      list-style: none;
      border: 1px solid transparent;
      margin-bottom: 10px;
      -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
      box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
  }
    .files{
        border-radius: 5px;
        border: 1px solid #f6f6f6;
        background-color: #f4f4f4;
    }
    .files h4{
        color: #1484e6;
        width: 100%;
        height: 100%;
    }
    .files .file .glyphicon {
        width: 30px;
        height: 30px;
    }
    .comments{
        background-color: #ebebeb;
        border-radius: 5px;
        padding: 10px;
        margin-top: 40px;
    }
</style>
