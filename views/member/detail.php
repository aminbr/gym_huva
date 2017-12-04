<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//die(var_dump($memberModel->img));
?>
<style>
    img{
        height: 100%;
        width: 100%;
        border-radius: 10px;
    }
    h3{
        color: #555;
    }
    .padding-right{
        padding-right: 40px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">نمایش اطلاعات کاربر</h4>
            </div>
            <div class="card-content table-responsive"></div>
        </div>
        <div class="col-md-6">
            <img src="<?php echo $memberModel->img; ?>"/>
        </div>
        <div class="col-md-6 padding-right">
            <?= '<h4>نام:'.$memberModel->name.' '.$memberModel->family.'</h4>'; ?>
            <?= '<h4>تاریخ تولد:'.$memberModel->date_birth.'</h4>'; ?>
            <?= '<h4>شماره تماس:'.$memberModel->mobile.'</h4>'; ?>
            <?= '<h4>شماره منزل:'.$memberModel->telephone.'</h4>'; ?>
            <?= '<h4>آدرس:'.$memberModel->address.'</h4>'; ?>
            <?= '<h4> کلاس گرفته شده:'.$className.'</h4>'; ?>
            <?= '<h4>تعدا دفعات قابل استفاده:'.$numberUses.'</h4>'; ?>
            <?= '<h4>تاریخ اعتبار کلاس:'.$dateUse['year'].'/'.$dateUse['month_num'].'/'.$dateUse['day'].'</h4>'; ?>
        </div>
    </div>
</div>