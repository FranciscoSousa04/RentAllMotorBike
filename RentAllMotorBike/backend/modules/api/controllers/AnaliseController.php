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

            $motociclo = Analise::find()->all();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $motociclo;
        }
    }

<<<<<<< HEAD
=======
    //http://localhost:8888/equipamento/total
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1
    public function actionTotal()
    {
        $eqpmodel = new $this->modelClass;
        $recs = $eqpmodel::find()->all();
        return ['total' => count($recs)];
    }

}
