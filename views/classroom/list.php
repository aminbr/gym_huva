<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title = "لیست کلاسها";
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
                <h4 class="title">نمایش کلاسها</h4>
                <p class="category">برای انجام عملیات (ویرایش ، حذف  و نمایش جزییات) به ستون ویرایش رجوع کنید</p>
            </div>
            <div class="card-content table-responsive">
                <?= Html::a('<i class="fa fa-user-plus fa-fw"></i> کلاس جدید', 
                    Url::to(['class-create']), [
                    'class' => 'btn btn btn-success',
                    'onclick' => 'showModal(this); return false;'
                ]); ?>
                    <?php
                    Pjax::begin(['id' => 'grid-class-pjax','enablePushState' => false, 'timeout' => false]);
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $classSearchModel,
                        'columns' => [
                            [
                                'attribute' => 'name',
                                'value' => 'name',
                            ],
                            [
                                'attribute' => 'class_type',
                                'filter' => ['1' => 'عادی', '2' => 'مهمان', '3' => 'قهرمان'],
                                'value' => function($model, $key, $index) {
                                    if ($model->class_type == 1) {
                                        return 'عادی';
                                    } else if ($model->class_type == 2) {
                                        return 'مهمان';
                                    } else if ($model->class_type == 3) {
                                        return 'قهرمان';
                                    }
                                }
                            ],
                            [
                                'attribute' => 'price',
                                'value' => 'price',
                            ],
                            [
                                'attribute' => 'number_day',
                                'value' => 'number_day',
                            ],
                            [
                                'attribute' => 'time_limit',
                                'value' => 'time_limit',
                            ],
                            [
                                'header' => 'ویرایش',
                                'headerOptions' => ['style' => 'color:#9c27b0'],
                                'options' => [
                                    'width' => '150px',
                                ],
                                'class' => yii\grid\ActionColumn::className(),
                                'template' => "{update} {delete} ",
                                'buttons' => [
                                    'update' => function($key, $model, $index) {
                                        return Html::a('<button class="btn btn-success" style="padding:8px 10px;">
                                                <span class="glyphicon glyphicon-pencil" ></span><div class="ripple-container"></div></button>', 
                                                Url::to(['/classroom/class-edit', 'id' => $model->id]), [
                                                    'onclick' => 'showModal(this); return false;',
                                                    'title' => 'ویرایش'
                                                ]);
                                    },
                                    'delete' => function($key, $model, $index) {
                                        return Html::a('<button class="btn btn-danger" style="padding:8px 10px;">
                                                <span class="glyphicon glyphicon-trash" ></span><div class="ripple-container"></div></button>', 
                                                Url::to(['/classroom/class-delete', 'id' => $model->id]), [
                                                    'onclick' => 'deleteClass(this); return false;',
                                                    'title' => 'حذف'
                                        ]);
                                    },
//                                    'view' => function($key, $model, $index)
//                                    {
//                                        return Html::a('<button class="btn btn-info" rel="tooltip" type="button" data-original-title="" title="" style="padding:8px 10px;">
//                                                <span class="glyphicon glyphicon-eye-open" ></span><div class="ripple-container"></div></button>',
//                                            Url::to(['/classroom/class-detail', 'id' => $model->id]),[
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
    function deleteClass(obj){
        var url = $(obj).attr('href');
        var res = confirm('آیا از حذف کلاس مطمئن هستید؟');
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
     'id' => 'class-list-modal',
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
            $('#class-list-modal').modal('show');
        });
        
        return false;
    }

    function callbackPjaxNewClass(data)
    {
        if(data.result == true){
            $('#class-list-modal').modal('hide');
            $('#class-room-modal').modal('hide');
            $.pjax.reload({
                container:'#grid-class-pjax',
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
        }else if(!data.result == true){
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