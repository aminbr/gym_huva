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
<div>
    <div class="">
        <div class="card">
            <div class="card-header" data-background-color="green">
                <h4 class="title">ویرایش کلاس عضو در سیستم</h4>
                <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($setClassModel, 'typeClass', [
                                'options' =>
                                    [
                                        'class' => 'form-group fieald-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->dropDownList($classArray, [
                                'prompt' => ' انتخاب کنید',
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'tabindex' => '2',
                            ]);
                            ?>
                        <span class="material-input"></span></div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($setClassModel, 'tagMember')->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'شماره کارت را وارد کنید',
                                'tabindex' => '1',
                                'maxlength' => '20',
                            ]);
                            ?>
                        <span class="material-input"></span></div>
                    </div>
                </div>
                
                <?=
                Html::submitInput('ثبت کارت', [
                    'class' => 'btn btn-success pull-right btn-block',
                    'tabindex' => '2',
                ]);
                ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>