<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\models\Localizacao;
use common\fixtures\UserFixture;
use yii\helpers\Url;

class LocalizacaoCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'admin');
        $I->seeInField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->seeInField('LoginForm[password]', 'admin123');
        $I->click('#login-form button[type=submit]');

    }

    // tests

    public function criarLocalizacao(FunctionalTester $I)
    {
        $I->see('Create Profile');

        $I->click('Localizações');

        $I->click('#create-localizacao');

        $I->fillField('Localizacao[localizacao]', 'grecia');
        $I->fillField('Localizacao[morada]', 'rua da grecia');
        $I->fillField('Localizacao[codigo_postal]', '1234-123');

        $I->click('Save');

        $I->seeRecord(Localizacao::className(), ['localizacao'=>'grecia']);
    }


}
