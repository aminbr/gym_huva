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
$this->title = 'لیست تلفن ها';
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
                <h4 class="title">نمایش تلفن های افراد ثبت نام شده</h4>
            </div>
            <div class="row">
                <div class="col-md-1 col-md-offset-10">
                    <!--<label><span style="color: transparent; ">.</span> </label>-->
                    <i class="btn btn-default input-lg btn-block form-control glyphicon glyphicon-save" id="btnExportTelephone"></i>
                </div>
            </div>
            <div class="card-content table-responsive">
                    <?php
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $memberSearchModel,
                        'id' => 'table_wrapper_tel',
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
                                'attribute' => 'mobile',
                                'value' => 'mobile'
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
    $('#btnExportTelephone').click(function(e) {
    console.log('hh');
        e.preventDefault();
        //getting data from our table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('table_wrapper_tel');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');

        var a = document.createElement('a');
        a.href = data_type + ', ' + table_html;
        a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
        a.click();
    });
    
", yii\web\View::POS_END);