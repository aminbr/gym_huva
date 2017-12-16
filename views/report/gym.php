<?php
use yii\grid\GridView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'گزارش افراد درون باشگاه';
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
                <h4 class="title">نمایش عضو های درون باشگاه</h4>
            </div>
            <div class="card-content table-responsive">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'columns' => [
                                    [
                                        'attribute' => 'نام',
                                        'headerOptions' => ['style' => 'color:#9c27b0'],
                                        'value' => function($model) {
                                            return $model->member->name;
                                        }
                                    ],[
                                        'attribute' => 'نام خانوادگی',
                                        'headerOptions' => ['style' => 'color:#9c27b0'],
                                        'value' => function($model) {
                                            return $model->member->family;
                                        }
                                    ],
                                    [
                                        'attribute' => 'تاریخ ورود',
                                        'headerOptions' => ['style' => 'color:#9c27b0'],
                                        'value' => function ($model) {
                                                $data = Yii::$app->utility->convertDate([
                                                    'to' => 'persian',
                                                    'time' => $model->enter_date,
                                                ]);
                                                return $data['year'].'/'.$data['month_num'].'/'.$data['day'];
                                        }
                                    ],
                                    
                                    
                                    [
                                        'attribute' => 'ساعت ثبت',
                                        'headerOptions' => ['style' => 'color:#9c27b0'],
                                        'value' => function ($model) {
                                                $data = Yii::$app->utility->convertDate([
                                                    'to' => 'persian',
                                                    'time' => $model->enter_date,
                                                ]);
                                                return $data['hour'].':'.$data['minute'].':'.$data['second'];
                                        }
                                    ],
                                    [
                                        'header' => 'نام کلاس',
                                        'headerOptions' => ['style' => 'color:#9c27b0'],
                                        'value' => function ($model) {
                                            $nameClassMember = Yii::$app->runAction('report/name-class', [
                                                'memberid' => $model->member_id,
                                            ]);
                                            return $nameClassMember;
                                        }
                                    ],
                                    [
                                        'header' => 'تعداد دفعات قابل استفاده',
                                        'headerOptions' => ['style' => 'color:#9c27b0'],
                                        'value' => function ($model) {
                                            $calculationCreditUse = Yii::$app->runAction('report/calculation-credituse', [
                                                'memberid' => $model->member_id,
                                            ]);
                                            return $calculationCreditUse;
                                        }
                                    ],
                                    [
                                        'header' => 'تاریخ پایان اعتبار',
                                        'headerOptions' => ['style' => 'color:#9c27b0'],
                                        'value' => function ($model) {
                                            $calculationCreditDate = Yii::$app->runAction('report/calculation-creditdate', [
                                                'memberid' => $model->member_id,
                                            ]);
                                            return $calculationCreditDate['year'].'/'.$calculationCreditDate['month_num'].'/'.$calculationCreditDate['day'];
                                        }
                                    ],
                                    [
                                        'header' => 'شماره کمد',
                                        'headerOptions' => ['style' => 'color:#9c27b0'],
                                        'value' => function ($model) {
                                            $numberDresser = Yii::$app->runAction('report/number-dresser', [
                                                'numDresser' => $model->number_dresser,
                                            ]);
                                            return $numberDresser;
                                        }
                                    ],
                                    [
                                        'header' => 'خروج دستی',
                                        'headerOptions' => ['style' => 'color:#9c27b0'],
                                        'class' => yii\grid\ActionColumn::className(),
                                        'template' => " {exit}",
                                        'buttons' => [ 
                                            'exit' => function($key, $model, $index)
                                            {
                                                return Html::a('<span class="glyphicon glyphicon-new-window text-danger" ></span> ', 
                                                Url::to(['/report/report-delete', 'id' => $model->member_id]), [
                                                    'onclick' => 'exitMember(this); return false;'
                                                ]);
                                            }, 
                                        ],
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
    function exitMember(obj){
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
