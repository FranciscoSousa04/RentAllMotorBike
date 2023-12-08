<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use backend\models\SignupForm;
use yii\filters\AccessControl;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'view', 'create', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'delete'],
                            'roles' => ['admin'],
                        ],
                        [
                            'allow' => true,
                            'actions' => [ 'view', 'create', 'delete'],
                            'roles' => ['gestor'],
                        ],
                        [
                            'allow' => false,
                            'actions' => [ 'view'],
                            'roles' => ['cliente'],
                        ],
                    ],
                ],
            ],
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = new LoginForm();
       // var_dump($model->hasProfile());
        if ($model->hasProfile($id)==false) {
            Yii::$app->session->setFlash('error','Este utilizador não tem profile criado');
            $this->redirect('index');

        } else {
            if (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == "gestor" && Yii::$app->user->id == $id) {
                return $this->render('view', ['model' => $this->findModel($id),
                ]);
            } elseif (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == "admin") {
                return $this->render('view', ['model' => $this->findModel($id),
                ]);
            } else
                $this->redirect('index');
        }
    }
    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('sucess', 'Thank you for registration');
            return $this->goHome();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new SignupForm();
        $modelUser = new User();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $modelUser->updateRole($this->request->post()['SignupForm']['role'], $id);

            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
            'id' => $id,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
