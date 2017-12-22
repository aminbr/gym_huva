<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\helpers\Url;
use omnilight\assets\SweetAlertAsset;
use scotthuangzl\googlechart\GoogleChart;

SweetAlertAsset::register($this);
AdminAsset::register($this);
$url = Yii::$app->request->get('r');
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>" dir="rtl">
    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <?php $this->head() ?>
        <style>
            .dropdown-menu-alarm{
                width: 250px;
            }
        </style>
    </head>
    <?php $this->beginBody() ?>
    <body onload="">

        <div class="wrapper">
            <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="<?= $this->theme->getUrl('asset/img/sidebar-1.jpg') ?>">
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
<!--            <div class="logo">
                <a href="http://www.huva.ir/" class="simple-text">
                    هیوا
                </a>
            </div>-->
<!--            <div class="logo logo-mini">
                <a href="http://www.creative-tim.com/" class="simple-text">
                    Ct
                </a>
            </div>-->
            <div class="sidebar-wrapper">
<!--                <div class="user">
                    <div class="photo">
                        <img src="<?= $this->theme->getUrl('asset/img/faces/avatar.jpg') ?>" />
                    </div>
                    
                </div>-->
                <ul class="nav" style="padding: 0px;">
                    <li class="active">
                            <?= Html::a('<i class="material-icons"><span class="fa fa-dashboard">'
                                    . '</span></i><p>داشبورد</p>', ['gym/dashboard']) ?>
                            
                    </li>
<!--                    <li>
                        <a data-toggle="collapse" href="#pagesExamples">
                            <i class="material-icons"><span class="fa fa-file-text"></span></i>
                            <p>صفحه ها
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="pagesExamples">
                            <ul class="nav">
                                <li>
                                    <a href="pages/pricing.html">Pricing</a>
                                </li>
                                <li>
                                    <a href="pages/timeline.html">Timeline</a>
                                </li>
                                <li>
                                    <a href="pages/login.html">Login Page</a>
                                </li>
                                <li>
                                    <a href="pages/register.html">Register Page</a>
                                </li>
                                <li>
                                    <a href="pages/lock.html">Lock Screen Page</a>
                                </li>
                                <li>
                                    <a href="pages/user.html">User Profile</a>
                                </li>
                            </ul>
                        </div>
                    </li>-->
                    <?php 
//                    if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 3 || Yii::$app->user->identity->level == 6){
//                        echo '<li>
//                        <a data-toggle="collapse" href="#componentsExamples">
//                            <i class="material-icons"><span class="fa fa-user-circle-o"></span></i>
//                            <p>کاربرها
//                                <b class="caret"></b>
//                            </p>
//                        </a>
//                        <div class="collapse" id="componentsExamples">
//                            <ul class="nav">
//                                <li>';
//                                echo Html::a('نمایش کاربران', ['user/user-list']);
//                            echo '</li>
//                                </ul>
//                            </div>
//                        </li>';
//                    }  
                    ?>

                    <?php 
                    if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 3 || Yii::$app->user->identity->level == 1){
                        echo '<li>
                        <a data-toggle="collapse" href="#formsExamples">
                            <i class="material-icons"><span class="fa fa-users"></span></i>
                            <p>عضوها
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="formsExamples">
                            <ul class="nav">
                                <li>';
                                echo Html::a('نمایش عضوها', ['member/member-list']);
                            echo '</li>
                                <li>';
                                echo Html::a('ویرایش کلاس عضو', ['gym/edit-member-class'],[
                                'onclick' => 'showModalClassRoom(this);return false;'
                            ]);
                            echo '</li>
                                </ul>
                            </div>
                        </li>';
                    }  
                    ?>

                    <?php 
