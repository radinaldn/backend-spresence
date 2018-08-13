<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 02/06/18
 * Time: 23:50
 */

namespace app\assets;

use yii\web\AssetBundle;


class CustomAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'custom/assets/plugins/morris/morris.css',
        'custom/assets/css/bootstrap.min.css',
        'custom/assets/css/core.css',
        'custom/assets/css/components.css',
        'custom/assets/css/icons.css',
        'custom/assets/css/pages.css',
        'custom/assets/css/menu.css',
        'custom/assets/css/responsive.css',
        //'custom/assets/css/jquery.dataTables.min.css',
    ];
    public $js = [
        'custom/assets/js/modernizr.min.js',
        'custom/assets/js/jquery.min.js',
        'custom/assets/js/bootstrap.min.js',
        'custom/assets/js/detect.js',
        'custom/assets/js/fastclick.js',
        'custom/assets/js/jquery.slimscroll.js',
        'custom/assets/js/jquery.blockUI.js',
        'custom/assets/js/waves.js',
        'custom/assets/js/wow.min.js',
        'custom/assets/js/jquery.nicescroll.js',
        'custom/assets/js/jquery.scrollTo.min.js',
        'custom/assets/plugins/jquery-knob/jquery.knob.js',
        'custom/assets/plugins/morris/morris.min.js',
        'custom/assets/plugins/raphael/raphael-min.js',
        'custom/assets/pages/jquery.dashboard.js',
        'custom/assets/js/jquery.core.js',
        'custom/assets/js/jquery.app.js',
//        'custom/assets/js/jquery.dataTables.min.js',
//        'custom/assets/js/jquery-3.3.1.js',
//        'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js',
//        'https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'fedemotta\datatables\DataTablesAsset',
    ];
}
