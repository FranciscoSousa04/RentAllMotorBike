<?php

namespace backend\controllers;

use common\models\Seguro;
use common\models\SeguroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii;



/**
 * SeguroController implements the CRUD actions for Seguro model.
 */
class SeguroController extends Controller
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
                    'rules' => [
                        [
                            'actions' => ['index', 'view','update', 'create', 'delete'],
                            'allow' => true,
                            'roles' => ['gestor','admin'],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        Yii::$app->user->logout();
                        return $this->redirect(['site/login']);
                    }
                ],
            ]
        );
    }

    /**
     * Lists all Seguro models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SeguroSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Seguro model.
     * @param int $id_seguro Id Seguro
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_seguro)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_seguro),
        ]);
    }

    /**
     * Creates a new Seguro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('createSeguro')) {

            $model = new Seguro();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id_seguro' => $model->id_seguro]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else{
            Yii::$app->user->logout();
            return  $this ->redirect(['site/login']);
        }

    }

    /**
     * Updates an existing Seguro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_seguro Id Seguro
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_seguro)
    {
        if (\Yii::$app->user->can('updateSeguro')) {
            $model = $this->findModel($id_seguro);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_seguro' => $model->id_seguro]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else{
            Yii::$app->user->logout();
            return  $this ->redirect(['site/login']);
        }
    }

    /**
     * Deletes an existing Seguro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_seguro Id Seguro
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_seguro)
    {
        if (\Yii::$app->user->can('deleteSeguro')) {

            $this->findModel($id_seguro)->delete();

            return $this->redirect(['index']);
        }else{
            Yii::$app->user->logout();
            return  $this ->redirect(['site/login']);
        }
    }

    /**
     * Finds the Seguro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_seguro Id Seguro
     * @return Seguro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_seguro)
    {
        if (($model = Seguro::findOne(['id_seguro' => $id_seguro])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