//                    if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 3 || Yii::$app->user->identity->level == 1){
//                        echo '<li>
//                        <a data-toggle="collapse" href="#temporaryExamples">
//                            <i class="material-icons"><span class="fa fa-users"></span></i>
//                            <p>عضو موقت
//                                <b class="caret"></b>
//                            </p>
//                        </a>
//                        <div class="collapse" id="temporaryExamples">
//                            <ul class="nav">
//                                <li>';
//                                echo Html::a('ثبت عضو موقت', ['member/member-temporary']);
//                            echo '</li>
//                                </ul>
//                            </div>
//                        </li>';
//                    }  
                    ?>
                                
                    <?php 
                    if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 6){
                        echo '<li>
                        <a data-toggle="collapse" href="#tablesExamples">
                            <i class="material-icons"><span class="fa fa-id-card-o"></span></i>
                            <p>کارت
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="tablesExamples">
                            <ul class="nav">
                                <li>';
                                echo Html::a('ثبت کارت', ['tag/tag-create']);
                            echo '</li>
                            </ul>
                        </div>
                    </li>';
                    }  
                    ?>
                    
                    <?php 
                    if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 3){
                        echo '<li>
                        <a data-toggle="collapse" href="#classExamples">
                            <i class="material-icons"><span class="fa fa-pencil-square"></span></i>
                            <p>کلاس ها
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="classExamples">
                            <ul class="nav">
                                <li>';
                                echo Html::a('ثبت کلاس', ['classroom/class-list']);
                            echo '</li>
                            </ul>
                        </div>
                    </li>';
                    }  
                    ?>
                         
                    <?php 
                    if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 3){
                        echo '<li>
                        <a data-toggle="collapse" href="#reportExamples">
                            <i class="material-icons"><span class="fa fa-sticky-note"></span></i>
                            <p>گزارشات
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="reportExamples">
                            <ul class="nav">';
//                                echo '<li>'.Html::a('افراد درون باشگاه', ['report/report-gym']).'</li>';
                                echo '<li>'.Html::a('گردش مالی', ['report/report-fund']).'</li>';
                                echo '<li>'.Html::a('لیست تلفن ها', ['report/report-telephone']).'</li>';
                            echo '</ul>
                        </div>
                    </li>';
                    }  
                    ?>
                    
                    <?php 
                    if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 3 ||Yii::$app->user->identity->level == 6){
                        echo '<li>
                        <a data-toggle="collapse" href="#settingExamples">
                            <i class="material-icons"><span class="fa fa-cogs"></span></i>
                            <p>تنظیمات
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="settingExamples">
                            <ul class="nav">
                                <li>';
                                echo '<li>'.Html::a('کاربرها', ['user/user-list']).'</li>';
                                echo '<li>'.Html::a('کمدهای درون باشگاه', ['setting/setting-dresser']).'</li>';
                                echo '<li>'.Html::a('به روزآوری نرم افزار', ['setting/update-system']).'</li>';
                            echo '</li>
                            </ul>
                        </div>
                    </li>';
                    }  
                    ?>
                    
                    <?php 
                    if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 6){
                        echo '<li>
                        <a data-toggle="collapse" href="#settingAdvance">
                            <i class="material-icons"><span class="fa fa-cogs"></span></i>
                            <p>تنظیمات سیستمی
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="settingAdvance">
                            <ul class="nav">
                                ';
                                echo '<li>'.Html::a('تنظیمات اولیه', ['setting/setting-advance']).'</li>';
                                echo '<li>'.Html::a('اضافه کردن کمد', ['setting/add-relay']).'</li>';
                            echo '</ul>
                        </div>
                    </li>';
                    }  
                    ?>
                    
<!--                    <li>
                        
                        <?php // echo Html::a('<i class="material-icons"><span class="fa fa-sign-out"></span></i>'.'خروج', ['/gym/logout']) ?>
                    </li>-->
                    
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
<!--                     <div class="navbar-minimize navbar-right">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>-->
                    <div class="navbar-header navbar-right">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <marquee direction="right"><a class="navbar-brand" href="#"> باشگاه بدنسازی <span id="labelNameGym" class="text-danger"></span> </a></marquee>
                        
                        
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
<!--                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons"><i class="fa fa-dashboard"></i></i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                                    <i class="material-icons"><i class="fa fa-bell-o"></i></i>
                                    <span class="notification">0</span>
                                    <p class="hidden-lg hidden-md">
                                        Notifications
                                        <b class="caret"></b>
                                    </p>
                                    <div class="ripple-container"></div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-alarm">
