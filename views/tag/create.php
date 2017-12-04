<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
?>
<div >
    <div class="col-md-7 col-md-offset-5">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">ثبت کارت در سیستم </h4>
                <p class="category">تعداد کارت های ثبت شده : <?php echo $numberTag; ?></p>
            </div>
            <div class="card-content">
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-control">
                            <?=
                            $form->field($tagModel, 'type', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->dropDownList($tagTypeArray, [
                                'prompt' => ' انتخاب کنید',
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'tabindex' => '2',
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?=
                            $form->field($tagModel, 'tag_number', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->passwordInput([
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