<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Dosen;
use yii\helpers\Url;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\CustomAsset;

CustomAsset::register($this);
?>

<!---->

<?php $this->beginPage();
header('Access-Control-Allow-Origin: *');
include Yii::$app->basePath.'/views/layouts/show_cur_datetime.php';
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl ?>/custom/assets/images/favicon.ico">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">

<div>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('bc60d7c1c853ac34dde4', {
            cluster: 'ap1',
            encrypted: true
        });



    </script>
<div id="root">
<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo"><span>Smart<span>Presence</span></span></a>
            </div>
            <!-- End Logo container-->


            <div class="menu-extras">

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li>
                        <form role="search" class="navbar-left app-search pull-left hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                    <li>
                        <!-- Notification -->
<!--                        <div class="notification-box">-->
<!--                            <ul class="list-inline m-b-0">-->
<!--                                <li>-->
<!--                                    <a href="javascript:void(0);" class="right-bar-toggle">-->
<!--                                        <i class="zmdi zmdi-notifications-none"></i>-->
<!--                                    </a>-->
<!--                                    <div class="noti-dot">-->
<!--                                        <span class="dot"></span>-->
<!--                                        <span class="pulse"></span>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
                        <!-- End Notification bar -->
                    </li>

                    <li class="dropdown user-box">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown" aria-expanded="true">
                            <?php
                            $homeUrl = Yii::$app->getHomeUrl();
                            $fotoDosen = Yii::$app->user->identity->foto;
                            switch (Yii::$app->user->identity->level){
                                case "Dosen":
                                    echo "<img src='$homeUrl/files/images/dosen/$fotoDosen' alt='user-img' class='img-circle user-img'>";
                                    break;
                                case "Administrator":
                                    echo "<img src='$homeUrl/custom/assets/images/users/avatar-1.jpg' alt='user-img' class='img-circle user-img'>";
                                    break;
                                case "Pimpinan":
                                    echo "<img src='$homeUrl/files/images/dosen/$fotoDosen' alt='user-img' class='img-circle user-img'>";
                                    break;
                            }
                            ?>
                            <div class="user-status away"><i class="zmdi zmdi-dot-circle"></i></div>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
                            <li><a href="<?= Yii::$app->request->getBaseUrl() ?>/site/logout"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

        </div>
    </div>

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">


                    <li class="">
                        <a href="<?= Yii::$app->getHomeUrl() ?>" class=""><i class="zmdi zmdi-view-dashboard"></i> <span> Beranda <?= Yii::$app->user->identity->level ?> </span> </a>
                    </li>

                    <li class="">
                        <a href="<?= Url::to(['mengajar/index']); ?>" class=""><i class="zmdi zmdi-graduation-cap"></i> <span> Perkuliahan </span> </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to(['mahasiswa/index']); ?>" class=""><i class="zmdi zmdi-account-box"></i> <span> Mahasiswa </span> </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to(['dosen/index']); ?>" class=""><i class="zmdi zmdi-account-circle"></i> <span> Dosen </span> </a>
                    </li>

                    <?php if (Yii::$app->user->identity->level=="Administrator" || Yii::$app->user->identity->level=="Pimpinan") { ?>

                        <li class="">
                            <a href="<?= Url::to(['semester-aktif/index']); ?>" class=""><i class="zmdi zmdi-graduation-cap"></i> <span> Semester Aktif </span> </a>
                        </li>

                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-invert-colors"></i> <span> Lainnya </span> </a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="<?= Url::to(['mengambil/index']); ?>">Mengambil</a></li>
                                    <li><a href="<?= Url::to(['matakuliah/index']); ?>">Matakuliah</a></li>
                                    <li><a href="<?= Url::to(['presensi/index']); ?>">Presensi</a></li>
                                    <li><a href="<?= Url::to(['presensi-detail/index']); ?>">Presensi Detail</a></li>
                                    <li><a href="<?= Url::to(['kelas/index']); ?>">Kelas</a></li>
                                    <li><a href="<?= Url::to(['ruangan/index']); ?>">Ruangan</a></li>
                                    <li><a href="<?= Url::to(['fakultas/index']); ?>">Fakultas</a></li>
                                    <li><a href="<?= Url::to(['jurusan/index']); ?>">Jurusan</a></li>
                                    <li><a href="<?= Url::to(['site/logout']); ?>">Keluar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <?php } ?>

                    <li class="">
                        <a href="<?= Url::to(['site/logout']); ?>" class=""><i class="fa fa-power-off"></i> <span> Keluar </span> </a>
                    </li>


                </ul>
                <!-- End navigation menu  -->
            </div>
        </div>
    </div>
</header>
<!-- End Navigation Bar-->


