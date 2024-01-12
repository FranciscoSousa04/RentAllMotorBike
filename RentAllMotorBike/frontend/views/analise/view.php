<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Analise $model */

$this->title = $model->id_analise;
$this->params['breadcrumbs'][] = ['label' => 'Analises', 'url' => ['/analise/index', 'id_user' => Yii::$app->user->getId()]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="analise-view">

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
        <?= Html::a('Update', ['update', 'id_analise' => $model->id_analise], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_analise' => $model->id_analise], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <table>
        <?php
        echo '<tr><td><strong> ID </strong></td><td>' . $model->id_analise . '</td></tr>';
        echo '<tr><td><strong> Comentário </strong></td><td>' . $model->comentario . '</td></tr>';
        echo '<tr><td><strong> Data </strong></td><td>' . $model->data_analise . '</td></tr>';
        echo '<tr><td><strong> Classificação </strong></td><td>' . \kartik\rating\StarRating::widget([
                'model' => $model,
                'attribute' => 'classificao',
                'pluginOptions' => [
                    'readonly' => true,
                    'showClear' => false,
                    'showCaption' => false,
                ],
            ]) . '</td></tr>';


        echo '</table>';
        ?>

</div>
