<?php

use common\models\motociclo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\motociclo $model */
/** @var common\models\motocicloSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'motociclos';
$this->params['breadcrumbs'][] = $this->title;
//var_dump($model);die;
?>
<div class="motociclo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <?php
    /*ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_motociclo_item',
    ])*/
    ?>
    <div class="row">

        <?php
        if ($model == false) {
            echo '<h2>Não existem motociclos disponiveis com a sua pesquisa!</h2>';
        } else {
            foreach ($model as $motociclo) { ?>
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $i = 0;
                                foreach ($motociclo->imagems as $imagem) {
                                    if($i==0){ ?>
                                        <div class="item active">
                                            <?= Html::img('@web/uploads/' . $imagem->imagem, ['class' => "img-fluid w-100"]); ?>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="item">
                                            <?= Html::img('@web/uploads/' . $imagem->imagem, ['class' => "img-fluid w-100"]); ?>
                                        </div>
                                    <?php }
                                    $i++;
                                }
                                ?>
                            </div>
                        </div>

                        <h4 class="text-uppercase mb-4"><?= $motociclo->marca ?> <?= $motociclo->modelo ?></h4>
                        <div class="d-flex justify-content-center mb-4">
                            <div class="px-2">
                                <i class="fa fa-car text-primary mr-1"></i>
                                <span><?= $motociclo->tipomotociclo->categoria ?></span>
                            </div>
                            <div class="px-2 border-left border-right">
                                <i class="fa fa-cogs text-primary mr-1"></i>
                                <span><?= $motociclo->combustivel ?></span>
                            </div>
                            <div class="px-2">
                                <i class="fa fa-road text-primary mr-1"></i>
                                <span><?= $motociclo->preco . '€' ?></span>
                            </div>
                        </div>
                        <a>    <?= Html::a('Ver informação', ['motociclo/view', 'idmotociclo' => $motociclo->idmotociclo], ['class' => 'btn btn-primary', 'name' => 'vermotociclo_' . $motociclo->idmotociclo]); ?>
                    </div>
                </div>
                <?php
            }
        } ?>
    </div>
</div>
