<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;
$this->title = 'لیست عضوها';
?>
<style>
th{
    text-align: right;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">نمایش عضو های ثبت نام شده</h4>
                <p class="category">برای انجام عملیات (ویرایش ، حذف  و نمایش جزییات) به ستون ویرایش رجوع کنید</p>
            </div>
            <div class="card-content table-responsive">
                <?= Html::a('<button class= "btn btn-success"><i class="fa fa-plus">اضافه کردن عضو</i></button>',
                        ['member/member-create'],[
                    'onclick' => 'showModal(this);return false;'
                ]) ?>
                    <?php
                    Pjax::begin([
                                    'id' => 'grid-member-pjax',
                                    'enablePushState' => false,
                                    'timeout' => false
                                ]);
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $memberSearchModel,
                        'columns' => [
                            [
                                'attribute' => 'name',
                                'value' => 'name',
                            ],
                            [
                                'attribute' => 'family',
                                'value' => 'family',
                            ],
                            [
                                'attribute' => 'nt_code',
                                'value' => 'nt_code',
                            ],
                            [
                                'attribute' => 'gender',
                                'filter' => ['1' => 'مرد', '2' => 'زن'],
                                'value' => function($model, $key, $index) {
                                    if ($model->gender == 1) {
                                        return 'مرد';
                                    } else if ($model->gender == 2) {
                                        return 'زن';
                                    }
                                }
                            ],
                            [
                                'attribute' => 'mobile',
                                'value' => 'mobile'
                            ],
                            [
                                'header' => 'ویرایش',
                                'headerOptions' => ['style' => 'color:#9c27b0'],
                                'class' => yii\grid\ActionColumn::className(),
                                'template' => "{update} {delete} {editcard} {entermember} {view}",
                                'buttons' => [
                                    'update' => function($key, $model, $index) {
                                        return Html::a('<button class="btn btn-success" style="padding:8px 10px;">
                                                <span class="glyphicon glyphicon-pencil" ></span><div class="ripple-container"></div></button>', 
                                                Url::to(['/member/member-update', 'id' => $model->id]),[
                                                'onclick' => 'showModal(this);return false;',
                                                    'title' => 'ویرایش'
                                        ]);
                                    },
                                    'delete' => function($key, $model, $index) {
                                        return Html::a('<button class="btn btn-danger" style="padding:8px 10px;">
                                                <span class="glyphicon glyphicon-trash" ></span><div class="ripple-container"></div></button>', 
                                                Url::to(['/member/member-delete', 'id' => $model->id]), [
                                                    'onclick' => 'deleteUser(this); return false;',
                                                    'title' => 'حذف'
                                        ]);
                                    },
                                    'view' => function($key, $model, $index)
                                    {
                                        return Html::a('<button class="btn btn-info" style="padding:8px 10px;">
                                                <span class="glyphicon glyphicon-eye-open" ></span><div class="ripple-container"></div></button>',
                                            Url::to(['member-detail', 'id' => $model->id]),[
                                                'onclick' => 'showModal(this);return false;',
                                                    'title' => 'نمایش جزئیات'
                                        ]);
                                    },
                                    'editcard' => function($key, $model, $index)
                                    {
                                        return Html::a('<button class="btn btn-warning" style="padding:8px 10px;">
                                                <span class="glyphicon glyphicon-credit-card" ></span><div class="ripple-container"></div></button>',
                                            Url::to(['member-editcard', 'id' => $model->id]),[
                                                'onclick' => 'showModal(this);return false;',
                                                    'title' => 'ویرایش کارت'
                                        ]);
                                    },
                                    'entermember' => function($key, $model, $index)
                                    {
                                        return Html::a('<button class="btn btn-primary" style="padding:8px 10px;">
                                                <span class="glyphicon glyphicon-log-in" ></span><div class="ripple-container"></div></button>',
                                            Url::to(['gym/enter-no-card', 'id' => $model->id]),[
                                                    'title' => 'ورود به باشگاه بدون کارت'
                                        ]);
                                    },
                                ]
                            ],
                        ]
                    ]);
                    ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs(" 
    function deleteUser(obj){
        var url = $(obj).attr('href');
        var res = confirm('آیا از حذف کاربر مطمئن هستید؟');
        if(res)
        {
            window.location=url;
        }
        return false;
    }
", yii\web\View::POS_END);
?>

<?php
 Modal::begin([
     'id' => 'member-list-modal',
     'size' => Modal::SIZE_LARGE,
 ]);
 \yii\widgets\Pjax::begin([
     'id' => 'list-pjax',
     'enablePushState' => false,
     'timeout' => false,
     ]);
$this->registerJs("
    function showModal(obj)
    {
        var url = $(obj).attr('href');
        $.ajax({
            url:url
        })
        .done(function(data){
            $('#list-pjax').html(data);
            $('#member-list-modal').modal('show');
        });
        
        return false;
    }
    
//    function callbackPjaxMember(data)
//    {
//        if(data.result == true){
////            $('#member-list-modal').modal('hide');
////            $('#class-room-modal').modal('hide');
////            $.pjax.reload({
////                container:'#grid-member-pjax',
////                timeout: false,
////                push:false,
////            });
//            downloadCamServer();
//            swal({
//                title: 'ثبت کلاس موفقیت آمیز بود',
////                text: data.message,
//                type: 'success',
//                showCancelButton: false,
//                showConfirmButton: false,
//                closeOnConfirm: false,
//                timer:2500,
//            });
//        }else if(!data.result == true){
//            swal({
//                title: 'تغییرات ناموفق بود',
//                text: data.message,
//                type: 'error',
//            });
//        }
//        return false;
//    }
//    
//
//    // Grab elements, create settings, etc.
//    //var video = document.getElementById('video');
//    var video = $('#video');
//
//    // Get access to the camera!
//    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
//            // Not adding `{ audio: true }` since we only want video now
//            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
//                    video.get(0).src = window.URL.createObjectURL(stream);
//                    video.get(0).play();
//            });
//    }
//
//    // Elements for taking the snapshot
//    var canvas = document.getElementById('canvas');
//    var context = canvas.getContext('2d');
//    //var video = document.getElementById('video');
//
//    // Trigger photo take
//    $('#take').click(function(){
//            context.drawImage(video.get(0), 0, 0, 240, 180);
//
//            //console.log(context.getImageData(50, 50, 640, 480));
//    });
//
//    function downloadCamServer(){
//        var dataURL = canvas.toDataURL('image/jpeg');
//        document.getElementById('hidden_data').value = dataURL;
//        var fd = new FormData(document.forms['form1']);
//
//        $.ajax({
//           url: '".Yii::$app->urlManager->createAbsoluteUrl('member/save-image')."',
//           type: 'POST',
//           data: {
//                   hidden_data: $('#hidden_data').val()
//           },
//           complete: function (status, data, jqXHR) {
//
//           },
//           error: function () {
//
//           },
//       });
//    }
    ", yii\web\View::POS_END);
\yii\widgets\Pjax::end();
Modal::end();