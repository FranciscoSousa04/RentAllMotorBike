<?php

namespace backend\controllers;

use common\models\Assistencia;
use common\models\AssistenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;



/**
 * AssistenciaController implements the CRUD actions for Assistencia model.
 */
class AssistenciaController extends Controller
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
     * Lists all Assistencia models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AssistenciaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Assistencia model.
     * @param int $id_assistencia Id Assistencia
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_assistencia)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_assistencia),
        ]);
    }

    /**
     * Creates a new Assistencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /*public function actionCreate()
    {
        $model = new Assistencia();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_assistencia' => $model->id_assistencia]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    /**
     * Updates an existing Assistencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_assistencia Id Assistencia
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_assistencia)
    {
        $model = $this->findModel($id_assistencia);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_assistencia' => $model->id_assistencia]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Assistencia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_assistencia Id Assistencia
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_assistencia)
    {
        $this->findModel($id_assistencia)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Assistencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_assistencia Id Assistencia
     * @return Assistencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_assistencia)
    {
        if (($model = Assistencia::findOne(['id_assistencia' => $id_assistencia])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
