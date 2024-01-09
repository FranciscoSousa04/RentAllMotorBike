<?php

namespace frontend\controllers;

use common\models\Detalhesaluguer;
use common\models\DetalhesaluguerSearch;
use common\models\ExtraDetalhesAluguer;
use common\models\Fatura;
use common\models\Profile;
use common\models\motociclo;
use http\Exception\BadMessageException;
use Yii;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\conditions\BetweenColumnsCondition;


/**
 * DetalhesaluguerController implements the CRUD actions for Detalhesaluguer model.
 */
class DetalhesaluguerController extends Controller
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
                            'roles' => ['@'],
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
     * Lists all Detalhesaluguer models.
     *
     * @return string
     */
    public function actionIndex($id_user)
    {

        if (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == "cliente" && Yii::$app->user->id == $id_user) {

            $searchModel = new DetalhesaluguerSearch();
            $profile = Profile::findOne(['id_user'=> Yii::$app->user->getId()]);
            $dataProvider = new ActiveDataProvider([
                'query' => $profile->getDetalhesAluguers(),
            ]);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'profile' => $profile

            ]);
        } else
            $this->redirect('index');

    }

    /**
     * Displays a single Detalhesaluguer model.
     * @param int $id_detalhes_aluguer Id Detalhes Aluguer
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_detalhes_aluguer)
    {
        if (\Yii::$app->user->can('viewReserva')) {

            $model = $this->findModel($id_detalhes_aluguer);
            $fatura = Fatura::findOne(['detalhes_aluguer_fatura_id' => $model->id_detalhes_aluguer]);
            //calculo da diferenca entre a data de inicio e a data de fim
            $dataIni = date_create($model->data_inicio);
            $dataFim = date_create($model->data_fim);
            $dataDiff = date_diff($dataIni, $dataFim);
            $dias = (int)$dataDiff->format("%a");
            $dias++;
            $model->dias = $dias;

            if (Yii::$app->user->id == $model->profile->id_user) {
                return $this->render('view', [
                    'model' => $model,
                    'fatura' => $fatura,
                ]);
            } else
                $this->redirect('index');
        } else {
            \Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }


    /**
     * Creates a new Detalhesaluguer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $idmotociclo Id Motociclo
     * @return string|\yii\web\Response
     */
    public function actionCreate($idmotociclo)
    {
        if (\Yii::$app->user->can('createReserva')) {

            $model = new Detalhesaluguer();

            $dias = DetalhesAluguer::find()->where(['motociclo_id' => $idmotociclo])->all();
            $model->motociclo_id = $idmotociclo;

            $profile = Profile::findOne(['id_user'=> Yii::$app->user->getId()]);
            $model->profile_id = $profile->id_profile;


            if ($this->request->isPost) {

                $model->extras = $this->request->post()['DetalhesAluguer']['extras'];

                if ($model->load($this->request->post())) {

                    $model->data_inicio = date('Y-m-d H:i', strtotime($model->data_inicio));
                    $model->data_fim = date('Y-m-d H:i', strtotime($model->data_fim));

                    //var_dump($model);die;

                    if ($this->canCreate($model)) {
                        if ($model->save()) {
                            if ($model->extras != null)
                                foreach ($model->extras as $extradetalhes) {
                                    $extradetalhesaluguer = new ExtraDetalhesAluguer();
                                    $extradetalhesaluguer->extra_id = $extradetalhes;
                                    $extradetalhesaluguer->detalhes_aluguer_id = $model->id_detalhes_aluguer;
                                    $extradetalhesaluguer->save();
                                }

                            return $this->redirect(['view', 'id_detalhes_aluguer' => $model->id_detalhes_aluguer]);
                        }
                    } else
                        Yii::$app->session->setFlash('error', 'As datas inseridas não estão disponiveis!');
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
                'dias' => $dias,
            ]);
        } else {
            \Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    //verificar as datas inseridas pelo cliente e verificar se é possivel criar uma reserva nessas datas
    public function canCreate($detalhes)
    {

            //var_dump($detalhes);die;

            /*$oldDetalhes = Detalhesaluguer::find()
                ->where(['motociclo_id' => $detalhes->motociclo_id])
                ->andWhere((new BetweenColumnsCondition($detalhes->data_inicio, 'between', 'data_inicio', 'data_fim'))
                    ->orWhere(new BetweenColumnsCondition($detalhes->data_fim, 'between', 'data_inicio', 'data_fim'))
                    ->orWhere(['between', 'data_inicio', $detalhes->data_inicio, $detalhes->data_fim])
                    ->orWhere(['between', 'data_fim', $detalhes->data_inicio, $detalhes->data_fim]))
                ->all();*/

            $connection = \Yii::$app->getDb();

            $command = $connection->createCommand(
                "select * from detalhes_aluguer
                    where motociclo_id = :id
                        and (:dataIni  between detalhes_aluguer.data_inicio and detalhes_aluguer.data_fim
                        or :dataFim between detalhes_aluguer.data_inicio and detalhes_aluguer.data_fim
                        or data_inicio between :dataIni and :dataFim
                        or data_fim between :dataIni and :dataFim);"
            )
                ->bindValue(':id', $detalhes->motociclo_id)
                ->bindValue(':dataIni', $detalhes->data_inicio)
                ->bindValue(':dataFim', $detalhes->data_fim);


            $result = $command->queryAll();

            //var_dump($result);die;

            if ($result == null) {
                return true;
            } else {
                return false;
            }
        }


    /**
     * Updates an existing Detalhesaluguer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_detalhes_aluguer Id Detalhes Aluguer
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id_detalhes_aluguer)
    {
        if (\Yii::$app->user->can('updateReserva')) {

            $model = $this->findModel($id_detalhes_aluguer);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_detalhes_aluguer' => $model->id_detalhes_aluguer]);

            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            \Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Deletes an existing Detalhesaluguer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_detalhes_aluguer Id Detalhes Aluguer
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id_detalhes_aluguer)
    {
        if (\Yii::$app->user->can('deleteReserva')) {

            $this->findModel($id_detalhes_aluguer)->delete();

            return $this->redirect(['index']);
        } else {
            \Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Finds the Detalhesaluguer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_detalhes_aluguer Id Detalhes Aluguer
     * @return Detalhesaluguer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id_detalhes_aluguer)
    {
        if (($model = Detalhesaluguer::findOne(['id_detalhes_aluguer' => $id_detalhes_aluguer])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
