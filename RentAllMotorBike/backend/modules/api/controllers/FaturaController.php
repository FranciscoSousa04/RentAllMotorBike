<?php

namespace backend\modules\api\controllers;

use common\models\Fatura;
use Psy\Util\Json;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;


class FaturaController extends \yii\web\Controller
{
    public $modelClass = 'common\models\Motociclo';

    public function actionIndex()
    {


            $motociclo = Fatura::find()->all();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $motociclo;

    }


    public function actionTotal()
    {
        $eqpmodel = new $this->modelClass;
        $recs = $eqpmodel::find()->all();
        return ['total' => count($recs)];
    }

}
