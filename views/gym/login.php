<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <div class="card card-login card-hidden">
                <div class="card-header text-center" data-background-color="rose">
                    <h4 class="card-title">ورود</h4>
                    <div class="social-line">
                        <a href="http://www.facebook.com/huva" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                        <a href="#pablo" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="http://tlgrm.me/amin_b_r" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-telegram"></i>
                        </a>
                    </div>
                </div>
                <p class="category text-center">
                    لطفا فیلدهای زیر را پرکنید
                </p>
                <div class="card-content">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        ]);
                    ?>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <?= $form->field($model, 'username', [
                            'options' => [
                               'class' => 'form-group label-floating' 
                            ]
                            
                        ])->textInput(['autofocus' => true]) ?>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock_outline</i>
                        </span>
                        <?= $form->field($model, 'password', [
                            'options' => [
                               'class' => 'form-group label-floating' 
                            ]
                        ])->passwordInput() ?>
                    </div>
                    <div class="input-group">
                    <?= $form->field($model, 'rememberMe')->checkbox()?>
                    </div>
                
                    <div class="footer text-center">
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11">
                                <?= Html::submitInput('ورود', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
    </div>
</div>
