<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../site/index" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">rentallmotorbike</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a <?= Html::a(\Yii::$app->user->identity->username, ['profile/view', 'id_user' => Yii::$app->user->getId()]) ?>
            </div>
        </div>
        <?php if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == "admin") {?>
            <!-- CENAS DO ADMIN -->
            <li class="nav-item d-none d-sm-inline-block">
                <?= Html::a('Users', ['/profile/index'], ['data-method' => 'post', 'class' => 'nav-link'])?>
            </li>
        <?php } ?>
        <li class="nav-item d-none d-sm-inline-block">
            <?= Html::a('Localizações', ['/localizacao/index'], ['data-method' => 'post', 'class' => 'nav-link'])?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?= Html::a('Extras', ['/extra/index'], ['data-method' => 'post', 'class' => 'nav-link'])?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?= Html::a('motociclos', ['/motociclo/index'], ['data-method' => 'post', 'class' => 'nav-link'])?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?= Html::a('Tipomotociclos', ['/tipomotociclo/index'], ['data-method' => 'post', 'class' => 'nav-link'])?>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <?= Html::a('Seguros', ['/seguro/index'], ['data-method' => 'post', 'class' => 'nav-link'])?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?= Html::a('Detalhes aluguer', ['/detalhesaluguer/index'], ['data-method' => 'post', 'class' => 'nav-link'])?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?= Html::a('Pedidos de Asssitência', ['/assistencia/index'], ['data-method' => 'post', 'class' => 'nav-link'])?>
        </li>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        
        <nav class="mt-2">

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>