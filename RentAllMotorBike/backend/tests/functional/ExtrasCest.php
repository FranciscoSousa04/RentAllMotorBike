<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\models\Extra;
use common\fixtures\UserFixture;
use yii\helpers\Url;

class ExtrasCest
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

    public function criarExtras(FunctionalTester $I)
    {
        $I->see('Create Profile');

        $I->click('Extras');

        $I->click('#create-extra');

        $I->fillField('Extra[descricao]', 'ola boa tarde');
        $I->fillField('Extra[preco]', '19.99');

        $I->click('Save');

        $I->seeRecord(Extra::className(), ['descricao'=>'ola boa tarde']);
    }


}
