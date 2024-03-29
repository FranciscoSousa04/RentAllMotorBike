<?php

namespace backend\modules\api\controllers;

use backend\models\SignupForm;
use common\models\LoginForm;
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
use function Symfony\Component\String\u;

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


    public function actionLogin($username, $password)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new LoginForm();
        $model->username = $username;
        $model->password = $password;

        if ($model->login()) {
            $profile = Profile::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
            $user = (object) [
                'id_profile' => $profile->id_profile,
                'username' => Yii::$app->user->identity->username,
                'nome' => $profile->nome,
                'apelido' => $profile->apelido,
                'telemovel' => $profile->telemovel,
                'nif' => $profile->nif,
                'nr_cartaconducao' => $profile->nr_cartaconducao,
                'role' => array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0],
                'email' => Yii::$app->user->identity->email,
            ];

            return $user;
        }
        return null;
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
        $email = $request->post('email');
        $nome = $request->post('nome');
        $apelido = $request->post('apelido');
        $telemovel = $request->post('telemovel');
        $nif = $request->post('nif');
        $carta = $request->post('carta');

        
        $userprofile = Profile::find()->where(['id_profile' => $id])->One();
        $user = user::find()->where(['id' => $userprofile->id_user])->One();

        $user->username = $username;
        $user->email = $email;
        $userprofile->nome = $nome;
        $userprofile->apelido = $apelido;
        $userprofile->telemovel = (int)$telemovel;
        $userprofile->nif = (int)$nif;
        $userprofile->nr_cartaconducao = $carta;
        
        if ($user->validate() && $user->save() && $userprofile->validate() && $userprofile->save() ) {
            return [
                'status' => 'success',
                'data' => 'User has been updated successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => $user->errors
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
        $model->nr_cartaconducao = $nr_carta_conducao;

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

    public function actionViewprofile($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $motociclo = Profile::findOne($id);

        return $motociclo;

    }
}