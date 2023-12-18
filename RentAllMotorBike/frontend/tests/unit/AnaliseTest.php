<?php


namespace frontend\tests\Unit;

use common\models\Analise;
use frontend\tests\UnitTester;

class AnaliseTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testDataNull(){

        $analise = new Analise();

        //testar com os dados null

        $analise->comentario = null;
        $this->assertFalse($analise->validate(['comentario']));

        $analise->classificacao = null;
        $this->assertFalse($analise->validate(['classificacao']));

        $analise->data_analise = null;
        $this->assertFalse($analise->validate(['data_analise']));

        $analise->profile_id = null;
        $this->assertFalse($analise->validate(['profile_id']));
    }

    public function testWrongData(){

        $analise = new Analise();

        //testar com os dados de tipo errado

        $analise->comentario = 123;
        $this->assertFalse($analise->validate(['comentario']));

        $analise->classificacao = 'null';
        $this->assertFalse($analise->validate(['classificacao']));

        $analise->profile_id = 'null';
        $this->assertFalse($analise->validate(['profile_id']));
    }

    public function testNotExistingData(){

        $analise = new Analise();

        //testar com dados que nao existem

        $analise->profile_id = 1000;
        $this->assertFalse($analise->validate(['profile_id']));
    }

    public function testCorrectData()
    {
        $analise = new Analise();

        //testar com dados corretos

        $analise->comentario = 'TESTE';
        $analise->classificacao = 4;
        $analise->data_analise = '2022-12-16';
        $analise->profile_id = 7;

        $this->assertTrue($analise->validate([$analise->comentario]));
        $this->assertTrue($analise->validate([$analise->classificacao]));
        $this->assertTrue($analise->validate([$analise->data_analise]));
        $this->assertTrue($analise->validate([$analise->profile_id]));
    }

    public function testSavingÃnalise()
    {
        //create
        $analise = new Analise();
        $analise->comentario = 'TESTE';
        $analise->classificacao = 5;
        $analise->data_analise = '2022-12-17';
        $analise->profile_id = 3;
        $analise->save();
        $this->tester->seeRecord('common\models\Analise', ['comentario' => 'TESTE']);

        //update
        $altera = $this->tester->grabRecord('common\models\Analise', ['comentario' => 'TESTE']);
        $altera->comentario = 'miniteste';
        $altera->save();
        $this->tester->seeRecord('common\models\Analise', ['comentario' => 'miniteste']);
        $this->tester->dontSeeRecord('common\models\Analise', ['comentario' => 'TESTE']);

        //delete
        $altera->delete();
        $this->tester->dontSeeRecord('common\models\Analise', ['comentario' => 'miniteste']);

    }
}
