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
        'custom/assets/plugins/bootstrap/css/bootstrap.min.css',
        'custom/assets/plugins/chartist-js/dist/chartist.min.css',
        'custom/assets/plugins/chartist-js/dist/chartist-init.css',
        'custom/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css',
        'custom/assets/plugins/c3-master/c3.min.css',
        'custom/lite/css/style.css',
        'custom/lite/css/colors/blue.css',
    ];
    public $js = [
        'custom/assets/plugins/jquery/jquery.min.js',
        'custom/assets/plugins/bootstrap/js/tether.min.js',
        'custom/assets/plugins/bootstrap/js/bootstrap.min.js',
        'custom/lite/js/jquery.slimscroll.js',
        'custom/lite/js/waves.js',
        'custom/lite/js/sidebarmenu.js',
        'custom/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js',
        'custom/lite/js/custom.min.js',
        'custom/assets/plugins/chartist-js/dist/chartist.min.js',
        'custom/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js',
        'custom/assets/plugins/d3/d3.min.js',
        'custom/assets/plugins/c3-master/c3.min.js',
        'custom/lite/js/dashboard1.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
