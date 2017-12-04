<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;


class UserSearch extends User
{
    public function rules() {
        return [
            [['nickname', 'username', 'level', 'status', 'email'], 'safe']
        ];
    }
    
    public function search($params) {
        $levelUser = Yii::$app->user->identity->level;
        if($levelUser == 6){
            $activeQuery = static::find()->where("level !=1")->andWhere("level !=3")->andWhere("level !=8")->andWhere(['is_deleted' => 0]);
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
            $activeQuery->andFilterWhere(['LIKE', 'email', $this->email])
                        ->andFilterWhere(['LIKE', 'username', $this->username])
                        ->andFilterWhere(['LIKE', 'nickname', $this->nickname])
                        ->andFilterWhere(['LIKE', 'status', $this->status])
                        ->andFilterWhere(['LIKE', 'level', $this->level]);
            return $dataProvider;
        }
        else
        {
            $activeQuery = static::find()->where("level !=8")->andWhere("level !=6")->andWhere(['is_deleted' => 0]);
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
            $activeQuery->andFilterWhere(['LIKE', 'email', $this->email])
                        ->andFilterWhere(['LIKE', 'username', $this->username])
                        ->andFilterWhere(['LIKE', 'nickname', $this->nickname])
                        ->andFilterWhere(['LIKE', 'status', $this->status])
                        ->andFilterWhere(['LIKE', 'level', $this->level]);
            return $dataProvider;
        }
    }
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'نام',
            'username' => 'نام کاربری',
            'password' => 'رمز ورود',
            'email' => 'ایمیل',
            'level' => 'نوع دسترسی',
            'status' => 'وضعیت',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
