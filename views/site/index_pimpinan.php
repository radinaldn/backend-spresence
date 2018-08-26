<?php

/* @var $this yii\web\View */

use app\models\KehadiranDosen;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title"><i class="zmdi zmdi-graduation-cap"></i> Tahun Ajaran <?= $FindSemesterAktif->semester ?> <?= $FindSemesterAktif->tahun; ?></h4>
    </div>
</div>


<div class="row">
    <div class="col-lg-4">
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

            <h4 class="header-title m-t-0 m-b-30">Perkuliahan Hari Ini</h4>

            <div class="inbox-widget nicescroll" style="height: auto; overflow: hidden; outline: none;" tabindex="5000">


                <div v-for="presensi in presensis">
                    <a v-bind:href="'<?= Yii::$app->getHomeUrl() ?>/presensi-detail/histori-presensi-by-id-presensi?id='+ presensi.id_presensi">
                    <div class="inbox-item">
<!--                        -->
                        <div class="inbox-item-img"><img class="img-circle" v-bind:src="'<?= Yii::$app->getHomeUrl() ?>/files/images/dosen/' + presensi.foto"/></div>
                        <p class="inbox-item-author">{{presensi.nama_dosen}}</p>
                        <p class="text-primary inbox-item-text">
                            {{presensi.nama_matakuliah}} ({{presensi.kelas}})
                        </p><p class="inbox-item-content">Pertemuan ke
                            <b>{{presensi.pertemuan}}</b>
                        </p>

                        <p class="inbox-item-content"><i class="zmdi zmdi-pin"></i> {{presensi.nama_ruangan}}
                        </p>
                        <p class="text-danger inbox-item-content-right"><i class="fa fa-times-circle"></i> Tidak Hadir : {{presensi.total_tidak_hadir}}
                        <p class="text-success inbox-item-content-right"><i class="fa fa-check-circle"></i> Hadir : {{presensi.total_hadir}}
                        </p>
                        <p class="inbox-item-date"><i class="zmdi zmdi-time"></i> {{presensi.waktu}}</p>
                    </div>
                    </a>
                </div>
            </div>

        </div>
    </div><!-- end col -->

    <div class="col-lg-8">
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

            <h4 class="header-title m-t-0 m-b-30">Kehadiran Dosen</h4>

            <div class="table-responsive">
                <table id="example" class="table">



                    <thead>
                    <tr>

                        <th></th>
                        <th>Nip</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Lokasi</th>
                        <th>Last Update</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="kehadiranDosen in kehadiranDosens">

                        <td><img height="50" width="50" class="img-circle user-img user-img" v-bind:src="'<?= Yii::$app->getHomeUrl() ?>/files/images/dosen/' + kehadiranDosen.foto"/></td>
                        <td>{{ kehadiranDosen.nip }}</td>
                        <td>{{ kehadiranDosen.nama_dosen }}</td>
                        <td><div v-if="kehadiranDosen.status_kehadiran == 'Hadir'">
                                <span class="label label-success">{{ kehadiranDosen.status_kehadiran }}</span>
                            </div>
                            <div v-else>
                                <span class="label label-danger">{{ kehadiranDosen.status_kehadiran }}</span>
                            </div>
                        </td>
                        <td>{{ kehadiranDosen.nama_kota }}</td>
                        <td>{{ kehadiranDosen.last_update }}</td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- end col -->

</div>


<script type="text/javascript" src="<?= Yii::$app->getHomeUrl()?>custom/vue/axios.js"></script>
<script type="text/javascript"src="<?= Yii::$app->getHomeUrl()?>custom/vue/vue.min.js"></script>
<script type="text/javascript" src="<?= Yii::$app->getHomeUrl()?>custom/vue/app.js"></script>