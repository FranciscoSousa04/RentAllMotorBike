<?php

namespace backend\modules\api\controllers;

use common\models\Seguro;
use Psy\Util\Json;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\Controller;


class SeguroController extends \yii\web\Controller
{
    public $modelClass = 'common\models\Motociclo';

    public function actionIndex()
    {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $data = Seguro::find()->asArray()->all();

            return $data;

    }

    //http://localhost:8888/equipamento/total
    public function actionTotal()
    {
        $eqpmodel = new $this->modelClass;
        $recs = $eqpmodel::find()->all();
        return ['total' => count($recs)];
    }

}
