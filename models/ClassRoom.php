<?php

namespace app\models;

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
 * @property integer $day_limit
 * @property integer $paired_odd
 * @property integer $is_deleted
 */
class ClassRoom extends \yii\db\ActiveRecord
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
            [['name', 'class_type', 'price', 'number_day', 'time_limit', 'day_limit', 'paired_odd'], 'required'],
            [['class_type', 'price', 'number_day', 'day_limit', 'paired_odd', 'is_deleted'], 'integer'],
            [['name', 'created_at', 'updated_at', 'time_limit'], 'string', 'max' => 50],
//            [['name'], 'unique'],
            ['day_limit', 'classValidate'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام کلاس *',
            'class_type' => 'نوع کلاس *',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'price' => 'قیمت *',
            'number_day' => 'تعداد روزهای اعتبار *',
            'time_limit' => 'زمان حضور در باشگاه *',
            'day_limit' => 'تعداد دفعات قابل استفاده *',
            'paired_odd' => 'محدودیت روزها *',
        ];
    }
    
    public function clearValue()
    {
        $this->name = "";
        $this->class_type = "";
        $this->price = "";
        $this->number_day= "";
        $this->time_limit = "";
    }
    
    public function classValidate($attribute) {
        if($this->$attribute >= $this->number_day){
            $this->addError($attribute,'مقدار این فیلد باید کمتر از تعداد روزهای اعتبار باشد');
        }
    }
}
