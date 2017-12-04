<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/gym/asset';
    public $css = [
        'css/custom.css',
        'fonts/font.css',
        'fonts/font-awesome/css/font-awesome.min.css',
        'css/bootstrap.min.css',
        'css/material-dashboard.css',
        'css/demo.css',
        'css/animate.css',
        'css/js-persian-cal.css',
    ];
    public $js = [
        'js/perfect-scrollbar.jquery.min.js',
        'js/jquery-ui.min.js',
        'js/bootstrap.min.js',
        'js/material.min.js',
        'js/jquery.validate.min.js',
        'js/moment.min.js',
        'js/chartist.min.js',
        'js/jquery.bootstrap-wizard.js',
        'js/bootstrap-notify.js',
        'js/jquery.sharrre.js',
        'js/bootstrap-datetimepicker.js',
        'js/jquery-jvectormap.js',//vector map
        'js/nouislider.min.js',//Sliders Plugin
        'js/jquery.select-bootstrap.js',//select plugin
        'js/jquery.datatables.js',//datatable plugin
        'js/sweetalert2.js',//sweet alert plugin
        'js/jasny-bootstrap.min.js',//plugin upload
        'js/fullcalendar.min.js', //calender plugin
        'js/jquery.tagsinput.js',//TagsInput Plugin
        'js/material-dashboard.js',
        'js/demo.js',
        'js/moment.min.js',
        'js/js-persian-cal.min.js',
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
