<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SemesterAktif */

$this->title = $model->id_semester_aktif;
$this->params['breadcrumbs'][] = ['label' => 'Semester Aktifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-aktif-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_semester_aktif], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_semester_aktif], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_semester_aktif',
            'semester',
            'tahun',
            'status',
        ],
    ]) ?>

</div>
