<?php

namespace backend\modules\api\controllers;

use common\models\Analise;
use Psy\Util\Json;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;


class AnaliseController extends \yii\web\Controller
{
    public $modelClass = 'common\models\Analise';

    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {

            $veiculo = Analise::find()->all();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $veiculo;
        }
    }

    //http://localhost:8888/equipamento/total
    public function actionTotal()
    {
        $eqpmodel = new $this->modelClass;
        $recs = $eqpmodel::find()->all();
        return ['total' => count($recs)];
    }

}
