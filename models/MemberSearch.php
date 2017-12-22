<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class MemberSearch extends Member
{
    public function rules() {
        return [
            [['name', 'family', 'nt_code', 'gender', 'email', 'tag_number'], 'safe']
        ];
    }
    
    public function search($params) {
        $activeQuery = static::find()->where(['is_deleted' => 0]);
        
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
        
        $activeQuery->andFilterWhere(['LIKE', 'name', $this->name])
                    ->andFilterWhere(['LIKE', 'family', $this->family])
                    ->andFilterWhere(['LIKE', 'nt_code', $this->nt_code])
                    ->andFilterWhere(['LIKE', 'gender', $this->gender])
                    ->andFilterWhere(['LIKE', 'email', $this->email])
                    ->andFilterWhere(['LIKE', 'tag_number', $this->tag_number]);
        return $dataProvider;
    }
    
    
    public function telephone($params) {
        $activeQuery = static::find()->where(['is_deleted' => 0]);
        
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
        
        $activeQuery->andFilterWhere(['LIKE', 'name', $this->name])
                    ->andFilterWhere(['LIKE', 'family', $this->family])
                    ->andFilterWhere(['LIKE', 'mobile', $this->mobile]);
        return $dataProvider;
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام',
            'family' => 'نام خانوادگي',
            'nt_code' => 'شماره ملي',
            'gender' => 'جنسيت',
            'job' => 'شغل',
            'date_birth' => 'تاريخ تولد',
            'mobile' => 'تلفن همراه',
            'telephone' => 'تلفن منزل',
            'email' => 'ايميل',
            'address' => 'آدرس',
            'img' => 'عکس',
            'tag_number' => 'شماره کارت',
            'is_deleted' => 'حذف',
            'edit_img' => 'ویرایش عکس',
        ];
    }
}