<!--                                    <li>
                                        <a href="#">Mike John responded to your email</a>
                                    </li>
                                    <li>
                                        <a href="#">You have 5 new tasks</a>
                                    </li>
                                    <li>
                                        <a href="#">You're now friend with Andrew</a>
                                    </li>
                                    <li>
                                        <a href="#">Another Notification</a>
                                    </li>
                                    <li>
                                        <a href="#">Another One</a>
                                    </li>-->
                                </ul>
                            </li>
                            <li>
                                <?= Html::a('<i class="material-icons"><i class="fa fa-television"></i></i>', [
                                    'gym/dashboard-memberpage' ], [
                                        'target' => '_blank',
                                    ]);
                                ?>
<!--                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons"><i class="fa fa-user-circle"></i></i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>-->
                            </li>
                            <li>
                                <?= Html::a('<i class="material-icons"><span class="fa fa-sign-out"></span></i>', ['/gym/logout']) ?>
                            </li>
                            <li>
                                <a>نام کاربر وارد شده : <?php echo Yii::$app->user->identity->username; ?></a>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
<!--                        <form class="navbar-form navbar-left" role="search">
                            <div class="form-group form-search is-empty">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="material-input"></span>
                            </div>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons"><i class="fa fa-search"></i></i>
                                <div class="ripple-container"></div>
                            </button>
                        </form>-->
                    </div>
                    
                   
                </div>
            </nav>
            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="card card-stats">
                            <?= Html::a('<div class="card-header" data-background-color="orange">
                                            <i class="fa fa-cloud"></i>
                                        </div>',
                                    ['gym/open-dresser'],[
                                'onclick' => 'showModalOpenDresser(this);return false;'
                            ]) ?>
                            
                            <div class="card-content">
                                <p class="category"></p>
                                <h4 class="card-title">باز کردن کمد</h4>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons text-danger">هشدار</i>
                                    <a href="#pablo">در مواقع اضطراری استفاده شود</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="card card-stats">
                            <?= Html::a('<div class="card-header" data-background-color="red">
                                            <i class="fa fa-eye"></i>
                                        </div>',
                                    ['report/report-gym'],[
                            ]) ?>
                            <div class="card-content">
                                <!--<p class="category"></p>-->
                                <h4 class="card-title">ظرفیت:<span id="labelCapacity"></span>نفر</h4>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <!--<i class="material-icons"><i class="fa fa-history"></i></i>-->
                                    تعداد افراد درون باشگاه :<span id="labelOnMember"></span>نفر
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="card card-stats">
                            <?= Html::a('<div class="card-header" data-background-color="green">
                                            <i class="fa fa-plus"></i>
                                        </div>',
                                    ['member/member-create'],[
                                'onclick' => 'showModalClassRoom(this);return false;'
                            ]) ?>
                            <div class="card-content">
                                <!--<p class="category">درآمد</p>-->
                                <h5 class="card-title">ثبت نام</h5>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    تعداد افراد ثبت نام شده :<span id="countMemberRegister"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="card card-stats">
                            <?= Html::a('<div class="card-header" data-background-color="blue">
                                            <i class="fa fa-plus"></i>
                                        </div>',
                                    ['gym/give-class'],[
                                'onclick' => 'showModalClassRoom(this);return false;'
                            ]) ?>
                            <div class="card-content">
                                <p class="category"></p>
                                <h4 class="card-title">تخصیص کلاس</h4>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    تعداد کلاس های ثبت شده : <span id="countClass"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
<!--                    <div class="col-lg-3 col-md-12 col-sm-12 col-md-offset-0 col-lg-offset-6">
                        <div class="card card-stats">-->
                            <?php
//                            echo Html::a('<div class="card-header" data-background-color="blue">
//                                            <i class="fa fa-address-card-o"></i>
//                                        </div>',
//                                    ['member/member-temporary']) 
//                                    ?>
                            
<!--                            <div class="card-content">
                                <p class="category"></p>
                                <h4 class="card-title">ثبت نام موقت</h4>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    تعداد افراد ثبت نام موقت :<span id="labelOnMember"></span>نفر
                                </div>
                            </div>
                        </div>
                    </div>-->
