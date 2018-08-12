<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MengajarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mengajar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_mengajar') ?>

    <?= $form->field($model, 'id_matakuliah') ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'waktu_mulai') ?>

    <?= $form->field($model, 'id_kelas') ?>

    <?php // echo $form->field($model, 'id_semester_aktif') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
