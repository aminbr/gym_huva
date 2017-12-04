<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\widgets\Pjax;
use omnilight\assets\SweetAlertAsset;

$this->title = "لیست کاربران";
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
                <h4 class="title">نمایش کاربران</h4>
                <p class="category">برای انجام عملیات (ویرایش ، حذف  و نمایش جزییات) به ستون ویرایش رجوع کنید</p>
            </div>
            <div class="card-content table-responsive">
                <?= Html::a('<i class="fa fa-user-plus fa-fw"></i> کاربر جدید', 
                    Url::to(['user-create']), [
                    'class' => 'btn btn btn-success',
                    'onclick' => 'showModal(this); return false;'
                ]); ?>
                    <?php
                    Pjax::begin(['id' => 'grid-user-pjax','enablePushState' => false, 'timeout' => false]);
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $userSearchModel,
                        'columns' => [
                            [
                                'attribute' => 'nickname',
                                'value' => 'nickname',
                            ],
                            [
                                'attribute' => 'username',
                                'value' => 'username',
                            ],
                            [
                                'attribute' => 'level',
                                'filter' => ['1' => 'کاربر', '2' => 'حسابدار', '3' => 'مدیر'],
                                'value' => function($model, $key, $index) {
                                    if ($model->level == 1) {
                                        return 'کاربر';
                                    } else if ($model->level == 2) {
                                        return 'حسابدار';
                                    } else if ($model->level == 3) {
                                        return 'مدیر';
                                    }
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'filter' => ['0' => 'غیر فعال', '1' => 'فعال'],
                                'value' => function($model, $key, $index) {
                                    if ($model->status == 1) {
                                        return 'فعال';
                                    } else if ($model->status == 0) {
                                        return 'غیر فعال';
                                    }
                                }
                            ],
                            [
                                'header' => 'ویرایش',
                                'headerOptions' => ['style' => 'color:#9c27b0'],
                                'options' => [
                                    'width' => '150px'
                                ],
                                'class' => yii\grid\ActionColumn::className(),
                                'template' => "{update} {delete} ",
                                'buttons' => [
                                    'update' => function($key, $model, $index) {
                                        return Html::a('<button class="btn btn-success" rel="tooltip" type="button" data-original-title="" title="" style="padding:8px 10px;">
                                                <span class="glyphicon glyphicon-pencil" ></span><div class="ripple-container"></div></button>', 
                                                Url::to(['/user/user-update', 'id' => $model->id]), [
                                                    'onclick' => 'showModal(this); return false;'
                                                ]);
                                    },
                                    'delete' => function($key, $model, $index) {
                                        return Html::a('<button class="btn btn-danger" rel="tooltip" type="button" data-original-title="" title="" style="padding:8px 10px;">
                                                <span class="glyphicon glyphicon-trash" ></span><div class="ripple-container"></div></button>', 
                                                Url::to(['/user/user-delete', 'id' => $model->id]), [
                                                    'onclick' => 'deleteUser(this); return false;'
                                        ]);
                                    },
//                                    'view' => function($key, $model, $index)
//                                    {
//                                        return Html::a('<button class="btn btn-info" rel="tooltip" type="button" data-original-title="" title="" style="padding:8px 10px;">
//                                                <span class="glyphicon glyphicon-eye-open" ></span><div class="ripple-container"></div></button>',
//                                            Url::to(['user-detail', 'id' => $model->id]),[
//                                                'onclick' => 'showModal(this);return false;'
//                                        ]);
//                                    },
                                ]
                            ],
                        ]
                    ]);
                    Pjax::end();
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
    'id' => 'user-list-modal',
    'size' => Modal::SIZE_LARGE
]);
Pjax::begin(['id' => 'list-pjax', 'enablePushState' => false, 'timeout' => false]);
$this->registerJs("
    function showModal(obj)
    {
        var url = $(obj).attr('href');
        $.ajax({
            url:url
        })
        .done(function(data){
            $('#list-pjax').html(data);
            $('#user-list-modal').modal('show');
        });
        
        return false;
    }
    
    function callbackPjaxUser(data)
    {
        
        if(data.result == true){
            $('#user-list-modal').modal('hide');
            $('#class-room-modal').modal('hide');
            $.pjax.reload({
                container:'#grid-user-pjax',
                timeout: false,
                push:false,
            });
            swal({
                title: 'ثبت کاربر موفقیت آمیز بود',
//                text: data.message,
                type: 'success',
                showCancelButton: false,
                showConfirmButton: false,
                closeOnConfirm: false,
                timer:2500,
            });
        }else if(!data.result == true){
        
            $('#class-room-modal').modal('hide');
            swal({
                title: 'تغییرات ناموفق بود',
                text: data.message,
                type: 'error',
            });
        }
        return false;
    }
    ", yii\web\View::POS_END);
Pjax::end();
Modal::end();