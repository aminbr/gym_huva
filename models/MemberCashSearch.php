<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class MemberCashSearch extends MemberCash
{
    public function rules() {
        return [
            [['date_register', 'member_id', 'class_id', 'user_id', 'price_class'], 'safe'],
        ];
    }    
    
    public function search($params) {
        $activeQuery = static::find()
                ->joinWith('user')
                ->joinWith('member')
                ->joinWith('class');
        
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
        
        $activeQuery->andFilterWhere(['LIKE', 'date_register', $this->date_register])
                    ->andFilterWhere(['LIKE', 'user.nickname', $this->nickname]);
        return $dataProvider;
    }
}
