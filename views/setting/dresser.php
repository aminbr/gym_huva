<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\Growl;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'گزارش کمدها';
?>
<style>
    .form-group{
        padding: 0 20px;
        margin: 0;
    }
th{
    text-align: right;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">نمایش کمد های باشگاه</h4>
            </div>
            <div class="card-content table-responsive">
                <?php
                        for($i=0 ; $i<count($relayModels) ; $i++)
                        {
                            echo '<div class = "col-md-3">
                                <div style="border:1px solid #aaa; border-radius:5px; padding:10px; margin-bottom:30px;">';
                                Pjax::begin(['id' => 'grid-class-pjax','enablePushState' => false, 'timeout' => false]);
                                $form = ActiveForm::begin([
                                    'action' => Yii::$app->urlManager->createAbsoluteUrl(['setting/setting-dresser', 'pid' => $relayModels[$i]->id]),
                                    'id' => 'form'.$i,
                                    'options' => [
                                        'data-pjax' => 1,
                                    ],
                                ]);
                                echo '<div class="row"><div class="col-md-6">';
                                if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 6){
                                    echo $form->field($relayModels[$i], "name")->textInput([
                                        'class' => 'form-control',
                                        'value' => $relayModels[$i]['name'],
                                    ]);
                                }
                                echo '</div>';
                                
                                echo '<div class="col-md-6">';
                                echo $form->field($relayModels[$i], "number")->textInput([
                                        'class' => 'form-control',
                                        'value' => $relayModels[$i]['number'],
                                    ]);
                                echo '</div></div>';
                                if(isset(Yii::$app->user->identity->level) and Yii::$app->user->identity->level == 6){
                                echo $form->field($relayModels[$i], "type")->textInput([
                                    'class' => 'form-control',
                                    'value' => $relayModels[$i]['type'],
                                ]);
                                }
                                echo '<div class="row"><div class="col-md-6">';
                                    echo $form->field($relayModels[$i], "alocation")->checkbox([
                                        'class' => '',
                                    ]);
                                echo '</div>';
                                echo '<div class="col-md-6">';
                                    echo $form->field($relayModels[$i], "damage")->checkbox([
                                        'class' => '',
                                    ]);
                                echo '</div></div>';
                                echo Html::button('بازکردن رله', [
                                    'class' => 'btn-relay-toggle btn btn-default btn-block',
                                    'data-number' => $relayModels[$i]->number_relay,
                                    'data-ip' => $relayModels[$i]->ip_relay,
                                ]);
                                echo Html::submitInput('ذخیره', [
                                    'class' => 'btn btn-success btn-block',
                                ]);
                                ActiveForm::end();
                                ?>
                                <?php 
                                foreach (Yii::$app->session->getAllFlashes() as $flash) {
                                    echo Growl::widget([
                                      'type' => Growl::TYPE_SUCCESS,
                                        'body' => $flash,
                                        'pluginOptions' => [
                                            'placement' => [
                                                'from' => 'top',
                                                'align' => 'right',
                                            ]
                                        ]
                                    ]);
                                }
                                ?>
                               <?php Pjax::end();
                            echo '</div>
                                </div>';
                        }
//                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$js ="
    $('.btn-relay-toggle').click(function(){
        var number = $(this).attr('data-number');
        var url = $(this).attr('data-ip');
        $.ajax({
            url:'http://'+url+'/'+number+'n'
        });
    });
    
    ";
$this->registerJs($js, yii\web\View::POS_END);
?>
