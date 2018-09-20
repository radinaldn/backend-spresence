<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DosenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dosen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-index">

    <h2>Daftar Dosen</h2>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card-box">
        <div class="dropdown pull-right">
            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                <i class="zmdi zmdi-more-vert"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>

        <h4 class="header-title m-t-0 m-b-30"><i class="zmdi zmdi-account-circle"></i> Dosen</h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'Foto',
                'format'=>'raw',
                'value' => function($data){
                    $url = Yii::$app->getHomeUrl()."/files/images/dosen/".$data['foto'];
                    return Html::img($url,['alt'=>'yii', 'class'=>'img-circle user-img', 'height'=>'50', 'width'=>'50']);
                }
            ],
            'nip',
            //'password',
            //'imei',
            'nama',
            'jk',
            //'foto',

            ['class' => 'yii\grid\ActionColumn',
                'visible' => Yii::$app->user->identity->level == 'Administrator' ? true : false],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
