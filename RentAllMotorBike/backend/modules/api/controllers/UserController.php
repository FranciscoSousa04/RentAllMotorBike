<?php

namespace backend\modules\api\controllers;

use backend\models\SignupForm;
use common\models\Profile;
use common\models\User;
use Yii;
use yii\base\Behavior;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the api module
 */
class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function init()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        parent::init();
        \Yii::$app->user->enableSession = false;
    }

    /*public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            //’except' => ['index', 'view'],
            'auth' => [$this, 'auth']
        ];
        return $behaviors;
    }*/

    public function auth($username, $password)
    {
        $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            return $user;
        }
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    }

    public function actionLogin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');
        $user = User::find()->where(['username' => $username])->one();

        if ($user != null && Yii::$app->security->validatePassword($password, $user->password_hash)) {
            $role = array_keys(Yii::$app->authManager->getRolesByUser($user->id))[0];
            $response = [
                'success' => true,
                'message' => 'Login successful.',
                'username' => $user->username,
                'email' => $user->email,
                'role' => $role,
                'id' => $user->id,
            ];
            // You can set the user session here
            Yii::$app->user->login($user);
        } else {
            $response = [
                'success' => false,
                'message' => 'Incorrect username or password.',
            ];
        }

        return $response;
    }


    public function actionSignup()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');
        $email = $request->post('email');
        $nome = $request->post('nome');
        $apelido = $request->post('apelido');
        $telemovel = $request->post('telemovel');
        $nif = $request->post('nif');
        $nr_carta_conducao = $request->post('nr_carta_conducao');

        $verifica = User::findOne(['username' => $username]);
        $verifica2 = User::findOne(['email' => $email]);
        if ($verifica !== null && $verifica2 !== null) {
            return ['exists' => true];
        }

        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->save(false);

        //no signUp é atribuido o role de cliente
        $auth = Yii::$app->authManager;
        $cliente = $auth->getRole('cliente');
        $auth->assign($cliente, $user->getId());
        $user->save();

        $profile = new Profile();
        $profile->id_profile = $user->id;
        $profile->nome = $nome;
        $profile->apelido = $apelido;
        $profile->nif = $nif;
        $profile->telemovel = $telemovel;
        $profile->nr_carta_conducao = $nr_carta_conducao;
        $profile->save();
        if ($profile->save()) {
            return [
                'status' => 'success',
                'data' => 'User has been created successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => $user->errors,
                'erros'=>$profile->errors
            ];
        }
    }

    public
    function actionUpdateuser($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');
        $email = $request->post('email');
        $model = User::findOne($id);
        $model->username = $username;
        $model->email = $email;
        //$model->password = $password;
        $headers = Yii::$app->getRequest()->getHeaders();
        $headers->set('auth', 'YOUR_AUTH_TOKEN');
        if ($model->validate() && $model->save()) {
            return [
                'status' => 'success',
                'data' => 'User has been updated successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => $model->errors
            ];
        }
    }

    public
    function actionUpdateprofile($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $nome = $request->post('nome');
        $apelido = $request->post('apelido');
        $telemovel = $request->post('telemovel');
        $nr_carta_conducao = $request->post('nr_carta_conducao');
        $model = Profile::findOne($id);
        $model->nome = $nome;
        $model->apelido = $apelido;
        $model->telemovel = $telemovel;
        $model->nr_carta_conducao = $nr_carta_conducao;

        $headers = Yii::$app->getRequest()->getHeaders();
        $headers->set('auth', 'YOUR_AUTH_TOKEN');
        if ($model->validate() && $model->save()) {
            return [
                'status' => 'success',
                'message' => 'Profile has been updated successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => $model->errors
            ];
        }
    }

    public
    function actionSignupprofile($username)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $nome = $request->post('nome');
        $apelido = $request->post('apelido');
        $telemovel = $request->post('telemovel');
        $nif = $request->post('nif');

        $nr_carta_conducao = $request->post('nr_carta_conducao');
        $teste = User::findOne($username)->id;
        $profile = new Profile();
        $profile->id_profile = $teste;
        $profile->nome = $nome;
        $profile->apelido = $apelido;
        $profile->telemovel = $telemovel;
        $profile->nif = $nif;

        $profile->nr_carta_conducao = $nr_carta_conducao;
        $profile->save();
    }

    public
    function actionViewprofile($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $veiculo = Profile::findOne($id);

        return $veiculo;

    }
}