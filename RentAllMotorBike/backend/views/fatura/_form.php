<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="fatura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_fatura')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Data atual'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'todayBtn' => true,
            'autoclose' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'preco_total')->textInput(['value' => $model->preco_total]); ?>

    <?= $form->field($model, 'detalhes_aluguer_fatura_id')->textInput(['value' => $model->detalhesAluguerFatura->id_detalhes_aluguer, 'readonly' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
