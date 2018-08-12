<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PresensiDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presensi-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_presensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nim')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Hadir' => 'Hadir', 'Tidak Hadir' => 'Tidak Hadir', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?= $form->field($model, 'lng')->textInput() ?>

    <?= $form->field($model, 'waktu')->textInput() ?>

    <?= $form->field($model, 'jarak')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
