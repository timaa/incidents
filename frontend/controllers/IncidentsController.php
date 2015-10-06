<?php

namespace frontend\controllers;

use frontend\models\AssignedToCatalog;
use frontend\models\ClassificationCatalog;
use frontend\models\Comment;
use frontend\models\Files;
use frontend\models\IncidentsSearch;
use frontend\models\PlatformCatalog;
use frontend\models\PriorityCatalog;
use frontend\models\StatusCatalog;
use frontend\models\TypeCatalog;
use frontend\models\TypeIncidentCatalog;
use Intervention\Image\File;
use Yii;
use frontend\models\Incidents;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * IncidentsController implements the CRUD actions for Incidents model.
 */
class IncidentsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Incidents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncidentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Incidents model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $comment = new Comment();
        $file = new Files();
        $comments = Comment::find()->where(['incident_id' =>$id])->all();
        return $this->render('view', [
            'model'   => $this->findModel($id),
            'comment' => $comment,
            'file'    => $file,
            'comments'=> $comments,
        ]);
    }

    /**
     * Creates a new Incidents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Incidents();
        $mapsForDropdown = $this->getMaps();
        $files = new Files();


        if ($model->load(Yii::$app->request->post()) && $files->load(Yii::$app->request->post()) && $model->validate()) {
            $files->file = UploadedFile::getInstance($files,'file');

            if (!empty($files->file)) {
                $absPath = $files->setPath();
                if ($files->file->saveAs($absPath)) {
                      $files->url = $absPath;
                    if ($files->save()) {
                        $model->file_id = $files->id;
                        $model->save();
                    }
                };
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'files' => $files,
                'mapsForDropdown' => $mapsForDropdown,
            ]);
        }
    }

    /**
     * Updates an existing Incidents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Incidents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function getMaps()
    {
        $maps =[];
        $maps['asignedToMap']      = ArrayHelper::map(AssignedToCatalog::find()->asArray()->all(),'id','name');
        $maps['platformMap']       = ArrayHelper::map(PlatformCatalog::find()->asArray()->all(),'id','name');
        $maps['statusMap']         = ArrayHelper::map(StatusCatalog::find()->asArray()->all(),'id','name');
        $maps['classificationMap'] = ArrayHelper::map(ClassificationCatalog::find()->asArray()->all(),'id','name');
        $maps['priorityMap']       = ArrayHelper::map(PriorityCatalog::find()->asArray()->all(),'id','name');
        $maps['typeMap']           = ArrayHelper::map(TypeCatalog::find()->asArray()->all(),'id','name');
        $maps['typeIncidentMap']   = ArrayHelper::map(TypeIncidentCatalog::find()->asArray()->all(),'id','name');
        return $maps;

    }

    /**
     * Adding comments for incident
     * may have file
     **/
    public function actionComment()
    {
      $model =  new Comment();
      $files = new Files();
        if ($model->load(Yii::$app->request->post()) && $files->load(Yii::$app->request->post())) {
            $files->file = UploadedFile::getInstance($files,'file');
            if (!empty($files->file)) {
                $absPath = $files->setPath();
                if ($files->file->saveAs($absPath)) {
                        $files->url = $absPath;
                        if ($files->save()) {
                            $model->file_id = $files->id;
                            if ($model->save()) {
                                return $this->redirect(["incidents/view",'id'=>$model->incident_id]);
                            }
                        }

                };
            }
        }

    }

    public function actionDownloadFile($id)
    {
        $file = Files::findOne(['id' =>$id]);
        if(isset($file))
            return Yii::$app->response->sendFile($file->url,$file->real_name);

    }

    /**
     * Finds the Incidents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Incidents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Incidents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
