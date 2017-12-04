<?php
use yii\helpers\Html;
$this->title = 'تنظیمات اولیه';
?>
<div class="col-md-7 col-md-offset-5">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">تنظیمات در سیستم</h4>
                <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
            </div>
            <div class="card-content">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::errorSummary($configModel); ?>
                            <?= Html::beginForm(); ?>
                            <?php foreach($setting['gym'] as $key => $value){ ?>
                            <div class="form-group">
                                <label><?= Yii::t('app', $key); ?></label>
                                <?php if($key != 'capacity'): ?>
                                <?= Html::textInput('Config['.$key.']', $setting['gym'][$key], [
                                    'class' => 'form-control',
                                    'type' => 'text',
                                ])  ?>
                                <?php endif; ?>
                            </div>
                            <?php } ?>
                            <?= Html::textInput('Config['.$key.']', $setting['gym'][$key], [
                                'class' => 'form-control',
                                'maxlength' => '4',
                                'type' => 'number',
                            ])  ?>
                            <span class="material-input"></span></div>
                    </div>
                </div>
                <?= Html::submitInput('ثبت تنظیمات', [
                    'class' => 'btn btn-success btn-block btn-lg',
                    'tabindex' => '5',
                ])
                ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

