<?php

namespace backend\modules\api\controllers;

use common\models\Assistencia;
use common\models\DetalhesAluguer;
use common\models\ExtraDetalhesAluguer;

use common\models\Motociclo;
use Psy\Util\Json;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\StringHelper;
use yii\rest\ActiveController;
use yii\web\Controller;


class ReservaController extends \yii\web\Controller
{

    public function actionReservas($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $reservas = DetalhesAluguer::find()->where(['profile_id' => $id])->orderBy(['data_inicio' => SORT_ASC])->all();
        $reserva = array();
        $precoExtras = 0;
        /*foreach ($i->extraDetalhesAluguers as $extraDetalhesAl) {
            $precoExtras += $extraDetalhesAl->extra->preco;
        }*/
        foreach ($reservas as $i) {
            $reserva[] = array(
                $dataIni = date_create($i->data_inicio),
                $dataFim = date_create($i->data_fim),
                $dataDiff = date_diff($dataIni, $dataFim),
                $dias = (int)$dataDiff->format("%a"),
                $dias++,
                "id_reserva" => $i->id_detalhes_aluguer,
                "data_inicio" => date("d/m/Y", strtotime($i->data_inicio)),
                "data_fim" => date("d/m/Y", strtotime($i->data_fim)),
                "motociclo_id" => $i->motociclo_id,
                "marca" => $i->motociclo->marca,
                "modelo" => $i->motociclo->modelo,
                "profile_id" => $i->profile_id,
                "seguro_id" => $i->seguro_id,
                "seguro" => $i->seguro->cobertura,
                "localizacao_levantamento" => $i->localizacaoLevantamento->localizacao,
                "localizacao_devolucao" => $i->localizacaoLevantamento->localizacao,
                "preco" => (($i->motociclo->preco + $precoExtras) * $dias)
            );
        }
        return $reserva;
    }

    public function actionTodasreservas()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $reservas = DetalhesAluguer::find()->all();
        $listaReservas = array();
        $precoExtras = 0;

        foreach ($reservas as $i) {
            $listaReservas[] = array(
                $dataIni = date_create($i->data_inicio),
                $dataFim = date_create($i->data_fim),
                $dataDiff = date_diff($dataIni, $dataFim),
                $dias = (int)$dataDiff->format("%a"),
                $dias++,
                "id_reserva" => $i->id_detalhes_aluguer,
                "data_inicio" => date("d/m/Y", strtotime($i->data_inicio)),
                "data_fim" => date("d/m/Y", strtotime($i->data_fim)),
                "motociclo_id" => $i->motociclo_id,
                "marca" => $i->motociclo->marca,
                "modelo" => $i->motociclo->modelo,
                "profile_id" => $i->profile_id,
                "seguro_id" => $i->seguro_id,
                "seguro" => $i->seguro->cobertura,
                "localizacao_levantamento" => $i->localizacaoLevantamento->localizacao,
                "localizacao_devolucao" => $i->localizacaoLevantamento->localizacao,
                "preco" => (($i->motociclo->preco + $precoExtras) * $dias)
            );
        }

        return $listaReservas;
    }

    public function actionRemoverreserva($id)
    {
        $extraDetalhes = ExtraDetalhesAluguer::find()->where(['id_extra_detalhes_aluguer' => $id])->all();

        if ($extraDetalhes != null) {
            for ($i = 0; $i < count($extraDetalhes); $i++) {
                $extraDetalhes[$i]->delete();
            }
        }
        $removerReserva = DetalhesAluguer::find()->where(['id_detalhes_aluguer' => $id])->One();
        $removerReserva->delete();
    }


    //http://localhost:8888/motociclo/view?id=1
    public function actionPedido($idprofile, $idmotociclo, $etmensagem, $etlocalizacao, $etestado)

    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new Assistencia();
        $model->data_pedido = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');;

        $model->motociclo_id = $idmotociclo;

        $model->profile_id = $idprofile;
        $model->condicao = $etestado;
        $model->mensagem = $etmensagem;
        $model->localizacao = $etlocalizacao;
        $headers = Yii::$app->getRequest()->getHeaders();
        $headers->set('auth', 'YOUR_AUTH_TOKEN');

        if ($model->save()) {

            return [
                'status' => 'success',
                'message' => 'Pedido has been created successfully.',
                'idpedido' => $model->id_assistencia
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => $model->errors,
            ];
        }
    }

    public function actionCreate()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $detalhesAluguer = new DetalhesAluguer();

        $resquest = Yii::$app->request;

        // $detalhesAluguer->data_inicio = date('Y-m-d H:i', strtotime($resquest->post('data_inicio')));
        //$detalhesAluguer->data_fim = date('Y-m-d H:i', strtotime($resquest->post('data_fim')));

        $detalhesAluguer->data_inicio = $resquest->post('data_inicio');
        $detalhesAluguer->data_fim = $resquest->post('data_fim');
        $detalhesAluguer->motociclo_id = $resquest->post('motociclo_id');
        $detalhesAluguer->profile_id = $resquest->post('profile_id');
        $detalhesAluguer->seguro_id = $resquest->post('seguro_id');
        $detalhesAluguer->localizacao_levantamento_id = $resquest->post('localizacao_levantamento');
        $detalhesAluguer->localizacao_devolucao_id = $resquest->post('localizacao_devulocao');
        //$headers = Yii::$app->getRequest()->getHeaders();
        // $headers->set('auth', 'YOUR_AUTH_TOKEN');
        //var_dump($resquest->post('data_inicio'));die();
        if ($detalhesAluguer->save()) {

            return [
                'status' => 'success',
                'message' => 'detalhes has been created successfully.',
                'idreserva' => $detalhesAluguer->id_detalhes_aluguer
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => $detalhesAluguer->errors,


            ];
        }
    }
}
