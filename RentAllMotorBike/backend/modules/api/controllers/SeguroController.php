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
<<<<<<< HEAD
    public $modelClass = 'common\models\Motociclo';
=======
    public $modelClass = 'common\models\motociclo';
>>>>>>> da49967a756b0a4535921967b958dc43d7aa0dc1

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
