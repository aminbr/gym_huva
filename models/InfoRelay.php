<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_relay".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $number
 * @property string $ip_relay
 */
class InfoRelay extends \yii\db\ActiveRecord
{
    public $ipAddress;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_relay';
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['default'][] = 'ipAddress';
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'number'], 'safe'],
            [['number'], 'integer'],
            [['name', 'type', 'ip_relay'], 'string', 'max' => 50],
            [['name'], 'unique'],
            [['ipAddress'], 'url']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ipAddress' => 'آدرس رله',
            'name' => 'نام',
            'type' => 'نوع',
            'number' => 'تعداد رله',
            'ip_relay' => 'آی پی رله',
        ];
    }
    
    public function setValues(){
//        $this->clearValue();
        if(empty($this->name) && empty($this->type) && empty($this->number) && empty($this->ip_relay)){
            $data = @file_get_contents($this->ipAddress);   
            if($data){
//                die(var_dump($data));
                $data = json_decode($data);
                $this->name = $data->name;
                $this->type = $data->type;
                $this->number = $data->number;
                $this->ip_relay = $data->ip;
            }
            else{
                $this->addError('ipAddress', 'این آدرس درشبکه موجود نمی باشد');
            }
        }
        else 
        {
            $data = file_get_contents($this->ipAddress); 
            $data = json_decode($data);
            if($this->name == $data->name && $this->type == $data->type && $this->number == $data->number && $this->ip_relay == $data->ip){
                $this->save();
                $sql="insert into relay(name,number,number_relay,ip_relay,type) values";
                
                $maxNumberRelay = Relay::find()->max('number');
                $maxNumberRelay = empty($maxNumberRelay) ? 0:$maxNumberRelay;
                $j = 1;
                for($i=$maxNumberRelay+1 ; $i <= ($this->number+$maxNumberRelay) ; $i++){
                    $sql.=" ('".$this->name.$i."','".$i."','".$j."','".$this->ip_relay."','".$this->type."'),";
                    $j++;
                }
                $sql = substr($sql, 0, (strlen($sql)-1)).';';
                Yii::$app->db->createCommand($sql)->execute();
                $this->clearValue();
            }
            else
            {
                $this->addError('ipAddress', 'مقدار فیلدها نامعتبر میباشد'); 
                $this->name = "";
                $this->type = "";
                $this->number = "";
                $this->ip_relay = "";
            }
        }
    }
    
    public function clearValue(){
        $this->name = "";
        $this->type = "";
        $this->number = "";
        $this->ipAddress = "";
        $this->ip_relay = "";
    }
}
