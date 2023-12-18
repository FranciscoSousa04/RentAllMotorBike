<?php

namespace frontend\controllers;

use common\models\motociclo;
use common\models\motocicloSearch;
use common\models\Detalhesaluguer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\db\conditions\BetweenColumnsCondition;

/**
 * motocicloController implements the CRUD actions for motociclo model.
 */
class motocicloController extends Controller
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
     * Lists all motociclo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'main_index.php';

        //ler as inputs do array post
        
        if ($this->request->isPost) {

            if(\str_starts_with($this->request->post()['localizacao'], 'Selecione')){
                $localizacao = '%%';
            }else{
                $localizacao = $this->request->post()['localizacao'];
            }

            if(\str_starts_with($this->request->post()['tipomotociclo'], 'Selecione')){
                $tipomotociclo = '%%';
            }else{
                $tipomotociclo = $this->request->post()['tipomotociclo'];
            }
            
            if($this->request->post()['dataInicio'] == ''){
                $dataInicio = '';
            }else{
                $dataInicio = $this->request->post()['dataInicio'];
            }

            if($this->request->post()['dataFim'] == ''){
                $dataFim = '';
            }else{
                $dataFim = $this->request->post()['dataFim'];
            }
            
           /* $subquery = Detalhesaluguer::find()
                ->select(['motociclo_id'])
                    ->where(new BetweenColumnsCondition($dataInicio, 'between', 'detalhes_aluguer.data_inicio', 'detalhes_aluguer.data_fim'))
                    ->orWhere(new BetweenColumnsCondition($dataFim, 'between', 'detalhes_aluguer.data_inicio', 'detalhes_aluguer.data_fim'))
                    ->orWhere(['between', 'detalhes_aluguer.data_inicio', $dataInicio, $dataFim])
                    ->orWhere(['between', 'detalhes_aluguer.data_fim', $dataInicio, $dataFim])
                    ->all();

            $carro = array();
            foreach($subquery as $item){
                $carro[] = $item->motociclo_id;
            }

            $model = motociclo::find()
                ->innerJoinWith(['tipomotociclo'])
                ->joinWith(['localizacao'])
                ->joinWith(['detalhesAluguers'])
                    ->where(['like', 'tipo_motociclo.categoria', $tipomotociclo])
                    ->andWhere(['not like', 'motociclo.estado', 'manutencao'])
                    ->andWhere(['like', 'localizacao.morada', $localizacao])

                    ->andWhere(['or', 
                        [new BetweenColumnsCondition($dataInicio, 'not between', 'detalhes_aluguer.data_inicio', 'detalhes_aluguer.data_fim')], 
                        ['is', 'detalhes_aluguer.data_fim', null]
                    ])

                    ->andWhere([ 
                        ['is', 'detalhes_aluguer.data_fim', null],'or',
                        [new BetweenColumnsCondition($dataInicio, 'not between', 'detalhes_aluguer.data_inicio', 'detalhes_aluguer.data_fim')]
                    ])

                    //->andWhere(new BetweenColumnsCondition($dataInicio, 'not between', 'detalhes_aluguer.data_inicio', 'detalhes_aluguer.data_fim'))
                    //->orWhere(['is', 'detalhes_aluguer.data_fim', null])

                    //->andWhere(new BetweenColumnsCondition($dataInicio, 'not between', 'detalhes_aluguer.data_inicio', 'detalhes_aluguer.data_fim'))
                    //->andWhere(new BetweenColumnsCondition($dataFim, 'not between', 'detalhes_aluguer.data_inicio', 'detalhes_aluguer.data_fim'))
                    ->andWhere(['not in', 'detalhes_aluguer.motociclo_id', $carro])
                    ->all();*/
            
            //var_dump($subquery->createCommand()->getRawSql());
            //var_dump($model->createCommand()->getRawSql());



            $connection = \Yii::$app->getDb();

            $command = $connection->createCommand(
                "select distinct id_motociclo from motociclo 
                    inner join tipo_motociclo on tipo_motociclo.id_tipo_motociclo = motociclo.tipo_motociclo_id 
                    left join localizacao on localizacao.id_localizacao = motociclo.localizacao_id
                    left join detalhes_aluguer on detalhes_aluguer.motociclo_id = motociclo.id_motociclo 
                    where tipo_motociclo.categoria like :tipo
                        and localizacao.morada like :morada
                        and motociclo.estado not like 'manutencao'
                        and (:dataIni  not between detalhes_aluguer.data_inicio and detalhes_aluguer.data_fim or detalhes_aluguer.data_inicio is null)
                        and (:dataFim not between detalhes_aluguer.data_inicio and detalhes_aluguer.data_fim or detalhes_aluguer.data_inicio is null)
                        and motociclo.id_motociclo not in (
                            select motociclo_id from detalhes_aluguer
                                where (:dataIni   between detalhes_aluguer.data_inicio and detalhes_aluguer.data_fim 
                                    or :dataFim  between detalhes_aluguer.data_inicio and detalhes_aluguer.data_fim )
                                    or detalhes_aluguer.data_inicio between :dataIni and :dataFim
                                    or detalhes_aluguer.data_fim between :dataIni  and :dataFim);"
                    )
                    ->bindValue(':tipo', $tipomotociclo)
                    ->bindValue(':morada', $localizacao)
                    ->bindValue(':dataIni', $dataInicio)
                    ->bindValue(':dataFim', $dataFim);


            $result = $command->queryAll();
            
            //return json_encode($command->getRawSql());
            //var_dump($result);
            $carros = array();
            
            foreach ($result as $key) {
                $carros[] = motociclo::find()->where(['id_motociclo' => $key['id_motociclo']])->one();
            }
            
            //var_dump($carros);die;
            
                
            //$model = motociclo::find()->where()->andWhere()->all(); 
            //$motociclos = \common\models\Detalhesaluguer::find()->where(['profile_id' => Yii::$app->user->getId()])->one();

            $model = $carros;
        } else {
            $model = motociclo::find()
                ->andWhere(['not like','motociclo.estado','manutencao'])
                ->all();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single motociclo model.
     * @param int $id_motociclo Id motociclo
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_motociclo)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_motociclo),
        ]);
    }

    /**
     * Creates a new motociclo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new motociclo();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_motociclo' => $model->id_motociclo]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing motociclo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_motociclo Id motociclo
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_motociclo)
    {
        $model = $this->findModel($id_motociclo);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_motociclo' => $model->id_motociclo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing motociclo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_motociclo Id motociclo
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_motociclo)
    {
        $this->findModel($id_motociclo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the motociclo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_motociclo Id motociclo
     * @return motociclo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_motociclo)
    {
        if (($model = motociclo::findOne(['id_motociclo' => $id_motociclo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
