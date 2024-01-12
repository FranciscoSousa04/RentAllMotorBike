<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\models\Tipomotociclo;
use common\fixtures\UserFixture;
use yii\helpers\Url;

class TipomotociclosCest
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

    public function criarTipomotociclo(FunctionalTester $I)
    {
        $I->see('Create Profile');

        $I->click('Tipomotociclos');

        $I->click('#create-tipomotociclo');

        $I->fillField('Tipomotociclo[categoria]', 'motocross');

        $I->click('Save');

        $I->seeRecord(Tipomotociclo::className(), ['categoria'=>'motocross']);
    }


}
