<?php
// frontend/controllers/ClienteController.php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class ClienteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['register', 'login', /* outras ações */],
                        'allow' => true,
                        'roles' => ['?'], // Permite acesso a usuários não autenticados (visitantes)
                    ],
// ... adicione mais regras conforme necessário
                ],
            ],
        ];
    }

    public function actionRegister()
    {
        $model = new RegistrationForm(); // Substitua pelo seu modelo de registo

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User(); // Substitua pelo seu modelo de usuário

// Configurar dados do usuário
            $user->username = $model->username;
            $user->email = $model->email;
            $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);

// Salvar o usuário
            if ($user->save()) {
// Atribuir papel de cliente ao novo usuário
                $auth = Yii::$app->authManager;
                $clienteRole = $auth->getRole('cliente');
                $auth->assign($clienteRole, $user->id);

                Yii::$app->getSession()->setFlash('success', 'Registo bem-sucedido!');
                return $this->redirect(['login']);
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

// ... outras ações conforme necessário
}
