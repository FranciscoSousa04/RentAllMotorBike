<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_profile')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'nome')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'apelido')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'telemovel')->textInput() ?>

    <?= $form->field($model, 'nif')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'nr_cartaconducao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
