<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\LocalizacaoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="localizacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_localizacao') ?>

    <?= $form->field($model, 'localizacao') ?>

    <?= $form->field($model, 'morada') ?>

    <?= $form->field($model, 'cod_postal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
