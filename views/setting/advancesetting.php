<?php
use yii\helpers\Html;
$this->title = 'تنظیمات اولیه';
?>
<div class="col-md-7 col-md-offset-5">
    <div class="card">
        <div class="card-header" data-background-color="blue">
            <h4 class="title">تنظیمات پیشرفته در سیستم</h4>
            <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
        </div>
        <div class="card-content">
            <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::errorSummary($configModel); ?>
                            <?= Html::beginForm(); ?>
                            <?php foreach($setting['advance'] as $key => $value){ ?>
                                <div class="form-group">
                                    <?php
                                        if($key == 'name')
                                            $key_val = 'نام باشگاه';
                                        else if($key == 'logo')
                                            $key_val = 'آدرس لوگو';
                                        else if($key == 'url_member_img')
                                            $key_val = ' پوشه ذخیره عکس ها';
                                        else if($key == 'ip_display')
                                            $key_val = ' آی پی نمایشگر';
                                        else if($key == 'delay_exit')
                                            $key_val = ' تاخیر در خروج(دقیقه)';
                                    ?>
                                    <label><?= Yii::t('app', $key_val); ?></label>
                                    <?= Html::textInput('Config['.$key.']', $setting['advance'][$key], [
                                        'class' => 'form-control',
                                        'dir' => 'rtl',
                                    ])  ?>
                                </div>
                            <?php } ?>
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
</div>

