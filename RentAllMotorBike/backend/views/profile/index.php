<?php

use common\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $searchModel,
        'columns' => [
            [
                'label' => '',
                'value' => function ($data) {
                    return array_keys(Yii::$app->authManager->getRolesByUser($data->id_user))[0];
                },
            ],
            [
                'label' => 'Nome',
                'value' => function ($data) {
                    return $data->nome .' '. $data->apelido;
                },
            ],
            [
                'label' => 'Username',
                'value' => function ($data) {
                    return $data->user->username;
                },
            ],
            [
                'label' => 'Email',
                'value' => function ($data) {
                    return $data->user->email;
                },
            ],
            [
                'label' => 'Telemóvel',
                'value' => function ($data) {
                    return $data->telemovel;
                },
            ],
            [
                'label' => 'Nif',
                'value' => function ($data) {
                    return $data->nif;
                },
            ],
            [
                'label' => 'Nr Carta Condução',
                'value' => function ($data) {
                    return $data->nr_cartaconducao;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'urlCreator' => function ($action, Profile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_user' => $model->id_user]);
                }
            ],
        ],
    ]); ?>


</div>
