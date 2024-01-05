<?php

namespace backend\modules\api\controllers;

use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class LoginController extends Controller
{
    public function actionLogin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');
        $user = User::find()->where(['username' => $username])->one();

        if ($user != null && Yii::$app->security->validatePassword($password, $user->password_hash)) {
            Yii::$app->user->login($user);

            $response = [
                'success' => true,
                'message' => 'Login successful.',
                'username' => $user->username,
                'email' => $user->email,
                'id' => $user->id,
            ];
            // You can set the user session here


        } else {
            $response = [
                'success' => false,
                'message' => 'Incorrect username or password.',
            ];
        }

        return $response;
    }
}
