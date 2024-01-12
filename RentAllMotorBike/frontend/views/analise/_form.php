<?php

use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Analise $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="analise-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comentario')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'classificao')->widget(StarRating::classname(), [
        'pluginOptions' => ['step' => 1,
                    'showClear' => false,
],


    ]);?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
