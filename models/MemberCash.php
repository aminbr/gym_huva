<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_cash".
 *
 * @property integer $id
 * @property string $date_register
 * @property integer $member_id
 * @property integer $class_id
 * @property integer $price_class
 */
class MemberCash extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_cash';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_register', 'member_id', 'class_id', 'user_id', 'price_class'], 'required'],
            [['member_id', 'class_id', 'user_id', 'price_class'], 'integer'],
            [['date_register'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_register' => 'Date Register',
            'member_id' => 'Member ID',
            'class_id' => 'Class ID',
        ];
    }
    
    function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    function getMember() {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }
    
    function getClass() {
        return $this->hasOne(ClassRoom::className(), ['id' => 'class_id']);
    }
}
