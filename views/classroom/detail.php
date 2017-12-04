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
                <h4 class="title">اطلاعات کلاس</h4>
                <p class="category">اطلاعات تکمیلی کاربر سیستم</p>
            </div>
            <div class="card-content table-responsive">
                <table class="table">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/gym/web/../themes/gym/asset/img/faces/avatar.jpg" style="border-radius: 50%;">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><?= $classModel->name ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>نام کلاس :</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><?= $classModel->price ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>قیمت کلاس :</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><?= $classModel->number_day ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>تعداد روزهای اعتبار :</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><?= $classModel->time_limit ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>زمان حضور در باشگاه :</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><?= $classModel->day_limit ?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>روزهای حضور در باشگاه :</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>