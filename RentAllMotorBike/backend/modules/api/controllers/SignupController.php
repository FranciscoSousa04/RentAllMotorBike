<?php

namespace backend\modules\api\controllers;

use backend\models\SignupForm;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

class SignupController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    /**
     * Signup action.
     *
     * @return array
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->validate() && $model->signup()) {
            return [
                'status' => 'success',
                'data' => 'User has been created successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => $model->errors
            ];
        }
    }
}
