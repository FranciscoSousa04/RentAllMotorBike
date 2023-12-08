<?php
namespace controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        //create funcionario
        $createFuncionario = $auth->createPermission('createFuncionario');
        $auth->add($createFuncionario);

        //view funcionario
        $viewFuncionario = $auth->createPermission('viewFuncionario');
        $auth->add($viewFuncionario);

        //update funcionario
        $updateFuncionario = $auth->createPermission('updateFuncionario');
        $auth->add($updateFuncionario);

        //delete funcionario
        $deleteFuncionario = $auth->createPermission('deleteFuncionario');
        $auth->add($deleteFuncionario);


        //login backend
        $loginBackend = $auth->createPermission('loginBackend');
        $auth->add($loginBackend);

        //criar o role cliente e associar o crud analise
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);

        //criar o role gestor e associar os crud de motociclos, seguros, localizacoes, extra
        $gestor = $auth->createRole('gestor');
        $auth->add($gestor);

        $auth->addChild($gestor, $loginBackend);

        //criar admin e associar o crud funcionarios e todas as permissões do gestor
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createFuncionario);
        $auth->addChild($admin, $viewFuncionario);
        $auth->addChild($admin, $updateFuncionario);
        $auth->addChild($admin, $deleteFuncionario);

        $auth->addChild($admin, $gestor);

        //assign user id = 1 to admin role
        $auth->assign($admin, 1);
    }
}