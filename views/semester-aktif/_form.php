<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SemesterAktif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="semester-aktif-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'semester')->dropDownList([ 'Ganjil' => 'Ganjil', 'Genap' => 'Genap', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tahun')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
