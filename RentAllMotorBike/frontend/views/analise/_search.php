<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AnaliseSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="analise-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_analise') ?>

    <?= $form->field($model, 'comentario') ?>

    <?= $form->field($model, 'classificao') ?>

    <?= $form->field($model, 'data_analise') ?>

    <?= $form->field($model, 'profile_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
