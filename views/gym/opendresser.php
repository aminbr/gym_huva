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
<div class="">
    <div class="card">
        <div class="card-header" data-background-color="orange">
            <h4 class="title">باز کردن کمد به صورت دستی</h4>
            <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
        </div>
        <div class="card-content">
            <div class="row">
                <div class="col-md-6 col-md-offset-6">
                    <div class="form-group">
                        <?= $form->field($openDresserModel, 'numberDresser', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'autofocus' => TRUE,
                            ]); ?>
                    </div>
                </div>
            </div>
            <?= Html::submitInput('باز کردن', [
                'class' => 'btn btn-block btn-info',
            ]); ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php
//    $this->registerJs("
//                $('#mytext').attr('autofocus', true);
//    ", yii\web\View::POS_END);
    ?>

        