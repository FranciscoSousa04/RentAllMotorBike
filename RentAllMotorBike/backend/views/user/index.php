<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\rbac\Role;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$roles = array('admin' => 'admin', 'gestor' => 'gestor', 'cliente' => 'cliente');
?>
<div class="user-index">

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'email:email',
            [
                'label' => 'Role',
                'attribute' => 'role',
                'format' => 'raw',
                'filter' => $roles,
                'value' => function ($model) {
                    if (Yii::$app->authManager->getRolesByUser($model->id) != null) {
                        return array_keys(Yii::$app->authManager->getRolesByUser($model->id))[0];
                    } else {
                        return 'Sem role';
                    }
                },
            ],
            ['class' => ActionColumn::className(),'template' => '{view} {update} {delete}'],
        ],
    ]); ?>


</div>