<!--                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="card card-stats">-->
                            <?php // echo Html::a('<div class="card-header" data-background-color="orange">
//                                            <i class="fa fa-credit-card"></i>
//                                        </div>',
//                                    ['tag/tag-create']) ?>
                            
<!--                            <div class="card-content">
                                <p class="category"></p>
                                <h4 class="card-title">ساخت کارت جدید</h4>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    ایجاد کارت در سیستم
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
                
                <div class="container-fluid">
                    <?= $content ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
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
<!--    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Filters</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger active-color">
                        <div class="badge-colors text-center">
                            <span class="badge filter badge-purple" data-color="purple"></span>
                            <span class="badge filter badge-blue" data-color="blue"></span>
                            <span class="badge filter badge-green" data-color="green"></span>
                            <span class="badge filter badge-orange" data-color="orange"></span>
                            <span class="badge filter badge-red" data-color="red"></span>
                            <span class="badge filter badge-rose active" data-color="rose"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="header-title">Sidebar Background</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="text-center">
                            <span class="badge filter badge-white" data-color="white"></span>
                            <span class="badge filter badge-black active" data-color="black"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger">
                        <p>Sidebar Mini</p>
                        <div class="togglebutton switch-sidebar-mini">
                            <label>
                                <input type="checkbox" unchecked="">
                            </label>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger">
                        <p>Sidebar Image</p>
                        <div class="togglebutton switch-sidebar-image">
                            <label>
                                <input type="checkbox" checked="">
                            </label>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="header-title">Images</li>
                <li class="active">
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="<?= $this->theme->getUrl('asset/img/sidebar-1.jpg') ?>" alt="" />
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="<?= $this->theme->getUrl('asset/img/sidebar-2.jpg') ?>" alt="" />
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="<?= $this->theme->getUrl('asset/img/sidebar-3.jpg') ?>" alt="" />
                    </a>
                </li>
                <li>
                    <a class="img-holder switch-trigger" href="javascript:void(0)">
                        <img src="<?= $this->theme->getUrl('asset/img/sidebar-4.jpg') ?>" alt="" />
                    </a>
                </li>
                <li class="button-container">
                    <div class="">
                        <a href="http://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-rose btn-block">Buy Now</a>
                    </div>
                    <div class="">
                        <a href="http://www.creative-tim.com/product/material-dashboard" target="_blank" class="btn btn-info btn-block">Get Free Demo</a>
                    </div>
                </li>
                <li class="header-title">Thank you for 95 shares!</li>
                <li class="button-container">
                    <button id="twitter" class="btn btn-social btn-twitter btn-round"><i class="fa fa-twitter"></i> &middot; 45</button>
                    <button id="facebook" class="btn btn-social btn-facebook btn-round"><i class="fa fa-facebook-square"> &middot;</i>50</button>
                </li>
            </ul>
        </div>
    </div>-->

        <?php
 Modal::begin([
     'id' => 'class-room-modal',
     'size' => Modal::SIZE_LARGE
 ]);
 Pjax::begin(['id' => 'class-room-pjax', 'enablePushState' => false, 'timeout' => false]);
