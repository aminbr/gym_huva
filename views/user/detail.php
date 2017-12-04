<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
//die(var_dump($userModel));
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="rose">
                <h4 class="title">اطلاعات کاربر</h4>
                <p class="category">اطلاعات تکمیلی کاربر سیستم</p>
            </div>
            <div class="card-content table-responsive">
                <table class="table">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/gym/themes/gym/asset/img/faces/avatar.jpg" style="border-radius: 50%;">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><?= $userModel->nickname ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>نام :</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><?= $userModel->username ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>نام کاربری :</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><?= $userModel->email ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>ایمیل :</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>
                                    <?php   
                                        if($userModel->status == "1"){
                                            echo 'فعال';
                                        }else{
                                            echo 'غیر فعال';
                                        } 
                                    ?>
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>وضعیت :</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>
                                    <?php   
                                        if($userModel->level == "1"){
                                            echo 'کاربر';
                                        }else if($userModel->level == "2"){
                                            echo 'حسابدار';
                                        }else if($userModel->level == "3"){
                                            echo 'مدیر';
                                        }  
                                    ?>
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>دسترسی :</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>