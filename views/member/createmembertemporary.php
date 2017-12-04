<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in  editor.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
?>
<div class="row">
    <div class="col-md-6 col-md-offset-6">
        <div class="card">
            <div class="card-header" data-background-color="green">
                <h4 class="title"><?= $title ?></h4>
                <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?=
                            $form->field($memberTemporaryModel, 'day_limit', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',                                       
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'محدودیت استفاده را وارد کنید',
                                'tabindex' => '2',
                                'maxlength' => '2',
                            ]);
                            ?>
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?=
                            $form->field($memberTemporaryModel, 'name', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',                                       
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'نام را وارد کنید',
                                'tabindex' => '1',
                                'maxlength' => '20',
                            ]);
                            ?>
                            <span class="material-input"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        <div class="form-group">
                            <?=
                            $form->field($memberTemporaryModel, 'tag_number', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',                                       
                                    ],
                            ])->passwordInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'شماره کارت را وارد کنید',
                                'tabindex' => '3',
                                'maxlength' => '20',
                            ]);
                            ?>
                            <span class="material-input"></span>
                        </div>
                    </div>
                </div>
            </div>


            <?=
            Html::submitInput('ثبت عضو', [
                'class' => 'btn btn-success pull-right btn-block',
                'tabindex' => '4',
            ]);
            ?>
            <div class="clearfix"></div>
            </div>
    </div>
</div>
        

<?php ActiveForm::end(); ?>