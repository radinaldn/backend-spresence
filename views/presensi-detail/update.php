<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PresensiDetail */

$this->title = 'Update Presensi Detail: ' . $model->id_presensi;
$this->params['breadcrumbs'][] = ['label' => 'Presensi Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_presensi, 'url' => ['view', 'id' => $model->id_presensi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="presensi-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
