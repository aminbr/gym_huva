<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en" dir="rtl">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 28 Jun 2017 08:47:52 GMT -->
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $this->theme->getUrl('assets/img/apple-icon.png'); ?>" />
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>ورود</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-pro" />
    <!--  Social tags      -->
    <meta name="keywords" content="material dashboard, bootstrap material admin, bootstrap material dashboard, material design admin, material design, creative tim, html dashboard, html css dashboard, web dashboard, freebie, free bootstrap dashboard, css3 dashboard, bootstrap admin, bootstrap dashboard, frontend, responsive bootstrap dashboard, premiu material design admin">
    <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta itemprop="image" content="../../../../s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="../../../../s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://www.creative-tim.com/product/material-dashboard-pro" />
    <meta property="og:image" content="../../../../s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg" />
    <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design." />
    <meta property="og:site_name" content="Creative Tim" />
    <?= $this->head(); ?>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>
<?php $this->beginBody(); ?>
<body>
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">سیستم هوشمند باشگاه بدن سازی</a>
            </div>
<!--            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../dashboard.html">
                            <i class="material-icons">dashboard</i> داشبورد
                        </a>
                    </li>
                    
                    <li class=" active ">
                        <a href="login.html">
                            <i class="material-icons">fingerprint</i> ورود
                        </a>
                    </li>
                    <li class="">
                        <a href="lock.html">
                            <i class="material-icons">lock_open</i> قفل
                        </a>
                    </li>
                </ul>
            </div>-->
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="<?= $this->theme->getUrl('asset/img/login.jpg'); ?>">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <?= $content ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="http://www.huva.ir/contact/contactus.html">
                                    تماس با ما
                                </a>
                            </li>
                            <li>
                                <a href="http://www.huva.ir/contact/about.html">
                                    درباره ما
                                </a>
                            </li>
                            <li>
                                <a href="http://www.facebook.com/huva">
                                    پروفایل
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    وبلاگ رسمی شرکت
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        ساخته شده توسط تیم برنامه نویسی <a href="http://www.huva.ir/">شرکت هیوا</a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title">Background Style</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Background Image</p>
                    <div class="togglebutton switch-sidebar-image">
                        <label>
                            <input type="checkbox" checked="">
                        </label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                    <p>Filters</p>
                    <div class="badge-colors pull-right">
                        <span class="badge filter active" data-color="black"></span>
                        <span class="badge filter badge-blue" data-color="blue"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                        <span class="badge filter badge-purple" data-color="purple"></span>
                        <span class="badge filter badge-rose" data-color="rose"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Background Images</li>
            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= $this->theme->getUrl('asset/img/sidebar-1.jpg'); ?>" data-src="<?= $this->theme->getUrl('assets/img/login.jpeg'); ?>" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= $this->theme->getUrl('asset/img/sidebar-2.jpg'); ?>" data-src="<?= $this->theme->getUrl('asset/img/lock.jpeg'); ?>" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= $this->theme->getUrl('asset/img/sidebar-3.jpg'); ?>" data-src="<?= $this->theme->getUrl('asset/img/header-doc.jpeg'); ?>" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= $this->theme->getUrl('asset/img/sidebar-4.jpg'); ?>" data-src="<?= $this->theme->getUrl('asset/img/bg-pricing.jpeg'); ?>" alt="" />
                </a>
            </li>
            <li class="button-container">
                <div class="">
                    <a href="http://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-primary btn-block btn-fill">Buy Now!</a>
                </div>
                <div class="">
                    <a href="http://www.creative-tim.com/product/material-dashboard" target="_blank" class="btn btn-info btn-block">Get Free Demo</a>
                </div>
            </li>
            <li class="header-title">Thank you for 95 shares!</li>
            <li class="button-container">
                <button id="twitter" class="btn btn-social btn-twitter btn-round"><i class="fa fa-twitter"></i> &middot; 45</button>
                <button id="facebook" class="btn btn-social btn-facebook btn-round"><i class="fa fa-facebook-square"></i> &middot; 50</button>
            </li>
        </ul>
    </div>
</div>-->
<?php $this->endBody() ?>
</body>
<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 28 Jun 2017 08:47:53 GMT -->
</html>
<?php $this->endPage() ?>

