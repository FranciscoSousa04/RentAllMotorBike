<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnRoute(Url::toRoute('/site/index'));
        $I->see('My Application');

        $I->seeLink('Sobre');
        //$I->click('Sobre');
        $I->selectOption('Sobre', 'Serviço');
        $I->wait(2); // wait for page to be opened

        $I->see('Serviço');
    }
}
