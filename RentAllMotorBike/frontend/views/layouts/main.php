<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\models\Localizacao;
use common\models\Tipomotociclo;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\db\Query;
use yii\helpers\ArrayHelper;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap"
              rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet"/>

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">


    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <!-- Topbar Start -->
        <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body pr-3" href=""><i class="fa fa-phone-alt mr-2"></i>+351 962 234 518</a>
                        <span class="text-body">|</span>
                        <a class="text-body px-3" href="https://www.google.com/"><i class="fa fa-envelope mr-2"></i>rentallmotorbike@gmail.com</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body px-3" href="https://www.facebook.com/">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-body px-3" href="https://twitter.com/">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-body px-3" href="https://www.linkedin.com/">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-body px-3" href="https://www.instagram.com/">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-body pl-3" href="https://www.youtube.com/">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->
        <?php
        NavBar::begin([
            'brandLabel' => 'rentallmotorbike',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5',
            ],
        ]);
        $menuItems = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
        ];


        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Registo', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];

        } else {

            if (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == "cliente") {
                $menuItems[] = ['label' => 'motociclos', 'url' => ['/motociclo/index']];

                $motociclos = \common\models\Detalhesaluguer::find()->where(['profile_id' =>  Yii::$app->user->getId()])->one();
                $analises = \common\models\Analise::find()->limit(6)->all();

                if ($motociclos != null) {
                    $menuItems[] = ['label' => 'As minhas Reservas', 'url' => ['/detalhesaluguer/index', 'id_user' => Yii::$app->user->getId()]];
                    $menuItems[] = ['label' => 'Avaliações', 'url' => ['/analise/index', 'id_user' => Yii::$app->user->getId()]];
                }

            }
            $menuItems[] =

                [
                    'label' => 'Sobre', 'url' => ['/site/about'],
                    'items' => [
                        ['label' => 'Serviço', 'url' => ['/site/service']],
                        ['label' => 'Contacto', 'url' => ['/site/contact']],
                    ],
                ];
            $menuItems[] =

                [
                    'label' => Yii::$app->user->identity->username,
                    'items' => [
                        ['label' => 'Perfil', 'url' => ['profile/view', 'id_profile' => Yii::$app->user->getId()]],
                        Html::a('Logout', ['/site/logout'], ['class' => ['dropdown-item'], 'data-method' => 'post'])
                    ],
                ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);
        /*if (Yii::$app->user->isGuest) {
            echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
        } else {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout text-decoration-none']
                )
                . Html::endForm();
        }*/
        NavBar::end();
        ?>


        <!-- Search Start -->


        <main role="main" class="flex-shrink-0">
            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>

        <footer class="footer mt-auto py-3 text-muted">

            <!-- Footer Start -->
            <div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
                <div class="row pt-5">
                    <div class="col-lg-3 col-md-6 mb-5">
                        <h4 class="text-uppercase text-light mb-4">Entre em contacto</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>Avenida Marquês de Pombal,
                            Leiria, Portugal</p>
                        <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>+351 962 234 518</p>
                        <p><i class="fa fa-envelope text-white mr-3"></i>rentallmotorbike@gmail.com</p>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-5">
                        <h6 class="text-uppercase text-white py-2">Segue-nos</h6>
                        <div class="d-flex justify-content-start">
                            <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="https://twitter.com/"><i
                                        class="fab fa-twitter"></i></a>
                            <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="https://www.facebook.com/"><i
                                        class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="https://www.linkedin.com/"><i
                                        class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-lg btn-dark btn-lg-square" href="https://www.instagram.com/"><i
                                        class="fab fa-instagram"></i></a>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6 mb-5">
                        <h4 class="text-uppercase text-light mb-4">Links úteis</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-body mb-2" href="index.php?r=site%2Fabout"><i
                                        class="fa fa-angle-right text-white mr-2"></i>Sobre</a>
                            <a class="text-body mb-2" href="index.php?r=site%2Fservice"><i
                                        class="fa fa-angle-right text-white mr-2"></i>Servico</a>
                            <a class="text-body mb-2" href="index.php?r=site%2Fteam"><i
                                        class="fa fa-angle-right text-white mr-2"></i>Team</a>
                            <a class="text-body mb-2" href="index.php?r=site%2Fcontact"><i
                                        class="fa fa-angle-right text-white mr-2"></i>Contactos</a>

                        </div>
                    </div>

                </div>
            </div>
            <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
                <p class="mb-2 text-center text-body">&copy; <a href="#">rentallmotorbike</a>. All Rights Reserved.</p>

                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                <p class="m-0 text-center text-body">Designed by <a href="https://htmlcodex.com">HTML Codex</a></p>
            </div>
            <!-- Footer End -->
        </footer>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>

        <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
