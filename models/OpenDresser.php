<?php
namespace app\models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\base\Model;
use Yii;
/**
 * Description of OpenDresser
 *
 * @author Amin
 */
class OpenDresser extends Model{
    public $numberDresser;
    
    public function rules() {
        return[
            ['numberDresser', 'required'],
            ['numberDresser', 'number'],
            ['numberDresser', 'numberValidations'],
        ];
    }
    
    function numberValidations($attribute) {
        $relayModel = Relay::find()->where(['number' => $this->numberDresser])->one();
        if(!isset($relayModel)){
            $this->addError($attribute, 'این شماره کمد وجود ندارد');
        }
    }
    
    function save(){
        $infoRelay = Relay::find()->where(['number' => $this->numberDresser])->one();
        $ipRelay = $infoRelay->ip_relay;
        $numberRelay = $infoRelay->number_relay;
        $ch = curl_init('http://'.$ipRelay.'/'.$numberRelay.'n');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_exec($ch);
        curl_close($ch);
        
    }


    public function attributeLabels() {
        return [
            'numberDresser' => 'شماره کمد',
        ];
    }
}
