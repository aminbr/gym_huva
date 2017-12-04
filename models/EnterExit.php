<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enter_exit".
 *
 * @property integer $id
 * @property string $tag_number
 * @property integer $member_id
 * @property string $enter_date
 * @property integer $user_id
 * @property string $exit_date
 * @property string $number_dresser
 */
class EnterExit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enter_exit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_number', 'member_id', 'enter_date', 'user_id'], 'required'],
            [['tag_number', 'member_id', 'user_id'], 'integer'],
            [['enter_date', 'exit_date', 'number_dresser'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_number' => 'Tag Number',
            'member_id' => 'Member ID',
            'enter_date' => 'Enter Date',
            'user_id' => 'User ID',
            'exit_date' => 'Exit Date',
            'number_dresser' => 'Number Dresser',
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
    
    public function getMemberCash() {
        return $this->hasOne(MemberCash::className(), ['member_id' => 'member_id']);
    }
}
