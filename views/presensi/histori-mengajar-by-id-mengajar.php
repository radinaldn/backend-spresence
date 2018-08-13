<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 12/08/18
 * Time: 22:04
 */


use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PresensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Histori Pertemuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presensi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_presensi',
            'nama_dosen',
            'nama_matakuliah',
            'kelas',
            'pertemuan',
            'nama_ruangan',
            'waktu',
            'total_hadir',
            'total_tidak_hadir',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'headerOptions' => ['width' => '80'],
                //'template' => '{view} {update} {delete} {link}',
                'template' => '{semua-pertemuan}',
                'buttons' => [

                    'semua-pertemuan' => function ($url,$model,$key){
                        $url = Yii::$app->getHomeUrl().'presensi-detail/histori-presensi-by-id-presensi?id='.$model['id_presensi'];
                        return Html::a('<i class="ti-more-alt"></i>', $url,['title'=>'Lihat pertemuan']);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
