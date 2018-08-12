<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mengajar */

$this->title = $model->id_mengajar;
$this->params['breadcrumbs'][] = ['label' => 'Mengajars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mengajar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_mengajar], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_mengajar], [
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
            'id_mengajar',
            'id_matakuliah',
            'nip',
            'waktu_mulai',
            'id_kelas',
            'id_semester_aktif',
        ],
    ]) ?>

</div>
