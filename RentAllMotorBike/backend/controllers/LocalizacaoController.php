<?php

namespace backend\controllers;

use common\models\Localizacao;
use common\models\LocalizacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii;



/**
 * LocalizacaoController implements the CRUD actions for Localizacao model.
 */
class LocalizacaoController extends Controller
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
     * Lists all Localizacao models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LocalizacaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Localizacao model.
     * @param int $id_localizacao Id Localizacao
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_localizacao)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_localizacao),
        ]);
    }

    /**
     * Creates a new Localizacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('createLocalizacao')) {
            $model = new Localizacao();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id_localizacao' => $model->id_localizacao]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Updates an existing Localizacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_localizacao Id Localizacao
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_localizacao)
    {
        if (\Yii::$app->user->can('updateLocalizacao')) {
            $model = $this->findModel($id_localizacao);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_localizacao' => $model->id_localizacao]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Deletes an existing Localizacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_localizacao Id Localizacao
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_localizacao)
    {
        if(\Yii::$app->user->can('deleteLocalizacao')){
        $this->findModel($id_localizacao)->delete();

        return $this->redirect(['index']);
    }

        else{
            Yii::$app->user->logout();
            return  $this ->redirect(['site/login']);
        }
    }

    /**
     * Finds the Localizacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_localizacao Id Localizacao
     * @return Localizacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_localizacao)
    {
        if (($model = Localizacao::findOne(['id_localizacao' => $id_localizacao])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
