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
            <div class="card-content table-responsive">
                    <?php
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
