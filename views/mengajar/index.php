<?php

use app\models\Mengajar;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MengajarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perkuliahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mengajar-index">


    <h4 class="page-title">Tahun Ajaran <?= $FindSemesterAktif->semester ?> <?= $FindSemesterAktif->tahun; ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--    <div class="card-box">-->
<!--        <div class="dropdown pull-right">-->
<!--            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">-->
<!--                <i class="zmdi zmdi-more-vert"></i>-->
<!--            </a>-->
<!--            <ul class="dropdown-menu" role="menu">-->
<!--                <li><a href="#">Action</a></li>-->
<!--                <li><a href="#">Another action</a></li>-->
<!--                <li><a href="#">Something else here</a></li>-->
<!--                <li class="divider"></li>-->
<!--                <li><a href="#">Separated link</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!---->
<!--    <p>-->
<!--        --><?php //// echo Html::a('Create Mengajar', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<!---->
<!--</div>-->

    <div class="row">
        <div class="col-sm-12">
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

                <p> <h4 class="header-title m-t-0 m-b-30"><i class="zmdi zmdi-graduation-cap"></i> Perkuliahan</h4>

                <div class="row">


                    <div class="col-lg-12">
                        <div class="panel panel-color panel-tabs panel-success">
                            <div class="panel-heading">

                        <ul class="nav nav-tabs nav-justified">
                            <li role="presentation" class="active">
                                <a href="#senin" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"aria-expanded="true">Senin</a>
                            </li>
                            <li role="presentation">
                                <a href="#selasa" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Selasa</a>
                            </li>
                            <li role="presentation">
                                <a href="#rabu" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Rabu</a>
                            </li>
                            <li role="presentation">
                                <a href="#kamis" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Kamis</a>
                            </li>
                            <li role="presentation">
                                <a href="#jumat" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Jum'at</a>
                            </li>

                        </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="senin"
                                 aria-labelledby="home-tab">


                                        <p class="text-muted font-13 m-b-15">
                                            Use contextual classes to color table rows or individual cells.
                                        </p>

                                <div class="table-responsive">
                                        <table class="table m-b-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th>Nip</th>
                                                <th>Dosen</th>
                                                <th>Matakuliah</th>
                                                <th>Kelas</th>
                                                <th>Waktu Mulai</th>
                                                <th>SKS</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php $i=1; foreach ($dataProvider as $mengajarFindAll) {
                                                if ($mengajarFindAll['hari'] == Mengajar::SENIN){
                                                    ?>

                                                    <tr class="active">
                                                        <th scope="row"></th>
                                                        <!--                                                <td>--><?//= $i ?><!--</td>-->
                                                        <td><img height="50" width="50" class="img-circle user-img user-img" src="<?= Yii::$app->getHomeUrl() ?>files/images/dosen/<?= $mengajarFindAll['foto'] ?>"></td>
                                                        <td><?= $mengajarFindAll['nip'] ?></td>
                                                        <td><?= $mengajarFindAll['dosen'] ?></td>
                                                        <td><?= $mengajarFindAll['matakuliah'] ?></td>
                                                        <td><?= $mengajarFindAll['kelas'] ?></td>
                                                        <td><?= $mengajarFindAll['waktu_mulai'] ?></td>
                                                        <td><?= $mengajarFindAll['sks'] ?></td>
                                                        <td><a class="btn btn-purple" href="<?= Yii::$app->getHomeUrl().'presensi/histori-mengajar-by-id-mengajar?id='.$mengajarFindAll['id_mengajar'] ?>"> <i class="fa fa-eye"></i> Lihat Histori</a></td>
                                                    </tr>

                                                    <?php $i++; }
                                            } ?>
                                            </tbody>
                                        </table>



                                </div>
                                </p></div>
                            <div role="tabpanel" class="tab-pane fade" id="selasa"
                                 aria-labelledby="home-tab">


                                <p class="text-muted font-13 m-b-15">
                                    Use contextual classes to color table rows or individual cells.
                                </p>

                                <table class="table m-b-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Nip</th>
                                        <th>Dosen</th>
                                        <th>Matakuliah</th>
                                        <th>Kelas</th>
                                        <th>Waktu Mulai</th>
                                        <th>SKS</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i=1; foreach ($dataProvider as $mengajarFindAll) {
                                        if ($mengajarFindAll['hari'] == Mengajar::SELASA){
                                            ?>

                                            <tr class="active">
                                                <th scope="row"></th>
                                                <!--                                                <td>--><?//= $i ?><!--</td>-->
                                                <td><img height="50" width="50" class="img-circle user-img user-img" src="<?= Yii::$app->getHomeUrl() ?>files/images/dosen/<?= $mengajarFindAll['foto'] ?>"></td>
                                                <td><?= $mengajarFindAll['nip'] ?></td>
                                                <td><?= $mengajarFindAll['dosen'] ?></td>
                                                <td><?= $mengajarFindAll['matakuliah'] ?></td>
                                                <td><?= $mengajarFindAll['kelas'] ?></td>
                                                <td><?= $mengajarFindAll['waktu_mulai'] ?></td>
                                                <td><?= $mengajarFindAll['sks'] ?></td>
                                                <td><a class="btn btn-purple" href="<?= Yii::$app->getHomeUrl().'presensi/histori-mengajar-by-id-mengajar?id='.$mengajarFindAll['id_mengajar'] ?>"> <i class="fa fa-eye"></i> Lihat Histori</a></td>
                                            </tr>

                                            <?php $i++; }
                                    } ?>
                                    </tbody>
                                </table>




                                </p></div>
                            <div role="tabpanel" class="tab-pane fade" id="rabu"
                                 aria-labelledby="home-tab">


                                <p class="text-muted font-13 m-b-15">
                                    Use contextual classes to color table rows or individual cells.
                                </p>

                                <table class="table m-b-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Nip</th>
                                        <th>Dosen</th>
                                        <th>Matakuliah</th>
                                        <th>Kelas</th>
                                        <th>Waktu Mulai</th>
                                        <th>SKS</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i=1; foreach ($dataProvider as $mengajarFindAll) {
                                        if ($mengajarFindAll['hari'] == Mengajar::RABU){
                                            ?>

                                            <tr class="active">
                                                <th scope="row"></th>
                                                <!--                                                <td>--><?//= $i ?><!--</td>-->
                                                <td><img height="50" width="50" class="img-circle user-img user-img" src="<?= Yii::$app->getHomeUrl() ?>files/images/dosen/<?= $mengajarFindAll['foto'] ?>"></td>
                                                <td><?= $mengajarFindAll['nip'] ?></td>
                                                <td><?= $mengajarFindAll['dosen'] ?></td>
                                                <td><?= $mengajarFindAll['matakuliah'] ?></td>
                                                <td><?= $mengajarFindAll['kelas'] ?></td>
                                                <td><?= $mengajarFindAll['waktu_mulai'] ?></td>
                                                <td><?= $mengajarFindAll['sks'] ?></td>
                                                <td><a class="btn btn-purple" href="<?= Yii::$app->getHomeUrl().'presensi/histori-mengajar-by-id-mengajar?id='.$mengajarFindAll['id_mengajar'] ?>"> <i class="fa fa-eye"></i> Lihat Histori</a></td>
                                            </tr>

                                            <?php $i++; }} ?>
                                    </tbody>
                                </table>




                                </p></div>
                            <div role="tabpanel" class="tab-pane fade" id="kamis"
                                 aria-labelledby="home-tab">


                                <p class="text-muted font-13 m-b-15">
                                    Use contextual classes to color table rows or individual cells.
                                </p>

                                <table class="table m-b-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Nip</th>
                                        <th>Dosen</th>
                                        <th>Matakuliah</th>
                                        <th>Kelas</th>
                                        <th>Waktu Mulai</th>
                                        <th>SKS</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i=1; foreach ($dataProvider as $mengajarFindAll) {
                                        if ($mengajarFindAll['hari'] == Mengajar::KAMIS){
                                            ?>

                                            <tr class="active">
                                                <th scope="row"></th>
                                                <!--                                                <td>--><?//= $i ?><!--</td>-->
                                                <td><img height="50" width="50" class="img-circle user-img user-img" src="<?= Yii::$app->getHomeUrl() ?>files/images/dosen/<?= $mengajarFindAll['foto'] ?>"></td>
                                                <td><?= $mengajarFindAll['nip'] ?></td>
                                                <td><?= $mengajarFindAll['dosen'] ?></td>
                                                <td><?= $mengajarFindAll['matakuliah'] ?></td>
                                                <td><?= $mengajarFindAll['kelas'] ?></td>
                                                <td><?= $mengajarFindAll['waktu_mulai'] ?></td>
                                                <td><?= $mengajarFindAll['sks'] ?></td>
                                                <td><a class="btn btn-purple" href="<?= Yii::$app->getHomeUrl().'presensi/histori-mengajar-by-id-mengajar?id='.$mengajarFindAll['id_mengajar'] ?>"> <i class="fa fa-eye"></i> Lihat Histori</a></td>
                                            </tr>

                                            <?php $i++; }} ?>
                                    </tbody>
                                </table>




                                </p></div>
                            <div role="tabpanel" class="tab-pane fade" id="jumat"
                                 aria-labelledby="home-tab">


                                <p class="text-muted font-13 m-b-15">
                                    Use contextual classes to color table rows or individual cells.
                                </p>

                                <table class="table m-b-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Nip</th>
                                        <th>Dosen</th>
                                        <th>Matakuliah</th>
                                        <th>Kelas</th>
                                        <th>Waktu Mulai</th>
                                        <th>SKS</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i=1; foreach ($dataProvider as $mengajarFindAll) {
                                        if ($mengajarFindAll['hari'] == Mengajar::JUMAT){
                                            ?>

                                            <tr class="active">
                                                <th scope="row"></th>
                                                <!--                                                <td>--><?//= $i ?><!--</td>-->
                                                <td><img height="50" width="50" class="img-circle user-img user-img" src="<?= Yii::$app->getHomeUrl() ?>files/images/dosen/<?= $mengajarFindAll['foto'] ?>"></td>
                                                <td><?= $mengajarFindAll['nip'] ?></td>
                                                <td><?= $mengajarFindAll['dosen'] ?></td>
                                                <td><?= $mengajarFindAll['matakuliah'] ?></td>
                                                <td><?= $mengajarFindAll['kelas'] ?></td>
                                                <td><?= $mengajarFindAll['waktu_mulai'] ?></td>
                                                <td><?= $mengajarFindAll['sks'] ?></td>
                                                <td><a class="btn btn-purple" href="<?= Yii::$app->getHomeUrl().'presensi/histori-mengajar-by-id-mengajar?id='.$mengajarFindAll['id_mengajar'] ?>"> <i class="fa fa-eye"></i> Lihat Histori</a></td>
                                            </tr>

                                            <?php $i++; }} ?>
                                    </tbody>
                                </table>




                                </p></div>
                        </div>
                        </div>
                    </div><!-- end col -->

                </div>
                <!-- end row -->

            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->


