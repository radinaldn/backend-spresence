<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mengambil */

$this->title = $model->id_mengambil;
$this->params['breadcrumbs'][] = ['label' => 'Mengambils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mengambil-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_mengambil], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_mengambil], [
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
            'id_mengambil',
            'nim',
            'id_mengajar',
        ],
    ]) ?>

</div>