<div class="wrapper">
    <div class="container">


        <span class="label label-info"><?php //cetakWelcome();
            echo cetakTanggalNow();
            ?>
            </span><span class="label label-inverse">
            Pukul :
            <!-- /*Menampilkan Waktu*/ -->
            <span id="clock"></span>
          <!-- /*Selesai Menampilkan Waktu*/
          /*Menampilakan Hari*/ -->
            </span>
          </br>


<?= $content; ?>
            </div>
        </div>

<!--        <!-- Footer -->
<!--        <footer class="footer text-right">-->
<!--            <div class="container">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-6">-->
<!--                        2018 © Inkubator.-->
<!--                    </div>-->
<!--                    <div class="col-xs-6">-->
<!--                        <ul class="pull-right list-inline m-b-0">-->
<!--                            <li>-->
<!--                                <a href="#">About</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">Help</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">Contact</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </footer>-->
        <!-- End Footer -->

    </div>
    <!-- end container -->



    <!-- Right Sidebar -->
    <div class="side-bar right-bar">
        <a href="javascript:void(0);" class="right-bar-toggle">
            <i class="zmdi zmdi-close-circle-o"></i>
        </a>
        <h4 class="">Notifications</h4>
        <div class="notification-list nicescroll">
            <ul class="list-group list-no-border user-list">
                <li class="list-group-item">
                    <a href="#" class="user-list-item">
                        <div class="avatar">
                            <img src="<?= Yii::$app->getHomeUrl() ?>custom/assets/images/users/avatar-2.jpg" alt="">
                        </div>
                        <div class="user-desc">
                            <span class="name">Michael Zenaty</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">2 hours ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="user-list-item">
                        <div class="icon bg-info">
                            <i class="zmdi zmdi-account"></i>
                        </div>
                        <div class="user-desc">
                            <span class="name">New Signup</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">5 hours ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="user-list-item">
                        <div class="icon bg-pink">
                            <i class="zmdi zmdi-comment"></i>
                        </div>
                        <div class="user-desc">
                            <span class="name">New Message received</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">1 day ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item active">
                    <a href="#" class="user-list-item">
                        <div class="avatar">
                            <img src="<?= Yii::$app->getHomeUrl() ?>custom/assets/images/users/avatar-3.jpg" alt="">
                        </div>
                        <div class="user-desc">
                            <span class="name">James Anderson</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">2 days ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item active">
                    <a href="#" class="user-list-item">
                        <div class="icon bg-warning">
                            <i class="zmdi zmdi-settings"></i>
                        </div>
                        <div class="user-desc">
                            <span class="name">Settings</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">1 day ago</span>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <!-- /Right-bar -->

</div>
</div>

<?php $this->endBody() ?>



<script type="text/javascript">

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // logicnya jika ada sinyal dari pusher langsung refresh API perkuliahan hari ini & kehadiran dosen
        $(function () {
            var i = -1;
            var toastCount = 0;
            var $toastlast;



                var shortCutFunction = 'info';
                var msg = 'Memulai '+data.matakuliah+' ('+data.kelas+') Pertemuan-'+data.pertemuan+' di '+data.ruangan;
                var title = data.dosen;
                var $showDuration = '300';
                var $hideDuration = '1000';
                var $timeOut = '10000';
                var $extendedTimeOut = '1000';
                var $showEasing = 'swing';
                var $hideEasing = 'linear';
                var $showMethod = 'fadeIn';
                var $hideMethod = 'fadeOut';
                var toastIndex = toastCount++;
                var addClear = null;

                toastr.options = {
                    closeButton: 'false',
                    debug: 'false',
                    newestOnTop: 'true',
                    progressBar: null,
                    positionClass: 'toast-top-right',
                    preventDuplicates: null,
                    onclick: null
                };

                if ($('#addBehaviorOnToastClick').prop('checked')) {
                    toastr.options.onclick = function () {
                        alert('You can perform some custom action after a toast goes away');
                    };
                }


                $('#toastrOptions').text('Command: toastr["'
                    + shortCutFunction
                    + '"]("'
                    + msg
                    + (title ? '", "' + title : '')
                    + '")\n\ntoastr.options = '
                    + JSON.stringify(toastr.options, null, 2)
                );

                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;

                if (typeof $toast === 'undefined') {
                    return;
                }

                if ($toast.find('#okBtn').length) {
                    $toast.delegate('#okBtn', 'click', function () {
                        alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                        $toast.remove();
                    });
                }
                if ($toast.find('#surpriseBtn').length) {
                    $toast.delegate('#surpriseBtn', 'click', function () {
                        alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                    });
                }
                if ($toast.find('.clear').length) {
                    $toast.delegate('.clear', 'click', function () {
                        toastr.clear($toast, {force: true});
                    });
                }
            ;

            function getLastToast() {
                return $toastlast;
            }

            $('#clearlasttoast').click(function () {
                toastr.clear(getLastToast());
            });
            $('#cleartoasts').click(function () {
                toastr.clear();
            });
        })
    });


</script>

</body>
</html>
<?php $this->endPage() ?>

