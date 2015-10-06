<?php
/**
 * Created by PhpStorm.
 * User: taipov
 * Date: 23.09.2015
 * Time: 10:36
 */
namespace backend\controllers;

use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use backend\models\Permission;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use common\models\AdUser;

/**
 * Site controller
 */
class PermissionController extends Controller
{
    /*public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!\Yii::$app->user->can('admin')) {
                throw new ForbiddenHttpException('Access denied');
            }
            return true;
        } else {
            return false;
        }
    }*/


    public function actionAddRoles()
    {
/*        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $admin->description = 'Главный администратор сайта';
        $auth->add($admin);*/

    }

    public function actionCreate()
    {
        $alert = false;
        $auth = Yii::$app->authManager;
        $rolesObject = $auth->getRoles();
        $rolesArray = [];

        foreach($rolesObject as $rolesRow)
        {
            $rolesArray[$rolesRow->name] = $rolesRow->description;
        }

        $model = new Permission;
        if ($model->load(Yii::$app->request->post())){
            if (empty($model->login) && empty($model->userId))
                return $this->render('create',
                    [
                        'model'=>$model,
                        'roles'=>$rolesArray,
                        'alert'=>$alert
                    ]
                );
            if (!empty($model->login)&&empty($model->userId)) {
                $user = AdUser::getUserFromName($model->login);
                $model->userId = $user['id'];
                if(empty($model->userId))
                    throw new Exception("Пользователь $model->login не был найден.");
            }

            $role = $auth->getRole($model->roles);
            $auth->assign($role, $model->userId);
            $alert = true;
        }

        return $this->render('create',
            [
                'model'=>$model,
                'roles'=>$rolesArray,
                'alert'=>$alert
            ]
        );
    }
}