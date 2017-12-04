<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_temporary".
 *
 * @property integer $id
 * @property string $name
 * @property string $tag_number
 * @property integer $day_limit
 * @property string $date_register
 */
class MemberTemporary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_temporary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tag_number', 'day_limit'], 'required'],
            [['tag_number', 'day_limit'], 'integer'],
            [['name', 'date_register'], 'string', 'max' => 50],
            [['tag_number'], 'unique'],
            ['tag_number', 'cardValidate'],
        ];
    }

    public function cardValidate($attribute)
    {
        
        $tagModel = $this->getTag();
        if(!isset($tagModel->id))
        {
            $this->addError($attribute, "کارتی با این شناسه وجود ندارد");
        }
    }
    
//    public function save(){
//        
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام',
            'tag_number' => 'شماره کارت',
            'day_limit' => 'محدودیت استفاده',
            'date_register' => 'Date Register',
        ];
    }
    
    public function clearValue()
    {
        $this->name = '';
        $this->day_limit = '';
        $this->tag_number = '';
}
    
    public function getTag() {
        return $tagModel = Tag::find()->where(['tag_number' => $this->tag_number])->one();
    }
}
