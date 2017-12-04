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
        <h4 class="title"><?= $title ?></h4>
        <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
    </div>
    <div class="card-content">
        <div class="row">
            <div class="col-md-6 col-md-offset-6">
                <div class="form-group">
                    <?= 
                        $form->field($memberModel, 'tag_number')->textInput([
                            'class' => 'form-control',
                            'dir' => 'rtl',
                            'placeholder' => 'شماره تگ را وارد کنید',
                            'tabindex' => '1',
                            'maxlength' => '20',
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <?=
            Html::submitInput('ثبت', [
                'class' => $memberModel->isNewRecord ? 'btn btn-success pull-right btn-block':'btn btn-info pull-right btn-block',
                'tabindex' => '2',
            ]);
        ?>
    </div>
</div>
<?php ActiveForm::end(); ?>