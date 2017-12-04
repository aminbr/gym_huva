<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in  editor.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mrlco\datepicker\Datepicker;

$form = ActiveForm::begin([
    'options' => array(
        'data-pjax' => 1,
    )
]);
?>
<style>
    #video, #canvas, #buttons {
            margin: 5px auto;
            display: block;
            clear: both;
    }
    #canvas{
        position: absolute;
        left: 90px;
        top: 0px;
    }
    #buttons {
            text-align: center;
    }
</style>
        <div class="card">
            <div class="card-header" data-background-color="green">
                <h4 class="title"><?= $title ?></h4>
                <p class="category">لطقا در پر کردن فیلدها دقت کنید</p>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($memberModel, 'nt_code', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => ' شماره ملی را وارد کنید',
                                'tabindex' => '3',
                                'maxlength' => '10',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <?=
                            $form->field($memberModel, 'family', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'نام خانوادگی را وارد کنید',
                                'tabindex' => '2',
                                'maxlength' => '20',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($memberModel, 'name', [
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                            echo $form->field($memberModel, 'date_birth', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'تاریخ تولد را وارد کنید',
                                'tabindex' => '6',
                                'maxlength' => '10',
                                'placeholder' => '1396/01/01',
                                'id' => 'pcal3',
                                'readonly' => 'true',
                            ]);
                            ?>
                            <span class="material-input"></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <?=
                            $form->field($memberModel, 'job', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->dropDownList($jobArray, [
                                'prompt' => ' انتخاب کنید',
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'tabindex' => '5',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($memberModel, 'gender', [
                            'options' =>
                                [
                                    'class' => 'form-group field-tagreader-taginput is-empty is-focused',

                                ],
                            ])->radioList([
                                    '1' => 'مرد',
                                    '2' => 'زن',
                                ],
                                [
                                    'itemOptions' => 
                                    [
                                        'tabindex' => '4',
                                    ]
                                ]); 
                            ?>


                            <span class="material-input"></span></div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($memberModel, 'email', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'ایمیل را وارد کنید',
                                'tabindex' => '9',
                                'maxlength' => '30',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <?=
                            $form->field($memberModel, 'telephone', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'تلفن منزل را وارد کنید',
                                'tabindex' => '8',
                                'maxlength' => '12',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?=
                            $form->field($memberModel, 'mobile', [
                                'options' =>
                                    [
                                        'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                    ],
                            ])->textInput([
                                'class' => 'form-control',
                                'dir' => 'rtl',
                                'placeholder' => 'شماره موبایل را وارد کنید',
                                'tabindex' => '7',
                                'maxlength' => '10',
                            ]);
                            ?>

                            <span class="material-input"></span></div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <video id="video" width="240" height="180" autoplay></video>
                        <canvas id="canvas" width="240" height="180"></canvas>
                        <form method="post" accept-charset="utf-8" name="form1">
                            <!--<input name="hidden_data" id="hidden_data" type="hidden"/>-->
                            <?= $form->field($memberModel, "hidden_data")->hiddenInput([
                                'class' => 'hidden_data',
                            ])->label(''); ?>
                        </form>
                        <div id="buttons">
                            <!--<button id="">take it</button>-->
                            <?php 
                                if(!$memberModel->isNewRecord){
                                    echo $form->field($memberModel, "edit_img")->checkbox([

                                    ]);
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?=
                                $form->field($memberModel, 'address', [
                                    'options' =>
                                        [
                                            'class' => 'form-group field-tagreader-taginput is-empty is-focused',
                                        ],
                                ])->textInput([
                                    'class' => 'form-control',
                                    'dir' => 'rtl',
                                    'placeholder' => 'آدرس منزل را وارد کنید',
                                    'tabindex' => '10',
                                    'maxlength' => '50',
                                ]);
                                ?>

                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?=
                                $form->field($memberModel, 'tag_number', [
                                    'options' =>
                                        [
                                            'class' => 'form-group field-tagreader-taginput is-empty is-focused',                                       
                                        ],
                                ])->passwordInput([
                                    'class' => 'form-control',
                                    'dir' => 'rtl',
                                    'placeholder' => 'شماره کارت را وارد کنید',
                                    'tabindex' => '11',
                                    'maxlength' => '20',
                                    'readonly'=> (!$memberModel->isNewRecord ? "readonly":false)
                                ]);
                                ?>
                                <span class="material-input"></span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <?=
                Html::submitInput($valueBtn, [
                    'class' => $memberModel->isNewRecord ? 'btn btn-success pull-right btn-block':'btn btn-info pull-right btn-block',
                    'tabindex' => '12',
                    'id' => 'take'
                ]);
                ?>
                <div class="clearfix"></div>
            </div>
        </div>

<?php ActiveForm::end(); ?>
<?php 
$js = "
    

// export excel
    $('#btnExport').click(function(e) {
        e.preventDefault();
        //getting data from our table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('table_wrapper');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');

        var a = document.createElement('a');
        a.href = data_type + ', ' + table_html;
        a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
        a.click();
    });
    



                
                var objCal3 = new AMIB.persianCalendar( 'pcal3'	);
		
                
////



    function callbackPjaxMember(data)
    {
        if(data.result == true){
            $('#member-list-modal').modal('hide');
            $('#class-room-modal').modal('hide');
            
            downloadCamServer(data.member_id);
            $.pjax.reload({
                container:'#grid-member-pjax',
                timeout: false,
                push:false,
            });
            swal({
                title: 'ثبت کلاس موفقیت آمیز بود',
//                text: data.message,
                type: 'success',
                showCancelButton: false,
                showConfirmButton: false,
                closeOnConfirm: false,
                timer:2500,
            });
//            setTimeout(function(){
//                window.location = 'index.php?r=member/member-list';
//            }, 2000);
            
        }else if(!data.result == true){
            swal({
                title: 'تغییرات ناموفق بود',
                text: data.message,
                type: 'error',
            });
        }
        return false;
    }
    

    // Grab elements, create settings, etc.
    //var video = document.getElementById('video');
    var video = $('#video');

    // Get access to the camera!
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // Not adding `{ audio: true }` since we only want video now
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                    video.get(0).src = window.URL.createObjectURL(stream);
                    video.get(0).play();
            });
    }

    // Elements for taking the snapshot
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    //var video = document.getElementById('video');

    // Trigger photo take
    $('#take').click(function(){
        context.drawImage(video.get(0), 0, 0, 240, 180);
        var dataURL = canvas.toDataURL('image/jpeg');
        document.getElementById('member-hidden_data').value = dataURL;
        //console.log(context.getImageData(50, 50, 640, 480));
    });

    function downloadCamServer(member_id,value_edit_img){
        var valueHiddenData = $('#member-hidden_data').val();
//        alert(valueHiddenData);
        if(valueHiddenData != '')
        {
            var fd = new FormData(document.forms['form1']);

            $.ajax({
               url: '".Yii::$app->urlManager->createAbsoluteUrl('member/save-image')."&mid='+member_id,
               type: 'POST',
               data: {
                       hidden_data: $('#member-hidden_data').val()
               },
               complete: function (status, data, jqXHR) {

               },
               error: function () {

               },
           });
        }
    }
    ";
$this->registerJs($js, \yii\web\View::POS_END);
