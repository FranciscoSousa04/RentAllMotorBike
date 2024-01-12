<?php

namespace backend\modules\api\controllers;

use common\models\Profile;
use common\models\User;
use Psy\Util\Json;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;


class ProfileController extends \yii\web\Controller
{
    public $modelClass = 'common\models\Profile';
    public function init()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        parent::init();
        \Yii::$app->user->enableSession = false;
    }
    public function actionIndex()
    {

        $motociclo = Profile::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $motociclo;

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

    public function actionView($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $motociclo = Profile::findOne($id);

        return $motociclo;

    }

}