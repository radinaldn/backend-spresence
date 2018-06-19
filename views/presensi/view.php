<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Presensi */

$this->title = $model->id_presensi;
$this->params['breadcrumbs'][] = ['label' => 'Presensis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presensi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_presensi], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_presensi], [
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
            'id_presensi',
            'id_mengajar',
            'id_kelas',
            'pertemuan',
            'id_ruangan',
            'waktu',
            'qr_code',
        ],
    ]) ?>

</div>
