<?php
use omnilight\assets\SweetAlertAsset;

SweetAlertAsset::register($this);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = "ورود و خروج";
?>
<style>
    @import url(fonts/yekan.css);
    body{
        font-family: 'yekan';
        
        background-image:url(img/background-page-member.jpg);
        background-position: center;
        background-size: cover;
        background-attachment: fixed;
    }
    .box-detail-member{
        padding: 30px;
        margin-top: 10%;
        border-radius: 10px;
        background-color: rgba(1, 45, 56, 0.48);
        box-shadow: 0px 0px 103px rgba(1, 45, 56, 1);

    }
    .box-img-member img{
        border-radius: 50%;
        width: 250px;
        height: 250px;
    }
    .box-oclock img{
        width: 90%;
        border-radius: 10px;
    }
    .box-number-dresser span{
        width: 250px;
        height: 250px;
        background-color: rgba(219, 242, 255, 0.8);;
        margin-top: 20px;
        font-size: 100px;
        text-align: center;
        line-height: 250px;
        border-radius: 50%;
    }
    .wrapper{
    }
    .box-detail-member h3{
        color: #ecf0f1;
    }
    .box-label{
        padding: 20px 0;
    }
    span{
        display: inline-block;
    }


#main {
  width: 100%;
  height: auto;
}

#time {
    color: #fff;
  width: 40%;
  margin: 0 auto;
  text-align: center;
  font-size: 6em;
  text-shadow: 0px 2px 25px rgba(255, 255, 255, 0.3);
}

#ampm {
    font-size: 0.2em;
    margin-left: 30px;
    position: absolute;
    left: 15%;
    top: 50%;
}


#days, #fullDate {
  width: 75%;
  font-size: 20px;
  margin: 0 auto;
  display: flex;
  text-align: center;
  align-items: center;
  justify-content: center;
}

.days {
  flex: 1;
  color: rgba(1, 45, 56, 0.3);
  text-align: center;
}

.active {
  color: #eee;
  text-shadow: 0px 2px 25px rgba(255, 255, 255, .6);
}
#fullDate {
  margin-top:.25em;
  text-shadow: 0px 2px 25px rgba(255, 255, 255, .6);
}
#sec{
display:inline-block;
  width:70px;
}




#numberDresser{
    transition:1s;
}
</style>
<div class="wrapper">
    <div class="container">
        <div class="box-detail-member text-right">
            <div class="row row-img">
                <div class="col-md-3 text-center box-img-member">
                    <img id="member-img" src="img/images.jpg" />
                </div>
                <div class="col-md-9 box-oclock text-center">
                            <div id="main">
                                <div id="time">
                                    <span id="hours"></span><span id="min"></span><span id="sec"></span><span id="ampm"></span>
                                </div>
                                    <div id='days'>
                                        <div class="days">شنبه
                                        </div>
                                        <div class="days">یک شنبه
                                        </div>
                                        <div class="days">دوشنبه
                                        </div>
                                        <div class="days">سه شنبه
                                        </div>
                                        <div class="days">چهار شنبه
                                        </div>
                                        <div class="days">پنج شنبه
                                        </div>
                                        <div class="days">جمعه
                                        </div>
                                    </div>
<!--                                <div id="fullDate">
                                    <span id="month"></span>&nbsp;<span id="date"></span>&nbsp;<span id="year"></span>
                                </div>-->
                            </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="box-number-dresser">
                        <span id="numberDresser">کمد </span>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-2">
                            <div class="box-label">
                                <h3><span id="timeEnter"></span>ساعت ورود </h3>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2">
                            <div class="box-label">
                                <h3><span id="name"></span>&nbsp;&nbsp;<span id="family"></span>نام </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="box-label">
                                <h3><span id="timeExit"></span>ساعت خروج </h3>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <div class="box-label">
                                <h3><span id="daysUse"></span> تاریخ پایان اعتبار</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box-label">
                                <h3><span id="credit"></span>وضعیت برای ورود</h3>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <div class="box-label">
                                <h3><span id="entryLimit"></span>تعداد دفعات قابل استفاده</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

