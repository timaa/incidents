<?php

namespace backend\controllers;

use backend\models\AssignedToCatalog;
use backend\models\Role;
use common\models\AdUser;
use Yii;
use backend\models\Users;
use backend\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $assignedToMap = ArrayHelper::map(AssignedToCatalog::find()->asArray()->all(),'id','name');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'assignedToMap' => $assignedToMap,
        ]);
    }

    /**
     * Обновляет список сотрудников вытягивая данные с AD.
     * Есди данный сотрудник уже имеется в бд проекта, то он не обновляет данные по нему.
     * Для обновления данных из Ad сотрудника нужно  удалить.
     * @return \yii\web\Response
     */
    public function actionUpdateList()
    {
        $users = \Yii::$app->ldap->user()->all(false,"*",false);
        $model = new AdUser();
        foreach($users as $user)
        {
            $asciiCode =ord($user[0]);
            if (($asciiCode > 96) && ($asciiCode < 122) && strlen($user) > 2) {
                $adUser = $model->getUserFromName($user);
                $user = new Users();
                if (Users::findOne(["id" => $adUser["id"]]) == null) {
                    $user->id = $adUser["id"];
                    $user->fio = $adUser["fullName"];
                    $user->mobile_number = $adUser["mobile"];
                    $user->email = $adUser["email"];
                    $user->save();
                }
            }
        }
        return $this->redirect(['users/index']);

    }


    /**
     * Displays a single Users model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        $roleMap = ArrayHelper::map(Role::find()->asArray()->all(),'name','name');
        $assignedToMap = ArrayHelper::map(AssignedToCatalog::find()->asArray()->all(),'id','name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'roleMap' => $roleMap,
                'assignedToMap' => $assignedToMap,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $assignedToMap = ArrayHelper::map(AssignedToCatalog::find()->asArray()->all(),'id','name');
            $roleMap = ArrayHelper::map(Role::find()->asArray()->all(),'name','name');
            return $this->render('update', [
                'model' => $model,
                'assignedToMap' => $assignedToMap,
                'roleMap' => $roleMap,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest()
    {
        $testUser = Users::findOne(["id" => "0000010591"]);

        /*$sms =  new \common\component\SmsSender([["mobile" => $testUser->mobile_number]],"hello test");
        $sms->send();*/
        $email = new \common\component\EmailSender([["email" => $testUser->email]]," body","test test");
        $email->send();

    }
}
