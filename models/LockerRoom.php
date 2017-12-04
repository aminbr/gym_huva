<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "info_relay".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $number
 * @property string $ip_relay
 */
class LockerRoom extends Model
{
    public $tagNumber;
    
    public function rules() {
        return[
            ['tagNumber', 'required'],
            ['tagNumber', 'number'],
        ];
    }
    
    function save(){
        $enterExitModel = EnterExit::find()
                ->where(['tag_number' => $this->tagNumber])
                ->andWhere(['!=', 'enter_date',''])
                ->andWhere(['=', 'exit_date',''])
                ->orderBy('id desc')
                ->one();
        if($enterExitModel)
        {
            $relayModel = Relay::find()->where(['id' => $enterExitModel->number_dresser])->one();
            $ipRelay = $relayModel->ip_relay;
            $numberRelay = $relayModel->number_relay;
            $setting = Yii::$app->utility->getSetting();
            $ipDisplay = $setting['advance']['ip_display'];
            
            // نمایش شماره کمد بر روی نمایشگر
            $ch = curl_init('http://'.$ipDisplay.'/'.$relayModel->number);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2);
            curl_exec($ch);
            curl_close($ch);
            sleep(3);
            // باز کردن کمد
            $ch = curl_init('http://'.$ipRelay.'/'.$numberRelay.'n');
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2);
            curl_exec($ch);
            curl_close($ch);
            sleep(1);
            exit();
        }
        
        
//        $setting = Yii::$app->utility->getSetting();
//        $ipDisplay = $setting['advance']['ip_display'];
//        $ch = curl_init('http://'.$ipDisplay.'/a');
//        curl_setopt($ch, CURLOPT_HEADER, 1);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
//        curl_exec($ch);
//        curl_close($ch);
    }

    public function attributeLabels() {
        return [
            'numberDresser' => 'شماره کمد',
        ];
    }
}
