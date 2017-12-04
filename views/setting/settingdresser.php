<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'اضافه کردن رله';
$form = ActiveForm::begin();
?>
<div class="card">
    <div class="card-header" data-background-color="green">
        <h4 class="title">بخش ثبت کمد</h4>
        <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
    </div>
    <div class="card-content">
        <div class="row">
            <div class="col-md-4 col-md-offset-8">
                <div class="form-group">
                    <?=  $form->field($dresserModel, 'ipAddress')->textInput(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($dresserModel, 'ip_relay')->textInput([
                        'readonly' => true,
                    ]); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($dresserModel, 'number')->textInput([
                        'readonly' => true,
                    ]); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($dresserModel, 'type')->textInput([
                        'readonly' => true,
                    ]); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($dresserModel, 'name')->textInput([
                        'readonly' => true,
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?= Html::submitInput('ثبت', [
                'class' => 'btn btn-success btn-block',
            ]); ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
