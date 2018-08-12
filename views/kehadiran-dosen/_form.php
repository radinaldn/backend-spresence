<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KehadiranDosen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kehadiran-dosen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nip')->textInput() ?>

    <?= $form->field($model, 'status_kehadiran')->dropDownList([ 'Tidak Hadir' => 'Tidak Hadir', 'Hadir' => 'Hadir', 'Luar Kota' => 'Luar Kota', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'nama_kota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
