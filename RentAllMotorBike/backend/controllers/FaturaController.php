<?php

namespace backend\controllers;

use common\models\Fatura;
use common\models\Detalhesaluguer;
use common\models\FaturaSearch;
use common\models\LinhaFatura;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii;



/**
 * FaturaController implements the CRUD actions for Fatura model.
 */
class FaturaController extends Controller
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
     * Lists all Fatura models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FaturaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fatura model.
     * @param int $id_fatura Id Fatura
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($detalhes_aluguer_fatura_id)
    {
        $id_fatura=Fatura::findOne(['detalhes_aluguer_fatura_id'=>$detalhes_aluguer_fatura_id]);
        return $this->render('view', [
            'model' => $this->findModel($id_fatura),
        ]);
    }

    /**
     * Creates a new Fatura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_detalhes_aluguer)
    {
        $model = new Fatura();

        $model->data_fatura = date("Y-m-d H:i:s");
        $model->detalhes_aluguer_fatura_id = $id_detalhes_aluguer;

        //obter o registo detalhesAluguer
        $detalhesAluguer = $model->detalhesAluguerFatura;

        $precoTotal = 0;
        $nrDias = 0;

        //calculo do nr de dias do aluguer
        $dataIni = date_create($detalhesAluguer->data_inicio);
        $dataFim = date_create($detalhesAluguer->data_fim);
        $dataDiff = date_diff($dataIni, $dataFim);
        $nrDias = (int)$dataDiff->format("%a");
        $nrDias++;

        //calculo do preco total
        foreach ($detalhesAluguer->extraDetalhesAluguers as $extraDetalhesAl) {
            $precoTotal += $extraDetalhesAl->extra->preco;
        }
        $precoTotal = ($detalhesAluguer->motociclo->preco + $precoTotal + $detalhesAluguer->seguro->preco) * $nrDias;

        $model->preco_total = $precoTotal;

        //fazer save da tabela fatura
        $model->save();

        //cada item do detalhesAluguer = nova linha fatura
        /*
            linhaFatura 
            id 1: VW Golf, preco
            id 2: Seguro, preco
            id 3: localizacao recolha
            id 4: localizacao entrega
            id 5: extra 1, preco
            id 6: extra 2, preco
        */

        $itemFatura = array(
            array($detalhesAluguer->motociclo->marca . ' ' . $detalhesAluguer->motociclo->modelo, $detalhesAluguer->motociclo->preco),
            array($detalhesAluguer->seguro->marca . ' ' . $detalhesAluguer->seguro->cobertura, $detalhesAluguer->seguro->preco),
            array($detalhesAluguer->localizacaoLevantamento->localizacao, null),
            array($detalhesAluguer->localizacaoDevolucao->localizacao, null),
        );
        
        foreach($detalhesAluguer->extraDetalhesAluguers as $extra){
            $itemFatura[] = array($extra->extra->descricao, $extra->extra->preco);
        }

        //correr o array e criar uma nova linhaFatura para cada item do array
        foreach($itemFatura as $item){
            $linhaFatura = new LinhaFatura();
            $linhaFatura->descricao = $item[0];        
            $linhaFatura->preco = $item[1];        
            $linhaFatura->fatura_id = $model->id_fatura;
            $linhaFatura->save();
        }

        //var_dump($itemFatura);
        //var_dump(count($detalhesAluguer->extraDetalhesAluguers));die;

        /*return $this->render('create', [
            'model' => $model,
        ]);*/

        //return $this->redirect(['detalhesaluguer/view', 'id_detalhes_aluguer' => $id_detalhes_aluguer]);
        return $this->redirect(['detalhesaluguer/index']);
    }

    /**
     * Updates an existing Fatura model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_fatura Id Fatura
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_fatura)
    {
        $model = $this->findModel($id_fatura);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_fatura' => $model->id_fatura]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fatura model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_fatura Id Fatura
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_fatura)
    {
        $this->findModel($id_fatura)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Fatura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_fatura Id Fatura
     * @return Fatura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_fatura)
    {
        if (($model = Fatura::findOne(['id_fatura' => $id_fatura])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
