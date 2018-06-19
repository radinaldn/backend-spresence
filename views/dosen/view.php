<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dosen */

$this->title = $model->nip;
$this->params['breadcrumbs'][] = ['label' => 'Dosens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'nip' => $model->nip, 'imei' => $model->imei], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nip' => $model->nip, 'imei' => $model->imei], [
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
            'nip',
            'password',
            'imei',
            'nama',
            'jk',
            'foto',
        ],
    ]) ?>

</div>
