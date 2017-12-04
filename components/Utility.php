<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;
use app\models\Config;
use yii\base\Component;

/**
 * Description of Utility
 *
 * @author asus
 */
class Utility extends Component {

   public function getSetting() {
        $configModel = Config::find()->all();
        $config = [];
        foreach ($configModel as $con)
        {
            $config[$con->mode][$con->key_config] = $con->value;
        }
        return $config;
    }

    public function convertDate($array) {
        $time = $array['time'];
        if ($array['to'] == 'persian') {
            date_default_timezone_set("Asia/tehran");
            $weekdays = array("شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه");
            $months = array("فروردین", "اردیبهست", "خرداد", "تیر", "مرداد", "شهریور",
                "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند");
            $dayNumber = date("d", $time);
            $monthNumber = date("m", $time);
            $year = date("Y", $time);
            $weekDayNumber = date("w", $time);
            $hour = date("G", $time);
            $minute = date("i", $time);
            $second = date("s", $time);
            switch ($monthNumber) {
                case 1:
                    ($dayNumber < 20) ? ($monthNumber = 10) : ($monthNumber = 11);
                    ($dayNumber < 20) ? ($dayNumber += 10) : ($dayNumber -= 19);
                    break;
                case 2:
                    ($dayNumber < 19) ? ($monthNumber = 11) : ($monthNumber = 12);
                    ($dayNumber < 19) ? ($dayNumber += 12) : ($dayNumber -= 18);
                    break;
                case 3:
                    ($dayNumber < 21) ? ($monthNumber = 12) : ($monthNumber = 1);
                    ($dayNumber < 21) ? ($dayNumber += 10) : ($dayNumber -= 20);
                    break;
                case 4:
                    ($dayNumber < 21) ? ($monthNumber = 1) : ($monthNumber = 2);
                    ($dayNumber < 21) ? ($dayNumber += 11) : ($dayNumber -= 20);
                    break;
                case 5:
                case 6:
                    ($dayNumber < 22) ? ($monthNumber -= 3) : ($monthNumber -= 2);
                    ($dayNumber < 22) ? ($dayNumber += 10) : ($dayNumber -= 21);
                    break;
                case 7:
                case 8:
                case 9:
                    ($dayNumber < 23) ? ($monthNumber -= 3) : ($monthNumber -= 2);
                    ($dayNumber < 23) ? ($dayNumber += 9) : ($dayNumber -= 22);
                    break;
                case 10:
                    ($dayNumber < 23) ? ($monthNumber = 7) : ($monthNumber = 8);
                    ($dayNumber < 23) ? ($dayNumber += 8) : ($dayNumber -= 22);
                    break;
                case 11:
                case 12:
                    ($dayNumber < 22) ? ($monthNumber -= 3) : ($monthNumber -= 2);
                    ($dayNumber < 22) ? ($dayNumber += 9) : ($dayNumber -= 21);
                    break;
            }
            $newDate['day'] = $dayNumber;
            $newDate['month_num'] = $monthNumber;
            $newDate['month_name'] = $months[$monthNumber - 1];
            if (($monthNumber < 3) or ( ($monthNumber == 3) and ( $dayNumber < 21)))
                $newDate['year'] = $year - 621;
            else
                $newDate['year'] = $year - 621;
            if ($weekDayNumber == 6)
                $newDate['weekday_num'] = 0;
            else
                $newDate['weekday_num'] = $weekDayNumber + 1;
            $newDate['weekday_name'] = $weekdays[$newDate['weekday_num']];
            $newDate['hour'] = $hour;
            $newDate['minute'] = $minute;
            $newDate['second'] = $second;
            return $newDate;
        }
    }
    
    
    public function renderPjax($callback, $data = []) {
        $dataJson = \yii\helpers\Json::encode($data);
        if(is_string($callback)){
            return '<script>'.$callback.'('.$dataJson.'); </script>';
        }
    }

    
    
    
    
    
    
    
    
/** Gregorian & Jalali (Hijri_Shamsi,Solar) Date Converter Functions
Author: JDF.SCR.IR =>> Download Full Version : http://jdf.scr.ir/jdf
License: GNU/LGPL _ Open Source & Free _ Version: 2.72 : [2017=1396]
--------------------------------------------------------------------
1461 = 365*4 + 4/4   &  146097 = 365*400 + 400/4 - 400/100 + 400/400
12053 = 365*33 + 32/4    &    36524 = 365*100 + 100/4 - 100/100   */


function gregorian_to_jalali_date($gy,$gm,$gd,$mod=''){
 $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
 if($gy>1600){
  $jy=979;
  $gy-=1600;
 }else{
  $jy=0;
  $gy-=621;
 }
 $gy2=($gm>2)?($gy+1):$gy;
 $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
 $jy+=33*((int)($days/12053)); 
 $days%=12053;
 $jy+=4*((int)($days/1461));
 $days%=1461;
 if($days > 365){
  $jy+=(int)(($days-1)/365);
  $days=($days-1)%365;
 }
 $jm=($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
 $jd=1+(($days < 186)?($days%31):(($days-186)%30));
 return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
}


function jalali_to_gregorian_date($jy,$jm,$jd,$mod=''){
 if($jy>979){
  $gy=1600;
  $jy-=979;
 }else{
  $gy=621;
 }
 $days=(365*$jy) +(((int)($jy/33))*8) +((int)((($jy%33)+3)/4)) +78 +$jd +(($jm<7)?($jm-1)*31:(($jm-7)*30)+186);
 $gy+=400*((int)($days/146097));
 $days%=146097;
 if($days > 36524){
  $gy+=100*((int)(--$days/36524));
  $days%=36524;
  if($days >= 365)$days++;
 }
 $gy+=4*((int)($days/1461));
 $days%=1461;
 if($days > 365){
  $gy+=(int)(($days-1)/365);
  $days=($days-1)%365;
 }
 $gd=$days+1;
 foreach(array(0,31,(($gy%4==0 and $gy%100!=0) or ($gy%400==0))?29:28 ,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
  if($gd<=$v)break;
  $gd-=$v;
 }
 return($mod=='')?array($gy,$gm,$gd):$gy.$mod.$gm.$mod.$gd; 
}









function jd_to_greg($julian) { 
    $julian = $julian - 1721119; 
    $calc1 = 4 * $julian - 1; 
    $year = floor($calc1 / 146097); 
    $julian = floor($calc1 - 146097 * $year); 
    $day = floor($julian / 4); 
    $calc2 = 4 * $day + 3; 
    $julian = floor($calc2 / 1461); 
    $day = $calc2 - 1461 * $julian; 
    $day = floor(($day + 4) / 4); 
    $calc3 = 5 * $day - 3; 
    $month = floor($calc3 / 153); 
    $day = $calc3 - 153 * $month; 
    $day = floor(($day + 5) / 5); 
    $year = 100 * $year + $julian; 

    if ($month < 10) { 
        $month = $month + 3; 
    } 
    else { 
        $month = $month - 9; 
        $year = $year + 1; 
    } 
    return "$day.$month.$year"; 
} 
}
