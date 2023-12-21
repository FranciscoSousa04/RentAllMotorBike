<?php

namespace backend\controllers;

use common\models\Tipomotociclo;
use common\models\TipomotocicloSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii;



/**
 * TipomotocicloController implements the CRUD actions for Tipomotociclo model.
 */
class TipomotocicloController extends Controller
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
     * Lists all Tipomotociclo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TipomotocicloSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tipomotociclo model.
     * @param int $id_tipo_motociclo Id Tipo motociclo
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_tipo_motociclo)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_tipo_motociclo),
        ]);
    }

    /**
     * Creates a new Tipomotociclo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tipomotociclo();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_tipo_motociclo' => $model->id_tipo_motociclo]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tipomotociclo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_tipo_motociclo Id Tipo motociclo
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_tipo_motociclo)
    {
        $model = $this->findModel($id_tipo_motociclo);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_tipo_motociclo' => $model->id_tipo_motociclo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tipomotociclo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_tipo_motociclo Id Tipo motociclo
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_tipo_motociclo)
    {
        $this->findModel($id_tipo_motociclo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tipomotociclo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_tipo_motociclo Id Tipo motociclo
     * @return Tipomotociclo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_tipo_motociclo)
    {
        if (($model = Tipomotociclo::findOne(['id_tipo_motociclo' => $id_tipo_motociclo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
