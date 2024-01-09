<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class detalhesAluguerCest
{
    public function _before(FunctionalTester $I)
    {
        //$I->amOnPage('rentalMotorBike/frontend/web/index');
        $I->amOnPage('/');

        //login de user
        $I->click('Login');
        $I->fillField('LoginForm[username]', 'aula2');
        $I->fillField('LoginForm[password]', 'aula21234');
        $I->click(['name' => 'login-button']);
        $I->dontSee('Login');

        //ver todos os motociclos
        $I->click(['name' => 'btnProcurarmotociclo']);
        //ver o carro com o id = 1
        $I->click(['name' => 'vermotociclo_1']);
        //comecar a reserva
        $I->click(['name' => 'btnReservar']);
        
    }

    public function createDetalhesAluguerEmptyFields(FunctionalTester $I)
    {
        //preencher o form com os dados do aluguer
        $I->checkOption('Via-Verde');
        $I->click(['name' => 'btnCriarDetalhesAluguer']);
        
        $I->see('Seguro cannot be blank', 'div');
        $I->see('Localizacao Levantamento cannot be blank.');
        $I->see('Localizacao Devolucao cannot be blank.');
    }

    public function createDetalhesAluguer(FunctionalTester $I)
    {
        //preencher o form com os dados do aluguer
        $I->fillField(['name' => 'DetalhesAluguer[data_inicio]'], '2023-01-23T12:00');
        $I->fillField(['name' => 'DetalhesAluguer[data_fim]'], '2023-01-23T12:00');
        $I->selectOption('DetalhesAluguer[seguro_id]', '2');
        $I->selectOption('DetalhesAluguer[localizacao_levantamento_id]', '1');
        $I->selectOption('DetalhesAluguer[localizacao_devolucao_id]', '1');        
        $I->checkOption('Via-Verde');
        $I->click(['name' => 'btnCriarDetalhesAluguer']);
        $I->dontSee('cannot be blank');
        $I->seeRecord('common\models\Detalhesaluguer', ['data_inicio' => '2023-01-23 12:00:00', 'data_fim' => '2023-01-23 12:00:00']);
    }
}