$this->registerJs("
    
    function showModal(obj)
    {
        var url = $(obj).attr('href');
        $.ajax({
            url:url
        })
        .done(function(data){
            $('#class-room-pjax').html(data);
            $('#class-room-modal').modal('show');
        });
        
        return false;
    }
    
    function showModalClassRoom(obj)
    {
        var url = $(obj).attr('href');
        $.ajax({
            url:url
        })
        .done(function(data){
            $('#class-room-pjax').html(data);
            $('#class-room-modal').modal('show');
        });
        
        return false;
    }
    
    function showModalOpenDresser(obj)
    {
        var url = $(obj).attr('href');
        $.ajax({
            url:url
        })
        .done(function(data){
            $('#class-room-pjax').html(data);
            $('#class-room-modal').modal('show');
        });
        
        return false;
    }

    function callbackPjaxMember(data)
    {
        if(data.result == true){
            $('#member-list-modal').modal('hide');
            $('#class-room-modal').modal('hide');
            $.pjax.reload({
                timeout: false,
                push:false,
            });
            swal({
                title: 'ثبت کلاس موفقیت آمیز بود',
//                text: data.message,
                type: 'success',
                showCancelButton: false,
                showConfirmButton: false,
                closeOnConfirm: false,
                timer:2500,
            });
        }else if(!data.result == true){
            swal({
                title: 'Are you sure?',
                text: data.message,
                type: 'error',
            });
        }
        return false;
    }
    
    function callbackPjaxClassRoom(data)
    {
        if(data.result == true){
            $('#class-room-modal').modal('hide');
            swal({
                title: 'ثبت کلاس موفقیت آمیز بود',
//                text: data.message,
                type: 'success',
                showCancelButton: false,
                showConfirmButton: false,
                closeOnConfirm: false,
                timer:2500,
            });
        }else if(!data.result == true){
            swal({
                title: 'Are you sure?',
                text: data.message,
                type: 'error',
            });
        }
        
        return false;
    }
    ", yii\web\View::POS_END);
Pjax::end();
Modal::end(); ?>
        <?php $this->endBody() ?>
    </body>


    <script type="text/javascript">
    $(document).ready(function () {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
    
    </script>

</html>
<?php
$this->registerJs("
    
        //loadGym();
        function loadGym(){
            $.ajax({
                url: '".Yii::$app->urlManager->CreateAbsoluteUrl(['gym/gym-capacity'])."',
                method: 'GET',
                dataType: 'JSON',
                success: function (returnData) {
//                    console.log(returnData);
                    $('#labelCapacity').text(returnData.capacity);
                    $('#labelOnMember').text(returnData.countMemberEnter);
                    $('#labelNameGym').text(returnData.nameGym);
                    $('#countClass').text(returnData.countClass);
                    $('#countMemberRegister').text(returnData.countMemberRegister);
                }
            })
        }
        setInterval(loadGym,2000); 
        

        //Alarm
        function loadAlarm(){
            $.ajax({
                url: '".Yii::$app->urlManager->CreateAbsoluteUrl(['gym/alarm-time'])."',
                method: 'GET',
                dataType: 'JSON',
                success: function (returnData) {
                    $('.notification').text(returnData.count);
                }
            });
        }
        setInterval(loadAlarm,2000); 
        

        // open menu alarm 
        $('.navbar-left .dropdown .dropdown-toggle').click(function(){
        $('.dropdown-menu-alarm').empty();
            $.ajax({
                url: '".Yii::$app->urlManager->CreateAbsoluteUrl(['gym/alarm-time'])."',
                method: 'GET',
                dataType: 'JSON',
                success: function (returnData) {
                    console.log(returnData);
                    $('.notification').text(returnData.count);
                    var memberInfo = '';
                    for(var i = 0 ; i < returnData.count ; i++)
                    {
                        memberInfo += '<li class=text-right style=cursor:pointer><a onClick=exitMember('+returnData[i].id+')>'+returnData[i].nickname+' '+returnData[i].family+'<span style=float:left ; margin-right:60px> خروج</span></a></li>';
                    }
                    console.log(memberInfo);
                    $('.dropdown-menu-alarm').append(memberInfo);
                }
            });
            $('.navbar-left .dropdown').addClass('open');
            $(this).css('aria-expanded', 'true');
        });
        
        function exitMember(id){
//        console.log(id);
            $.ajax({
                url: '".Yii::$app->urlManager->CreateAbsoluteUrl(['gym/exit-member'])."',
                data: {id:id},
                method: 'GET',
                dataType: 'JSON',
                success: function (returnData) {
                    if(returnData == '1'){
                        swal({
                            title: 'خروج با موفقیت ثبت شد',
                            type: 'warning',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnConfirm: false,
                            timer:3000,
                        });
                    }
                }
            });
        }
        

        $('.btn-alarm-toggle').click(function(){
            var number = $(this).attr('data-number');
            var url = $(this).attr('data-member');
            $.ajax({
                url:'http://'+url+'/'+number+'n'
            });
        });
    ", yii\web\View::POS_END);
    ?>
<?php $this->endPage() ?>


