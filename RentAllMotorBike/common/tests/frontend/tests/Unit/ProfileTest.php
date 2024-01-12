<?php


namespace frontend\tests\Unit;

use common\models\Profile;
use common\models\User;
use frontend\tests\UnitTester;

class ProfileTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    public function testDataNull(){

        $profile = new Profile();

        //testar com dados null

        $profile->id_profile = null;
        $this->assertFalse($profile->validate(['id_profile']));

        $profile->nome = null;
        $this->assertFalse($profile->validate(['nome']));

        $profile->apelido = null;
        $this->assertFalse($profile->validate(['apelido']));

        $profile->telemovel = null;
        $this->assertFalse($profile->validate(['telemovel']));

        $profile->nif =  null;
        $this->assertFalse($profile->validate(['nif']));

        $profile->nr_carta_conducao = null;
        $this->assertFalse($profile->validate(['nr_carta_conducao']));
    }

    public function testLongData(){

        $profile = new Profile();

        //testar com dados demasiado longos

        $profile->nome = '1234567890123456789012';
        $this->assertFalse($profile->validate(['nome']));

        $profile->apelido = '1234567890123456789012';
        $this->assertFalse($profile->validate(['apelido']));

        $profile->nr_carta_conducao = '1234567890123';
        $this->assertFalse($profile->validate(['nr_carta_conducao']));
    }

    public function testNotUniqueData(){

        $profile = new Profile();

        //testar com dados nao unicos
        
        $profile->telemovel = 111222333;
        $this->assertFalse($profile->validate(['telemovel']));

        $profile->nif =  111222333;
        $this->assertFalse($profile->validate(['nif']));

        $profile->nr_carta_conducao = '111222333';
        $this->assertFalse($profile->validate(['nr_carta_conducao']));
    }

    public function testWrongData(){

        $profile = new Profile();     

        //testar com dados de tipo incorreto

        $profile->id_profile = 'null';
        $this->assertFalse($profile->validate(['id_profile']));

        $profile->telemovel = '111222333';
        $this->assertFalse($profile->validate(['telemovel']));

        $profile->nif =  '111222333';
        $this->assertFalse($profile->validate(['nif']));

        $profile->nome = 11;
        $this->assertFalse($profile->validate(['nome']));

        $profile->apelido = 22;
        $this->assertFalse($profile->validate(['apelido']));

        $profile->nr_carta_conducao = 111222399;
        $this->assertFalse($profile->validate(['nr_carta_conducao']));

    }

    public function testCorrectData()
    {

        $profile = new Profile();

        //testar com dados corretos

        $profile->nome = 'teste';
        $profile->apelido = 'novo';
        $profile->telemovel = 912312312;
        $profile->nif = 21312313;
        $profile->nr_carta_conducao = '231231256';

        $this->assertTrue($profile->validate([$profile->nome]));
        $this->assertTrue($profile->validate([$profile->apelido]));
        $this->assertTrue($profile->validate([$profile->telemovel]));
        $this->assertTrue($profile->validate([$profile->nif]));
        $this->assertTrue($profile->validate([$profile->nr_carta_conducao]));

    }

    public function testSavingUser()
    {
        //criar um user
        $user= new User();
        $user->username="testenovo";
        $user->email="testenovo@gmail.com";
        $user->status=10;
        $user->auth_key='sadsadsadsadsadsa';
        $user->password_hash='$2y$13$sdasadadasd';
        $user ->save();

        //criar um profile para associar ao user
        $profile = new Profile();
        $profile->id_profile=$user->id;
        $profile->nome = 'teste';
        $profile->apelido = 'novo';
        $profile->telemovel = 912312312;
        $profile->nif = 213123013;
        $profile->nr_carta_conducao = '231231256000' ;
        $profile->save();
        $this->tester->seeRecord('common\models\Profile', ['nome' => 'teste']);

        //update
        $user = $this->tester->grabRecord('common\models\Profile', ['nome' => 'teste', 'apelido' => 'novo']);
        $user->nome = 'unidade';
        $user->apelido='usada';
        $user->save();
        $this->tester->seeRecord('common\models\Profile', ['nome' => 'unidade', 'apelido' => 'usada']);
        $this->tester->dontSeeRecord('common\models\Profile', ['nome' => 'teste', 'apelido' => 'novo']);

        //delete
        $user->delete();
        $this->tester->dontSeeRecord('common\models\Profile', ['nome' => 'unidade', 'apelido' => 'usada']);

    }
}
