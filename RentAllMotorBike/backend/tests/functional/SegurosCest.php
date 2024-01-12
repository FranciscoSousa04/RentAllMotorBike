<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\models\Seguro;
use common\fixtures\UserFixture;
use yii\helpers\Url;

class SegurosCest
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

    public function criarSeguros(FunctionalTester $I)
    {
        $I->see('Create Profile');

        $I->click('Seguros');

        $I->click('#create-seguros');

        $I->fillField('Seguro[marca]', 'Tranquilidade');
        $I->fillField('Seguro[cobertura]', '1000');
        $I->fillField('Seguro[preco]', '19.99');

        $I->click('Save');

        $I->seeRecord(Seguro::className(), ['marca'=>'Tranquilidade']);
    }


}
