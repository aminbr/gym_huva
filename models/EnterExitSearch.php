<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class EnterExitSearch extends EnterExit
{
    public $nickname;
    public $type;


    public function rules() {
        return [
            [['id', 'nickname', 'family', 'type', 'enter_date', 'exit_date',], 'safe']
        ];
    }    
    
    public function search($params) {
        $activeQuery = static::find()->where("exit_date !=''")
                ->joinWith('user')
                ->joinWith('member');
        $dataProvider = new ActiveDataProvider([
            'query' => $activeQuery,
            'pagination' => [
                'totalCount' => $activeQuery->count(),
                'pageSize' => 10,
            ]
        ]);
        if(!$this->load($params) && $this->validate())
        {
            return $dataProvider;
        }
        
        $activeQuery->andFilterWhere(['LIKE', 'user.nickname', $this->nickname])
                ->andFilterWhere(['LIKE', 'member.name', $this->name]);
        return $dataProvider;
    } 
    
    public function gym($params) {
        $activeQuery = static::find()->where(['exit_date' => '',])
                ->orderBy('id asc');
//                ->joinWith('user')
//                ->joinWith('memberCash.class');
        $dataProvider = new ActiveDataProvider([
            'query' => $activeQuery,
        ]);
        
        if(!$this->load($params) && $this->validate()){
            return $dataProvider;
        }
    }
}
