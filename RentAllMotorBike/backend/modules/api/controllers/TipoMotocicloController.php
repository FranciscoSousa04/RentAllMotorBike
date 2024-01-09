<?php

namespace backend\modules\api\controllers;

use common\models\Tipomotociclo;
use Psy\Util\Json;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;


class TipomotocicloController extends \yii\web\Controller
{
    public $modelClass = 'common\models\motociclo';

    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {

            $motociclo = Tipomotociclo::find()->all();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $motociclo;
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
