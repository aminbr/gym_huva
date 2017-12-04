<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'options' => array(
        'data-pjax' => 1,
    )
]);
?>
        <div class="card">
            <div class="card-header" data-background-color="green">
                <h4 class="title">ثبت کلاس</h4>
                <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($classModel, 'price', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => ' قیمت کلاس را وارد کنید',
                                'tabindex' => '3',
                                'maxlength' => '8',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <?=
                            $form->field($classModel, 'class_type', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->dropDownList($classTypeArray, [
                                'prompt' => ' انتخاب کنید',
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'tabindex' => '2',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($classModel, 'name', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'نام کلاس را وارد کنید',
                                'tabindex' => '1',
                                'maxlength' => '20',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group ">
                            <?=
                                $form->field($classModel, 'time_limit', [
                                    'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                                ])->dropDownList(array(
                                    '1' => '1 ساعت',
                                    '2' => '2 ساعت',
                                    '3' => '3 دقیقه',
                                ), array(
                                    'tabindex' => '6',
                                    'prompt' => ' انتخاب کنید',
                                )); 
                            ?>
                            

                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($classModel, 'day_limit', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'تعداد روز قابل استفاده را وارد کنید',
                                'tabindex' => '5',
                                'maxlength' => '3',
                            ]);
                            ?>
                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($classModel, 'number_day', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'تعداد روز کلاس را وارد کنید',
                                'tabindex' => '4',
                                'maxlength' => '3',
                            ]);
                            ?>
                            <span class="material-input"></span></div>
                    </div>
                </div>
                
                <div class="row">

                    <div class="col-md-4 col-md-offset-8">
                        <div class="form-group ">
                            <?=
                                $form->field($classModel, 'paired_odd', [
                                    'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                                ])->dropDownList(array(
                                    '1' => 'روزهای زوج',
                                    '2' => 'روزهای فرد',
                                    '3' => 'هر روز',
                                ), array(
                                    'tabindex' => '7',
                                    'prompt' => ' انتخاب کنید',
                                )); 
                            ?>
                            

                            <span class="material-input"></span></div>
                    </div>
                </div>
                    <?=
                    Html::submitInput('ثبت', [
                        'class' => 'btn btn-success pull-right btn-block',
                        'tabindex' => '8',
                    ]);
                    ?>
                <div class="clearfix"></div>
            </div>
        </div>

<?php ActiveForm::end(); ?>