$this->registerJs(
        "
            camel();
    function camel(){
        $.ajax({
            url:'".Yii::$app->urlManager->createAbsoluteUrl(['gym/member-info'])."',
            type: 'POST',
            data:{
                '".Yii::$app->request->csrfParam."': '".Yii::$app->request->csrfToken."'
            }
        }).done(function(data){
        var detail = JSON.parse(data);
        console.log(detail);
            if(data){
                if(detail.status == 1)
                {
                    $('.box-detail-member').css('background-image', 'linear-gradient(rgba(26, 188, 156,0.2),rgba(20,20,20,0))');
                    $('.box-detail-member').css('box-shadow', '1px 1px 200px rgba(26, 188, 156,0.2)');
                    $('#name').text(detail.name+' '+detail.family+' : ');
                    $('#timeEnter').text(detail.timeEnter+' : ');
                    $('#timeExit').text(detail.timeExit+' : ');
                    $('#daysUse').text(detail.numberDaysUse+' : ');
                    $('#entryLimit').text(detail.dayLimit+' : ');
                    $('#credit').text(detail.credit+' : ');
                    $('#member-img').attr('src', detail.img);
                    $('#numberDresser').text(detail.numberDresser);
                    
                    setTimeout(function() {
                        $('#name').text('');
                        $('#timeEnter').text('');
                        $('#timeExit').text('');
                        $('#daysUse').text('');
                        $('#entryLimit').text('');
                        $('#credit').text('');
                        $('#numberDresser').text('کمد ');
                        
                        $('.box-detail-member').css('background-image', 'none');
                        $('.box-detail-member').css('box-shadow', 'none');
                        $('#member-img').attr('src', 'img/images.jpg');
                    }, 7000);
                }else if(detail.status == 0)
                {
                    $('.box-detail-member').css('background-image', 'linear-gradient(rgba(255, 0, 0,0.2),rgba(20,20,20,0))');
                    $('.box-detail-member').css('box-shadow', '1px 1px 300px rgba(255, 0, 0,0.2)');
                    $('#name').text(detail.name+' '+detail.family+' : ');
                    $('#timeEnter').text(detail.timeEnter+' : ');
                    $('#timeExit').text(detail.timeExit+' : ');
                    $('#daysUse').text(detail.numberDaysUse+' : ');
                    $('#entryLimit').text(detail.dayLimit+' : ');
                    $('#credit').text(detail.credit+' : ');
                    $('#numberDresser').text(detail.numberDresser);
                    setTimeout(function() {
                        $('#name').text('');
                        $('#timeEnter').text('');
                        $('#timeExit').text('');
                        $('#daysUse').text('');
                        $('#entryLimit').text('');
                        $('#credit').text('');
                        $('#numberDresser').text('کمد ');
                        $('.box-detail-member').css('background-image', 'none');
                        $('.box-detail-member').css('box-shadow', 'none');
                        $('#member-img').attr('src', 'img/images.jpg');
                    }, 7000);
                }
                if(detail.status == 3){
                    swal({
                        title: detail.data,
                        type: 'warning',
                        showCancelButton: false,
                        showConfirmButton: false,
                        closeOnConfirm: false,
                        timer:5000,
                    });
                }
            }
            camel();
        });
    }
    //time
    
$(function() {
  setInterval(function() {
    var seconds = new Date().getTime() / 1000;
    var time = new Date(),
      hours = time.getHours(),
      min = time.getMinutes(),
      sec = time.getSeconds(),
      millSec = time.getMilliseconds(),
      millString = millSec.toString().slice(0, -2),
      day = time.getDay(),
      ampm = hours >= 12 ? 'بعد از ظهر' : 'قبل از ظهر',
      month = time.getMonth(),
      date = time.getDate(),
      year = time.getFullYear(),
      monthShortNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
      ];

    //convert hours from military time and add the am or pm
    //if (hours > 11) $('#ampm').text(ampm);
    $('#ampm').text(ampm)
    if (hours > 12) hours = hours % 12;
    if (hours == 0) hours = 12;

    //add leading zero for min and sec 
    if (sec <= 9) sec = '0' + sec;
    if (min <= 9) min = '0' + min;

    $('#hours').text(hours);
    $('#min').text(':' + min + ':');
    $('#sec').text(sec);
    //$('#test').text(day);
    // $('#millSec').text(millString);
    $('.days:nth-child(' + (day + 2) + ')').addClass('active');
    $('#month').text(monthShortNames[month]);
    $('#date').text(date);
    $('#year').text(year);

  }, 100);

});

        "
        ,  \yii\web\View::POS_END);