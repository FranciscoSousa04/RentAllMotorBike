<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        //create veiculo
        $createVeiculo = $auth->createPermission('createVeiculo');
        $auth->add($createVeiculo);

        //update veiculo
        $updateVeiculo = $auth->createPermission('updateVeiculo');
        $auth->add($updateVeiculo);

        //delete veiculo
        $deleteVeiculo = $auth->createPermission('deleteVeiculo');
        $auth->add($deleteVeiculo);

        //create imagem (tirar fotos aos veiculos)
        $createImagem = $auth->createPermission('createImagem');
        $auth->add($createImagem);

        //delete imagem
        $deleteImagem = $auth->createPermission('deleteImagem');
        $auth->add($deleteImagem);

        //create seguro
        $createSeguro = $auth->createPermission('createSeguro');
        $auth->add($createSeguro);

        //update seguro
        $updateSeguro = $auth->createPermission('updateSeguro');
        $auth->add($updateSeguro);

        //delete seguro
        $deleteSeguro = $auth->createPermission('deleteSeguro');
        $auth->add($deleteSeguro);

        //create localizacao
        $createLocalizacao = $auth->createPermission('createLocalizacao');
        $auth->add($createLocalizacao);

        //update localizacao
        $updateLocalizacao = $auth->createPermission('updateLocalizacao');
        $auth->add($updateLocalizacao);

        //delete localizacao
        $deleteLocalizacao = $auth->createPermission('deleteLocalizacao');
        $auth->add($deleteLocalizacao);

        //create extra
        $createExtra = $auth->createPermission('createExtra');
        $auth->add($createExtra);

        //update extra
        $updateExtra = $auth->createPermission('updateExtra');
        $auth->add($updateExtra);

        //delete extra
        $deleteExtra = $auth->createPermission('deleteExtra');
        $auth->add($deleteExtra);

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

        //create analise
        $createAnalise = $auth->createPermission('createAnalise');
        $auth->add($createAnalise);

        //update analise
        $updateAnalise = $auth->createPermission('updateAnalise');
        $auth->add($updateAnalise);

        //delete analise
        $deleteAnalise = $auth->createPermission('deleteAnalise');
        $auth->add($deleteAnalise);

        //create reserva
        $createReserva = $auth->createPermission('createReserva');
        $auth->add($createReserva);

        //view reserva
        $viewReserva = $auth->createPermission('viewReserva');
        $auth->add($viewReserva);

        //update reserva
        $updateReserva = $auth->createPermission('updateReserva');
        $auth->add($updateReserva);

        //delete reserva
        $deleteReserva = $auth->createPermission('deleteReserva');
        $auth->add($deleteReserva);

        //login backend
        $loginBackend = $auth->createPermission('loginBackend');
        $auth->add($loginBackend);

        //criar o role cliente e associar o crud analise
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);
        $auth->addChild($cliente, $createAnalise);
        $auth->addChild($cliente, $updateAnalise);
        $auth->addChild($cliente, $deleteAnalise);

        $auth->addChild($cliente, $createReserva);
        $auth->addChild($cliente, $updateReserva);
        $auth->addChild($cliente, $viewReserva);
        $auth->addChild($cliente, $deleteReserva);

        //criar o role gestor e associar os crud de veiculos, seguros, localizacoes, extra
        $gestor = $auth->createRole('gestor');
        $auth->add($gestor);
        $auth->addChild($gestor, $createVeiculo);
        $auth->addChild($gestor, $updateVeiculo);
        $auth->addChild($gestor, $deleteVeiculo);

        $auth->addChild($gestor, $createImagem);
        $auth->addChild($gestor, $deleteImagem);

        $auth->addChild($gestor, $createExtra);
        $auth->addChild($gestor, $updateExtra);
        $auth->addChild($gestor, $deleteExtra);

        $auth->addChild($gestor, $createSeguro);
        $auth->addChild($gestor, $updateSeguro);
        $auth->addChild($gestor, $deleteSeguro);

        $auth->addChild($gestor, $createLocalizacao);
        $auth->addChild($gestor, $updateLocalizacao);
        $auth->addChild($gestor, $deleteLocalizacao);

        $auth->addChild($gestor, $loginBackend);
        $auth->addChild($gestor, $viewReserva);

        //criar admin e associar o crud funcionarios e todas as permissões do gestor
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createFuncionario);
        $auth->addChild($admin, $viewFuncionario);
        $auth->addChild($admin, $updateFuncionario);
        $auth->addChild($admin, $deleteFuncionario);

        $auth->addChild($admin, $gestor);

        $auth->removeChild($admin, $createImagem);
        $auth->removeChild($admin, $deleteImagem);

        //assign user id = 1 to admin role
        $auth->assign($admin, 1);
    }
}