<?php

namespace backend\modules\api\controllers;

use common\models\DetalhesAluguer;
use common\models\ExtraDetalhesAluguer;
<<<<<<< HEAD
use common\models\Veiculo;
=======
use common\models\motociclo;
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1
use Psy\Util\Json;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\StringHelper;
use yii\rest\ActiveController;
use yii\web\Controller;


<<<<<<< HEAD
class MotocicloController extends \yii\web\Controller
{
    public $modelClass = 'common\models\Motociclo';


=======
class motocicloController extends \yii\web\Controller
{
    public $modelClass = 'common\models\motociclo';

    //http://localhost:8888/motociclo/
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1

    public function init()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        parent::init();
        \Yii::$app->user->enableSession = false;
    }

    public function actionIndex()
    {

<<<<<<< HEAD
        $motociclo = Motociclo::find()->all();
=======
        $motociclo = motociclo::find()->all();
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $motociclo;

    }

<<<<<<< HEAD
=======
    //http://localhost:8888/motociclo/total
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1
    public function actionTotal()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $eqpmodel = new $this->modelClass;
        $recs = $eqpmodel::find()->all();
        return ['total' => count($recs)];
    }

<<<<<<< HEAD
=======
    //http://localhost:8888/motociclo/view?id=1
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1
    public function actionView($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

<<<<<<< HEAD
        $motociclo = Motociclo::findOne($id);
=======
        $motociclo = motociclo::findOne($id);
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1

        return $motociclo;

    }


<<<<<<< HEAD
=======
    //http://localhost:8888/motociclo/view?id=1
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1
    public function actionCreate($data_inicio, $data_fim ,$motociclo_id, $profile_id, $seguro_id, $localizacaol, $localizacaod)
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new DetalhesAluguer();
      //  $model->extras = $this->request->post()['DetalhesAluguer']['extras'];
/*
        if ($selecteditems != null)
            foreach ($selecteditems as $extradetalhes) {
                $extradetalhesaluguer = new ExtraDetalhesAluguer();
                $extradetalhesaluguer->extra_id = $extradetalhes;
                $extradetalhesaluguer->detalhes_aluguer_id = $model->id_detalhes_aluguer;
                $extradetalhesaluguer->save();
            }*/
        $model->data_inicio = date('Y-m-d H:i', strtotime($data_inicio));
        $model->data_fim = date('Y-m-d H:i', strtotime($data_fim));
        $model->motociclo_id = $motociclo_id;
        $model->profile_id = $profile_id;
        $model->seguro_id = $seguro_id;
        $model->localizacao_levantamento_id = $localizacaol;
        $model->localizacao_devolucao_id = $localizacaod;
        $headers = Yii::$app->getRequest()->getHeaders();
        $headers->set('auth', 'YOUR_AUTH_TOKEN');
        if ($model->save()) {

            return [
                'status' => 'success',
                'message' => 'detalhes has been created successfully.',
                'idreserva' => $model->id_detalhes_aluguer
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => $model->errors,
                'teste' => $motociclo_id

            ];
        }
    }

    public function actsionCreate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $nome = $request->post('nome');
        $apelido = $request->post('apelido');
        $telemovel = $request->post('telemovel');
        $nr_carta_conducao = $request->post('nr_carta_conducao');
        $nome = $request->post('nome');
        $apelido = $request->post('apelido');
        $telemovel = $request->post('telemovel');
        $nr_carta_conducao = $request->post('nr_carta_conducao');

<<<<<<< HEAD
        $model = new Motociclo();
=======
        $model = new motociclo();
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1
        $model->marca = "tesete";
        $model->modelo = "tesete";
        $model->combustivel = "tesete";
        $model->preco = 123;
        $model->matricula = "tesete";
        $model->descricao = "tesete";
        $model->estado = "pronto";
<<<<<<< HEAD
        $model->tipo_veiculo_id = 1;
=======
        $model->tipo_motociclo_id = 1;
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1
        $model->localizacao_id = 1;
        $model->franquia = 12;
        if ($model->save()) {
            return [
                'status' => 'success',
                'message' => 'Reserva created successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Error creating profile.'
            ];
        }
    }
}
