<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AssistenciaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assistencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_assistencia') ?>

    <?= $form->field($model, 'data_pedido') ?>

    <?= $form->field($model, 'mensagem') ?>

    <?= $form->field($model, 'localizacao') ?>

    <?= $form->field($model, 'condicao') ?>

    <?php // echo $form->field($model, 'motociclo_id') ?>

    <?php // echo $form->field($model, 'profile_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
