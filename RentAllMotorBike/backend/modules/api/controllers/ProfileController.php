<?php

namespace backend\modules\api\controllers;

use common\models\Motociclo;
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
    public $modelClass = 'common\models\Motociclo';


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


    public function actionTotal()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $eqpmodel = new $this->modelClass;
        $recs = $eqpmodel::find()->all();
        return ['total' => count($recs)];
    }


    public function actionView($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $motociclo = Profile::findOne($id);

        if ($motociclo === null) {
            // Profile not found, you may want to handle this case
            return ['error' => 'Profile not found'];
        }

        return $motociclo;
    }




}