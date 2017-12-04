<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $tag_number
 * @property string $created_at
 * @property string $updated_at
 * @property integer $type
 * @property integer $status
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_number', 'type'], 'required'],
            [['tag_number', 'type', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'string', 'max' => 50],
            [['tag_number'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_number' => 'شماره کارت',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type' => 'نوع',
            'status' => 'Status',
        ];
    }
    
    public function clearValue()
    {
        $this->tag_number = "";
        $this->type = "";
    }
}
