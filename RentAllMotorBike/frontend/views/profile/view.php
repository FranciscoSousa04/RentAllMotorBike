<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Profile $model */


$this->title = $model->id_user;
\yii\web\YiiAsset::register($this);

?>
<div class="profile-view">

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
            color: black;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_user' => $model->id_user], ['class' => 'btn btn-primary']) ?>
            </p>

    <table>
        <?php
        echo '<tr><td><strong> Nome </strong></td><td>' . $model->nome . '</td></tr>';
        echo '<tr><td><strong> Apelido </strong></td><td>' . $model->apelido . '</td></tr>';
        echo '<tr><td><strong> Username </strong></td><td>' . $model->user->username. '</td></tr>';
        echo '<tr><td><strong> Email </strong></td><td>' . $model->user->email . '</td></tr>';
        echo '<tr><td><strong> Telemóvel </strong></td><td>' . $model->telemovel . '</td></tr>';
        echo '<tr><td><strong> Nif </strong></td><td>' . $model->nif . '</td></tr>';
        echo '<tr><td><strong> Nr Carta Condução </strong></td><td>' . $model->nr_cartaconducao . '</td></tr>';


        echo '</table>';
        ?>

</div>
