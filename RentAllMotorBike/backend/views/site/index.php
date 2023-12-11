<?php
$this->title = 'Página inicial';

use yii\helpers\Url;
?>

<div class="container-fluid">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif;
    $total2 = \common\models\Profile::find()->where([])->count(); ?>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <p>Novos pedidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="<?= Url::toRoute('/detalhesaluguer/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <p>motociclos totais</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car"></i>
                </div>
                <a href="<?= Url::toRoute('/motociclo/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3><?= $total2 ?></h3>
                    <p>Utilizadores registados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="<?= Url::toRoute('/user/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>