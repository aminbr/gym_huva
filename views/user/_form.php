<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'options' => [
        'data-pjax' => 1
    ]
]);
?>
        <div class="card">
            <div class="card-header" data-background-color="green">
                <h4 class="title">ثبت کاربر</h4>
                <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($userModel, 'password', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->passwordInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => ' رمز ورود را وارد کنید',
                                'tabindex' => '3',
                                'maxlength' => '20',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <?=
                            $form->field($userModel, 'username', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'نام کاربری را وارد کنید',
                                'tabindex' => '2',
                                'maxlength' => '20',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($userModel, 'nickname', [
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

                            <span class="material-input"></span></div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <?php
                            $levelUser = Yii::$app->user->identity->level;
                            if($levelUser == 6){
                                echo $form->field($userModel, 'level', [
                                    'options' =>
                                        [
                                            'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                        ],
                                ])->dropDownList([
                                    '6' => 'کاربر شرکت',
                                ], [
                                    'prompt' => ' انتخاب کنید',
                                    'class' => 'form-control',
                                    'dir' => 'rtl',
                                    'tabindex' => '5',
                                ]);
                            }
                            else
                            {
                                echo $form->field($userModel, 'level', [
                                    'options' =>
                                        [
                                            'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                        ],
                                ])->dropDownList($levelArray, [
                                    'prompt' => ' انتخاب کنید',
                                    'class' => 'form-control',
                                    'dir' => 'rtl',
                                    'tabindex' => '5',
                                ]);
                            }
                            ?>
                            <span class="material-input"></span></div>
                    </div>

                    <div class="col-md-7">
                        <div class="form-group">
                            <?=
                            $form->field($userModel, 'email')->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'ایمیل کاربر را وارد کنید',
                                'tabindex' => '4',
                                'maxlength' => '30',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?=
                            $form->field($userModel, 'status')->checkbox([
                                'label' => 'وضعیت فعال بودن کاربر',
                                'value' => '1',
                                'tabindex' => '6',
                            ])
                            ?>
                            <span class="material-input"></span></div>
                    </div>
                </div>
                    <?=
                    Html::submitInput('ثبت', [
                        'class' => 'btn btn-success pull-right btn-block',
                        'tabindex' => '7',
                    ]);
                    ?>
                <div class="clearfix"></div>
            </div>
        </div>

<?php ActiveForm::end(); ?>