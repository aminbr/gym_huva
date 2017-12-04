<?php

use yii\grid\GridView;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin();
$this->title = 'گزارش مالی';
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
                <h4 class="title">گزارش مالی باشگاه</h4>
            </div>
            <div class="card-content table-responsive">
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <div class="row" style="background-color: #eee">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-2">
                            <h3>جمع کل مبلغ&nbsp;<span style="color: #398439;"><?= $price ?></span> &nbsp;تومان&nbsp;</h3>
                        </div>
                        <div class="col-xs-12 col-sm-1 col-md-1">
                            <label><span style="color: transparent; ">.</span> </label>
                            <i class="btn btn-default input-lg btn-block form-control glyphicon glyphicon-save" id="btnExport"></i>
                        </div>
                        <div class="col-xs-12 col-sm-1 col-md-1">
                            <label><span style="color: transparent; ">.</span> </label>
                        <?= 
                            Html::submitButton('جستجو', [
                                'class' => 'btn btn-info input-lg btn-block form-control',
                                'tabindex' => '3',
                            ]); 
                        ?>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 ">
                        <?= $form->field($financialReportModel, 'tillDateOf')->textInput([
                            'class' => 'form-control input-lg pdate',
                            'dir' => 'rtl',
                            'placeholder' => 'تا تاریخ',
                            'tabindex' => '2',
                            'maxlength' => '10',
                            'id' => 'pcal1',
                            'readonly' => 'true',
                        ]); ?>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 ">
                        <?= $form->field($financialReportModel, 'fromDate')->textInput([
                            'class' => 'form-control input-lg pdate',
                            'dir' => 'rtl',
                            'placeholder' => 'از تاریخ',
                            'tabindex' => '1',
                            'maxlength' => '10',
                            'id' => 'pcal2',
                            'readonly' => 'true',

                        ]); ?>

                        <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
//                    'filterModel' => $memberCashModel,
                    'id' => 'table_wrapper',
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
                        ],[
                            'attribute' => 'کاربر ثبت کننده',
                            'headerOptions' => ['style' => 'color:#9c27b0'],
                            'value' => function($model) {
                                return $model->user->nickname;
                            }
                        ],[
                            'attribute' => 'تاریخ ثبت',
                            'headerOptions' => ['style' => 'color:#9c27b0'],
                            'value' => function ($model) {
                                    $data = Yii::$app->utility->convertDate([
                                        'to' => 'persian',
                                        'time' => $model->date_register,
                                    ]);
                                    return $data['year'].'/'.$data['month_num'].'/'.$data['day'];
                            }
                        ],[
                            'attribute' => 'ساعت ثبت',
                            'headerOptions' => ['style' => 'color:#9c27b0'],
                            'value' => function ($model) {
                                    $data = Yii::$app->utility->convertDate([
                                        'to' => 'persian',
                                        'time' => $model->date_register,
                                    ]);
                                    return $data['hour'].':'.$data['minute'].':'.$data['second'];
                            }
                        ],[
                            'attribute' => 'مبلغ واریز شده',
                            'headerOptions' => ['style' => 'color:#9c27b0'],
                            'value' => 'price_class',
                        ],
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>


<?php
$this->registerJs(
"
    
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
    



    var objCal1 = new AMIB.persianCalendar( 'pcal1' );

		var objCal2 = new AMIB.persianCalendar( 'pcal2'	);
		
		
		var objCal4 = new AMIB.persianCalendar( 'pcal4', {
				onchange: function( pdate ){
					if( pdate ) {
						alert( pdate.join( '/' ) );
					} else {
						alert( 'تاریخ واردشده نادرست است' );
					}
				}
			}
		);

		var objCal5 = new AMIB.persianCalendar( 'pcal5', {
				extraInputID: 'extra',
				extraInputFormat: 'YYYY/MM/DD - yyyy/mm/dd - JD'
			}
		);
                

", yii\web\View::POS_END);