<?php

namespace backend\modules\api\controllers;

use common\models\Assistencia;
use common\models\DetalhesAluguer;
use common\models\ExtraDetalhesAluguer;
use common\models\motociclo;
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
                "matricula" => $i->motociclo->matricula,
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
                "matricula" => $i->motociclo->matricula,
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
}
