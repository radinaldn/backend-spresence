<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PresensiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presensi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_presensi') ?>

    <?= $form->field($model, 'id_mengajar') ?>

    <?= $form->field($model, 'id_kelas') ?>

    <?= $form->field($model, 'pertemuan') ?>

    <?= $form->field($model, 'id_ruangan') ?>

    <?php // echo $form->field($model, 'waktu') ?>

    <?php // echo $form->field($model, 'qr_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
