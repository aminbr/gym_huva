<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relay".
 *
 * @property integer $id
 * @property string $name
 * @property string $number
 * @property string $number_relay
 * @property string $ip_relay
 * @property string $type
 * @property string $alocation
 * @property string $damage
 */
class Relay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number', 'number_relay', 'ip_relay', 'type'], 'required'],
            [['name', 'number_relay', 'ip_relay', 'type', 'alocation', 'damage'], 'string', 'max' => 50],
            [['number'], 'unique'],
            [['number'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام رله',
            'number' => 'شماره',
            'number_relay' => 'Number Relay',
            'ip_relay' => 'آی پی',
            'type' => 'نوع رله',
            'alocation' => 'وضعیت تخصیص',
            'damage' => 'وضعیت خرابی رله',
        ];
    }
}
