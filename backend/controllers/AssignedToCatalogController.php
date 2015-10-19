<?php

namespace backend\controllers;

use backend\models\Users;
use common\models\User;
use Intervention\Image\Exception\NotFoundException;
use Yii;
use backend\models\AssignedToCatalog;
use backend\models\AssignedToCatalogSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AssignedToCatalogController implements the CRUD actions for AssignedToCatalog model.
 */
class AssignedToCatalogController extends Controller
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
     * Lists all AssignedToCatalog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssignedToCatalogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AssignedToCatalog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AssignedToCatalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AssignedToCatalog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AssignedToCatalog model.
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
     * Deletes an existing AssignedToCatalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AssignedToCatalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AssignedToCatalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssignedToCatalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddMember($groupId)
    {

        $user = new Users();
        if (\Yii::$app->request->isPost&& \Yii::$app->request->post('Users')) {

            $user=Users::findOne(['id'=>$_POST['user_id']]);
            $user->assigned_to_id =$groupId;
            if (empty($user)) {
                throw new NotFoundException(" User with id ".$_POST['user_id']." not found in database ");
            }
            if ($user->load(\Yii::$app->request->post()) && $user->save())
            {
                $members = Users::findAll(['assigned_to_id' => $groupId]);
                return $this->render('addMember', [
                    'members' =>$members,
                    'model' => $user,
                    'groupId' =>$groupId
                ]);
            } else{
                throw new Exception("something went wrong");
            }

        }

        $members = Users::findAll(['assigned_to_id' => $groupId]);
        return $this->render('addMember', [
            'members' =>$members,
            'model' => $user,
            'groupId' =>$groupId
        ]);
    }

    public function actionSearchMember() // Функция для поиска сотрудников
    {
        if(\Yii::$app->request->isGet){
            $term = $_GET['term'];
            $limit = $_GET['maxRows'];
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $contacts =Users::find()->limit($limit)->andFilterWhere(['like','fio',$term])->orFilterWhere(['like', 'email', $term])->all();
            return     $contacts;
        }
        //test comment
        return false;
    }

    public function actionDeleteFromGroup($memberId ,$groupId){
        $user = Users::findOne(["id" => $memberId]);
        if ($user) {
            $user->assigned_to_id = null;
            if ($user->save()) {
                return $this->redirect(["add-member", "groupId" =>$groupId]);

            } else {
                throw new Exception("Can't save model");
            }
        }
        throw new NotFoundException (" User with id $memberId not found in database ");

    }


}
