<?php
/* @var $this yii\web\View */
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\Highstock;
use yii\web\JsExpression;
use kartik\widgets\Growl;
$this->title = 'ssssssssssssss';

?>
<style>
    #track-details{
        white-space: normal;
        font-size: 12px;
        padding: 0 10px 0 10px;
    }
    .track{
        padding: 12px;
        color: #6cad98;
    }
    .track div:first-child{
        width: 60px;
        height: 60px;
    }
    .track p.title{
        font-size: 12px;
        margin: 1px 0 1px 0;
        padding-right: 25px;
    }
    .track p.artist{
        font-weight: 100;
        font-size: 12px;
    }
    #expand-bar{
        height: 308%;
    }
    .player-control{
        font-size: 12px;
    }
    .track .remove-track{
        top: 5px;
    }
</style>
    <script src="https://code.highcharts.com/highcharts.js"></script>
<div class="row">
    <div class="col-lg-6 col-md-6">
        
        <div id="container"></div>
    <script>
//        var chartData;
//        var chart;
//        var countEnterMember;
//        var countEnterMemberOld;
//        var countEnterMemberNew = 0;
//        function loadDataChart(){
//            $.ajax({
//                url: '<?php // echo Yii::$app->urlManager->CreateAbsoluteUrl(['gym/gym-capacity']); ?>',
//                method: 'GET',
//                dataType: 'JSON',
//                success: function (returnData) {
//                    $("#container").empty();
//                    console.log(returnData);
//                    chartData = returnData;
//                    countEnterMemberNew = returnData.countMemberEnter;
//                    chart = Highcharts.chart('container', {
//
//                        chart: {
//                            type: 'column'
//                        },
//
//                        title: {
//                            text: 'Highcharts responsive chart'
//                        },
//
//                        subtitle: {
//                            text: 'Resize the frame or click buttons to change appearance'
//                        },
//
//                        legend: {
//                            align: 'right',
//                            verticalAlign: 'middle',
//                            layout: 'vertical'
//                        },
//
//                        xAxis: {
//                            categories: ['تعداد عضو های درون باشگاه', 'Oranges', 'Bananas'],
//                            labels: {
//                                x: -10
//                            }
//                        },
//
//                        yAxis: {
//                            allowDecimals: false,
//                            title: {
//                                text: 'Amount'
//                            }
//                        },
//
//                        series: [{
//                            name: 'عضوها',
//                            data: [returnData.countMemberEnter, ]
//                        }, ],
//
//                        responsive: {
//                            rules: [{
//                                condition: {
//                                    maxWidth: 500
//                                },
//                                chartOptions: {
//                                    legend: {
//                                        align: 'center',
//                                        verticalAlign: 'bottom',
//                                        layout: 'horizontal'
//                                    },
//                                    yAxis: {
//                                        labels: {
//                                            align: 'left',
//                                            x: 0,
//                                            y: -5
//                                        },
//                                        title: {
//                                            text: null
//                                        }
//                                    },
//                                    subtitle: {
//                                        text: null
//                                    },
//                                    credits: {
//                                        enabled: false
//                                    }
//                                }
//                            }]
//                        }
//                    });
//                }
//            })
//        }
//        setInterval(loadDataChart,5000); 
//        console.log(chartData);
        

//        $('#small').click(function () {
//            chart.setSize(400, 300);
//        });
//
//        $('#large').click(function () {
//            chart.setSize(600, 300);
//        });

    </script>
    </div>
    <div class="col-lg-6 col-md-6">
        <?php // echo aki\player\MusicPlayer::widget([
//            'options' => [
//                'width' => '93.5%',
//                'height' => '400px',
//            ]
//        ]); ?>
    </div>
</div>
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
<?php


$this->registerJs("
        function loadGym(){
            $.ajax({
                url: '".Yii::$app->urlManager->CreateAbsoluteUrl(['gym/gym-capacity'])."',
                method: 'GET',
                dataType: 'JSON',
                success: function (returnData) {
                    console.log(returnData.capaciy);
                }
            })
        }
        setInterval(loadGym,2000); 
        
    ", \yii\web\View::POS_END);
