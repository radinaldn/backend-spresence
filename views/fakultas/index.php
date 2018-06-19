<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FakultasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fakultas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fakultas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fakultas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_fakultas',
            'nama',
            'titik_a_lat',
            'titik_a_lng',
            'titik_b_lat',
            //'titik_b_lng',
            //'titik_c_lat',
            //'titik_c_lng',
            //'titik_d_lat',
            //'titik_d_lng',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
