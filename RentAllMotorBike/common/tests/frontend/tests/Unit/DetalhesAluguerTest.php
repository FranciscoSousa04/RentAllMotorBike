<?php


namespace frontend\tests\Unit;

use frontend\tests\UnitTester;
use common\models\Detalhesaluguer;


class DetalhesAluguerTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testDataNull(){

        $detalhesaluguer = new Detalhesaluguer();

        //testar com dados null

        $detalhesaluguer->data_inicio = null;
        $this->assertFalse($detalhesaluguer->validate(['data_inicio']));

        $detalhesaluguer->data_fim = null;
        $this->assertFalse($detalhesaluguer->validate(['data_fim']));

        $detalhesaluguer->veiculo_id = null;
        $this->assertFalse($detalhesaluguer->validate(['veiculo_id']));

        $detalhesaluguer->profile_id = null;
        $this->assertFalse($detalhesaluguer->validate(['profile_id']));

        $detalhesaluguer->seguro_id = null;
        $this->assertFalse($detalhesaluguer->validate(['seguro_id']));

        $detalhesaluguer->localizacao_levantamento_id = null;
        $this->assertFalse($detalhesaluguer->validate(['localizacao_levantamento_id']));

        $detalhesaluguer->localizacao_devolucao_id = null;
        $this->assertFalse($detalhesaluguer->validate(['localizacao_devolucao_id']));
    }

    public function testWrongData(){

        $detalhesaluguer = new Detalhesaluguer();

        //testar com dados de tipo errado

        $detalhesaluguer->veiculo_id = 'null';
        $this->assertFalse($detalhesaluguer->validate(['veiculo_id']));

        $detalhesaluguer->profile_id = 'null';
        $this->assertFalse($detalhesaluguer->validate(['profile_id']));

        $detalhesaluguer->seguro_id = 'null';
        $this->assertFalse($detalhesaluguer->validate(['seguro_id']));

        $detalhesaluguer->localizacao_levantamento_id = 'null';
        $this->assertFalse($detalhesaluguer->validate(['localizacao_levantamento_id']));

        $detalhesaluguer->localizacao_devolucao_id = 'null';
        $this->assertFalse($detalhesaluguer->validate(['localizacao_devolucao_id']));
    }

    public function testNotExistingData(){

        $detalhesaluguer = new Detalhesaluguer();

        //testar com dados de tipo que nao existem

        $detalhesaluguer->veiculo_id = 1001;
        $this->assertFalse($detalhesaluguer->validate(['veiculo_id']));

        $detalhesaluguer->profile_id = 1002;
        $this->assertFalse($detalhesaluguer->validate(['profile_id']));

        $detalhesaluguer->seguro_id = 1003;
        $this->assertFalse($detalhesaluguer->validate(['seguro_id']));

        $detalhesaluguer->localizacao_levantamento_id = 1004;
        $this->assertFalse($detalhesaluguer->validate(['localizacao_levantamento_id']));

        $detalhesaluguer->localizacao_devolucao_id = 1005;
        $this->assertFalse($detalhesaluguer->validate(['localizacao_devolucao_id']));
    }

    public function testCorrectData()
    {
        $detalhesaluguer = new Detalhesaluguer();

        //testar com dados corretos

        $detalhesaluguer->data_inicio = '2022-12-05';
        $detalhesaluguer->data_fim = '2022-12-07';
        $detalhesaluguer->veiculo_id = 1 ;
        $detalhesaluguer->profile_id = 7;
        $detalhesaluguer->seguro_id = 2;
        $detalhesaluguer->localizacao_levantamento_id = 1;
        $detalhesaluguer->localizacao_devolucao_id = 3 ;

        $this->assertTrue($detalhesaluguer->validate([$detalhesaluguer->data_inicio]));
        $this->assertTrue($detalhesaluguer->validate([$detalhesaluguer->data_fim]));
        $this->assertTrue($detalhesaluguer->validate([$detalhesaluguer->veiculo_id]));
        $this->assertTrue($detalhesaluguer->validate([$detalhesaluguer->profile_id]));
        $this->assertTrue($detalhesaluguer->validate([$detalhesaluguer->seguro_id]));
        $this->assertTrue($detalhesaluguer->validate([$detalhesaluguer->localizacao_levantamento_id]));
        $this->assertTrue($detalhesaluguer->validate([$detalhesaluguer->localizacao_devolucao_id]));

    }

    public function testSavingDetalhesaluguer()
    {
        $detalhesaluguer = new Detalhesaluguer();

        //create
        $detalhesaluguer->data_inicio = '2022-12-05';
        $detalhesaluguer->data_fim = '2022-12-07';
        $detalhesaluguer->veiculo_id = 1;
        $detalhesaluguer->profile_id = 3;
        $detalhesaluguer->seguro_id = 1;
        $detalhesaluguer->localizacao_levantamento_id = 2;
        $detalhesaluguer->localizacao_devolucao_id = 2;
        $detalhesaluguer->save();
        $this->tester->seeRecord('common\models\Detalhesaluguer', ['seguro_id' => 1, 'veiculo_id'=>1, 'profile_id'=>3]);

        //update
        $novo = $this->tester->grabRecord('common\models\Detalhesaluguer', ['seguro_id' => 1, 'veiculo_id'=>1, 'profile_id'=>3]);
        $novo->seguro_id = 2;
        $novo->save();
        $this->assertEquals(2, $novo->seguro_id);
        $this->tester->seeRecord('common\models\Detalhesaluguer', ['seguro_id' => 2, 'veiculo_id'=>1, 'profile_id'=>3]);
        $this->tester->dontSeeRecord('common\models\Detalhesaluguer', ['seguro_id' => 1, 'veiculo_id'=>1, 'profile_id'=>3]);

        //delete
        $novo->delete();
        $this->tester->dontSeeRecord('common\models\Detalhesaluguer', ['seguro_id' => 2, 'veiculo_id'=>1, 'profile_id'=>3]);
    }
}
