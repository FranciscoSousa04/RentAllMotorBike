<?php

namespace backend\controllers;

use common\models\Motociclo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MotocicloController implements the CRUD actions for Motociclo model.
 */
class MotocicloController extends Controller
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
            ]
        );
    }

    /**
     * Lists all Motociclo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Motociclo::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idmotociclo' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Motociclo model.
     * @param int $idmotociclo Idmotociclo
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idmotociclo)
    {
        return $this->render('view', [
            'model' => $this->findModel($idmotociclo),
        ]);
    }

    /**
     * Creates a new Motociclo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Motociclo();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idmotociclo' => $model->idmotociclo]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Motociclo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idmotociclo Idmotociclo
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idmotociclo)
    {
        $model = $this->findModel($idmotociclo);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idmotociclo' => $model->idmotociclo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Motociclo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idmotociclo Idmotociclo
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idmotociclo)
    {
        $this->findModel($idmotociclo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Motociclo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idmotociclo Idmotociclo
     * @return Motociclo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idmotociclo)
    {
        if (($model = Motociclo::findOne(['idmotociclo' => $idmotociclo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
