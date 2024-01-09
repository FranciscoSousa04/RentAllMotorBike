<?php

namespace backend\modules\api\controllers;

use common\models\Extra;
use Psy\Util\Json;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;


class ExtraController extends \yii\web\Controller
{
    public $modelClass = 'common\models\Extra';

    public function init()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        parent::init();
        \Yii::$app->user->enableSession = false;
    }

    public function actionIndex()
    {
        $extra = Extra::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $extra;

    }

    //http://localhost:8888/equipamento/total
    public function actionTotal()
    {
        $eqpmodel = new $this->modelClass;
        $recs = $eqpmodel::find()->all();
        return ['total' => count($recs)];
    }

    public function actionCreate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $descricao = $request->post('descricao');
        $preco = $request->post('preco');

        $model = new Extra();
        $model->descricao = $descricao;
        $model->preco = $preco;
        $headers = Yii::$app->getRequest()->getHeaders();
        $headers->set('auth', 'YOUR_AUTH_TOKEN');
        if ($model->save()) {
            return [
                'status' => 'success',
                'message' => 'Profile created successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => $model->errors
            ];
        }
    }

    public function actionUpdate($descricao, $apelido)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;

        $model = new Extra();
        $model->descricao = $descricao;
        $model->preco = $apelido;

        if ($model->save()) {
            return [
                'status' => 'success',
                'message' => 'Profile created successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => $model->errors
            ];
        }
    }

}
