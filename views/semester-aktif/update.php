<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SemesterAktif */

$this->title = 'Update Semester Aktif: ' . $model->id_semester_aktif;
$this->params['breadcrumbs'][] = ['label' => 'Semester Aktifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_semester_aktif, 'url' => ['view', 'id' => $model->id_semester_aktif]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="semester-aktif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
