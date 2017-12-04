<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "class_room".
 *
 * @property integer $id
 * @property string $name
 * @property integer $class_type
 * @property string $created_at
 * @property string $updated_at
 * @property integer $price
 * @property integer $number_day
 * @property string $time_limit
 */
class ClassRoomSearch extends ClassRoom
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'number_day', 'time_limit', 'class_type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام کلاس',
            'class_type' => 'نوع کلاس',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'price' => 'قیمت',
            'number_day' => 'تعداد روزهای اعتبار',
            'time_limit' => 'زمان حضور در باشگاه',
            'day_limit' => 'تعداد دفعات قابل استفاده',
            'paired_odd' => 'محدودیت روزها',
        ];
    }
    /**
     * @inheritdoc
     */
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
                    ->andFilterWhere(['LIKE', 'price', $this->price])
                    ->andFilterWhere(['LIKE', 'number_day', $this->number_day])
                    ->andFilterWhere(['LIKE', 'time_limit', $this->time_limit])
                    ->andFilterWhere(['LIKE', 'class_type', $this->class_type]);
        return $dataProvider;
    }
}
