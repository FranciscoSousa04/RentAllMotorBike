<?php


namespace frontend\tests\Acceptance;

use frontend\tests\AcceptanceTester;

class detalhesAluguerCreateCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('rentalMotorBike/frontend/web/index');
        $I->wait(3);

        $I->click('Login');
        $I->fillField('LoginForm[username]', 'aula2');
        $I->fillField('LoginForm[password]', 'aula21234');
        $I->click(['name' => 'login-button']);
        $I->wait(1);
        $I->click(['name' => 'btnProcurarmotociclo']);
        $I->wait(1);
        $I->scrollTo(['name' => 'vermotociclo_1']);
        $I->wait(2);
        $I->click(['name' => 'vermotociclo_1']); //ver o carro com o id = 1
        $I->wait(1);
        $I->click(['name' => 'btnReservar']);
        $I->wait(1);
        $I->click(['name' => 'DetalhesAluguer[data_inicio]']);
        $I->wait(1);

        //preencher o form com os dados do aluguer
        $I->fillField(['name' => 'DetalhesAluguer[data_inicio]'], '2023-01-10T12:00');
        $I->fillField(['name' => 'DetalhesAluguer[data_fim]'], '2023-01-11T12:00');
        $I->selectOption('DetalhesAluguer[seguro_id]', 'Seguro de danos próprios');
        $I->selectOption('DetalhesAluguer[localizacao_levantamento_id]', 'Leiria');
        $I->selectOption('DetalhesAluguer[localizacao_devolucao_id]', 'Leiria');
        $I->scrollTo(['name' => 'btnCriarDetalhesAluguer']);
        $I->wait(1);
        $I->checkOption('Via-Verde');
        $I->click(['name' => 'btnCriarDetalhesAluguer']);
        $I->wait(5);

    }
}
