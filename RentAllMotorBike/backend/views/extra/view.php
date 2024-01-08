<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Extra $model */

$this->title = $model->id_extra;
$this->params['breadcrumbs'][] = ['label' => 'Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="extra-view">

    <p>
        <?= Html::a('Update', ['update', 'id_extra' => $model->id_extra], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_extra' => $model->id_extra], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_extra',
            'descricao',
            'preco',
        ],
    ]) ?>

</div>
