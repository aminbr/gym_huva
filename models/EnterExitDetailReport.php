<?php
namespace app\models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Yii;
use yii\data\ActiveDataProvider;
/**
 * Description of CardReader
 *
 * @author Amin
 */
class EnterExitDetailReport extends \yii\base\Model{
    public $fromDate;
    public $tillDateOf;
//    public $type;

    public function rules() {
        return [
            [['fromDate', 'tillDateOf'], 'required'],
            [['fromDate', 'tillDateOf'], 'string'],
        ];
    }
    
    public function search($params) {
        $activeQuery = EnterExit::find()->where(['!=', 'enter_date', ''])
                ->andWhere(['!=', 'exit_date', '']);
        $dataProvider = new ActiveDataProvider([
                'query' => $activeQuery,
                'pagination' => [
                    'totalCount' => $activeQuery->count(),
                    'pageSize' => 500,
                ]
            ]);
        if(!$this->load($params))
        {
            return $dataProvider;
        }
        
        if($this->validate())
        { 
            // از تاریخ
            $buffer1 = explode('/', $this->fromDate);
            $yearFromDate = $buffer1[0];
//            die(var_dump($yearFromDate));
            $monthFromDate = $buffer1[1];
            $dayFromDate = $buffer1[2];
            $date_j_to_g_fromDate = Yii::$app->utility->jalali_to_gregorian_date($yearFromDate,$monthFromDate,$dayFromDate); // طھط¨ط¯غŒظ„ ط´ظ…ط³غŒ ط¨ظ‡ ظ…غŒظ„ط§ط¯غŒ
            $secondFromDate = strtotime($date_j_to_g_fromDate[0].'/'.$date_j_to_g_fromDate[1].'/'.$date_j_to_g_fromDate[2]); // طھط¨ط¯غŒظ„ ظ…غŒظ„ط§ط¯غŒ ط¨ظ‡ ط«ط§ظ†غŒظ‡

            // تا تاریخ
            $buffer2 = explode('/', $this->tillDateOf);
            $yearTillDateOf = $buffer2[0];
            $monthTillDateOf = $buffer2[1];
            $dayTillDateOf = $buffer2[2];
            $date_j_to_g_tillDateOf = Yii::$app->utility->jalali_to_gregorian_date($yearTillDateOf,$monthTillDateOf,$dayTillDateOf); // طھط¨ط¯غŒظ„ ط´ظ…ط³غŒ ط¨ظ‡ ظ…غŒظ„ط§ط¯غŒ
            $secondTillDateOf = strtotime($date_j_to_g_tillDateOf[0].'/'.$date_j_to_g_tillDateOf[1].'/'.$date_j_to_g_tillDateOf[2]); // طھط¨ط¯غŒظ„ ظ…غŒظ„ط§ط¯غŒ ط¨ظ‡ ط«ط§ظ†غŒظ‡
            
            $activeQuery->where(['>=', 'enter_date', $secondFromDate])
                        ->andWhere(['<=', 'enter_date', $secondTillDateOf]);
        }
        return $dataProvider;
        
    }
    
    
    
    public function attributeLabels()
    {
        return [
            'fromDate' => 'از تاریخ',
            'tillDateOf' => 'تا تاریخ',
            'type' => 'نوع کارت',
        ];
    }
}
