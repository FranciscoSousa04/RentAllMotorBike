<?php


namespace common\tests\unit\models;

use common\fixtures\SeguroFixture;
use common\tests\UnitTester;
use common\fixtures\UserFixture;
use common\models\Seguro;
use Yii;


class SegurosTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function _fixtures()
    {
        return [
            'seguro' => [
                'class' => SeguroFixture::class,
                'dataFile' => codecept_data_dir() . 'seguro.php'
            ]
        ];
    }


    // tests
    public function testCreateSeguroUnsuccessfully()
    {
        $model = new Seguro();
        $model->marca = null;
        $model->cobertura = null;
        $model->preco = null;

        $this->assertFalse($model->validate(['marca']));
        $this->assertFalse($model->validate(['cobertura']));
        $this->assertFalse($model->validate(['preco']));

        verify($model->save())->false();

    }
    public function testCreateSeguroSuccessfully()
    {
        $model = new Seguro();
        $model->marca = 'Tranquilidade';
        $model->cobertura = 'Danos Próprios';
        $model->preco = '18.45';

        $this->assertTrue($model->validate(['marca']));
        $this->assertTrue($model->validate(['cobertura']));
        $this->assertTrue($model->validate(['preco']));

        verify($model->save())->true();

    }
    public function testUpdateSeguroUnsuccessfully()
    {
        $seguro1 = $this->tester->grabFixture('seguro', 'seguro1');
        $seguro1->marca = null;
        $seguro1->cobertura = null;
        $seguro1->preco = null;
        $this->assertFalse($seguro1->validate(['marca']));
        $this->assertFalse($seguro1->validate(['cobertura']));
        $this->assertFalse($seguro1->validate(['preco']));
        verify($seguro1->save())->false();

    }
    public function testUpdateSeguroSuccessfully()
    {
        $model = new Seguro();
        $model->marca = 'Tranquilidade';
        $model->cobertura = 'Danos Próprios';
        $model->preco = '18.45';
        $model->save();

        $seguro = Seguro::findOne(['id_seguro' => $model->id_seguro]);
        $seguro->marca = 'Tranquilidade';
        $seguro->cobertura = '1000';
        $seguro->preco = '19.45';
        $seguro->save();

        $this->assertEquals('Tranquilidade', $seguro->marca);
        $this->assertEquals('1000', $seguro->cobertura);
        $this->assertEquals('19.45', $seguro->preco);

    }
    public function testDeleteSeguroUnsuccessfully()
    {
        $seguro1 = $this->tester->grabFixture('seguro', 'seguro1');
        $seguro1->delete();
        $this->assertNull(Seguro::findOne(['id_seguro' => $seguro1->id_seguro]));
    }
    public function testDeletePagamentosSuccessfully()
    {
        $seguro1 = $this->tester->grabFixture('seguro', 'seguro1');
        $seguro1->delete();
        $this->assertNull(Seguro::findOne(['id_seguro' => $seguro1->id_seguro]));
    }

}