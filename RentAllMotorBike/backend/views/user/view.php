<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;  
            color:black;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);

        if (Yii::$app->user->id == $model->id) {
            echo Html::a('Update', ['profile/update', 'id_profile' => $model->id], ['class' => 'btn btn-primary']);
        }

        ?>
    </p>

    <table>
        <?php
        echo '<tr><td><strong> ID </strong></td><td>' . $model->id . '</td></tr>';
        echo '<tr><td><strong> Nome </strong></td><td>' . $model->profile->nome . '</td></tr>';
        echo '<tr><td><strong> Apelido </strong></td><td>' . $model->profile->apelido . '</td></tr>';
        echo '<tr><td><strong> Username </strong></td><td>' . $model->username . '</td></tr>';
        echo '<tr><td><strong> Email </strong></td><td>' . $model->email . '</td></tr>';
        echo '<tr><td><strong> Telemóvel </strong></td><td>' . $model->profile->telemovel . '</td></tr>';
        echo '<tr><td><strong> Nif </strong></td><td>' . $model->profile->nif . '</td></tr>';
        echo '<tr><td><strong> Nr Carta Condução </strong></td><td>' . $model->profile->nr_carta_conducao . '</td></tr>';


        echo '</table>';
        ?>

</div>
