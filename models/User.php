<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $nickname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $level
 * @property integer $status
 * @property integer $isDeleted
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nickname', 'username', 'password', 'level', 'status'], 'required', 'message' => 'فیلد "{attribute}" نباید خالی باشد'],
            [['level', 'status', 'is_deleted'], 'integer'],
            [['nickname', 'username', 'email'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 100],
            [['username'], 'unique', 'message' => 'این نام قبلا در سیستم ثبت شده است'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'نام *',
            'username' => 'نام کاربری *',
            'password' => 'رمز ورود *',
            'email' => 'ایمیل',
            'level' => 'نوع دسترسی *',
            'status' => 'وضعیت',
            'is_deleted' => 'Is Deleted',
        ];
    }
    
    public function clearValue()
    {
        $this->nickname = "";
        $this->username = "";
        $this->email = "";
        $this->password= "";
        $this->level = "";
    }
    
    public function getLevel() {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

    public function getAuthKey(){
        return $this->id;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey){
        return $this->id === $authKey;
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        
    }
    
    public static function findByUsername($username)
    {
        return static::find()->where(['username' => $username])->one();
    }

    public function validatePassword($password) {
//        return Yii::$app->security->validatePassword($password, $this->password); // hash password
        return $this->password===$password;

    }
}
