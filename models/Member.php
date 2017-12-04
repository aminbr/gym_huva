<?php

namespace app\models;
use app\models\Member;
use app\models\Tag;
use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $name
 * @property string $family
 * @property string $nt_code
 * @property integer $gender
 * @property string $job
 * @property string $date_birth
 * @property string $mobile
 * @property string $telephone
 * @property string $email
 * @property string $address
 * @property string $img
 * @property string $tag_number
 * @property integer $is_deleted
 */
class Member extends \yii\db\ActiveRecord
{
    public $hidden_data;
    public $edit_img=1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['default'][] ='hidden_data';
        $scenarios['edit'] = ['name', 'family', 'nt_code', 'email', 'gender', 'date_birth', 'address', 'job', 'hidden_data', 'edit_img'];
        $scenarios['editcard'] = ['tag_number'];
        $scenarios['delete'] = ['is_deleted'];
        $scenarios['saveimage'] = ['img'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'family', 'nt_code', 'gender', 'date_birth', 'address', 'tag_number', 'job'], 'required'],
            [['nt_code', 'gender', 'mobile', 'telephone', 'tag_number', 'is_deleted'], 'integer'],
            [['name', 'family', 'job'], 'string', 'max' => 50],
            [['date_birth'], 'string', 'max' => 20],
            [['email', 'address', 'img'], 'string', 'max' => 100],
//            [['nt_code'], 'unique'],
            ['tag_number', 'tagValidatecreate', 'on' => 'create'],
            [['name', 'family', 'nt_code', 'gender', 'date_birth', 'address', 'job'], 'required', 'on' => 'edit'],
            ['tag_number', 'tagValidatecreate', 'on' => 'editcard'],
            [['hidden_data'], 'required', 'on' => 'create'],
        ];
    }

    public function tagValidatecreate($attribute)
    {
        $tagModel = $this->getTag();
        if(!isset($tagModel->id))
        {
            $this->addError($attribute, "کارتی با این شناسه وجود ندارد");
        }else
        {
            $memberModel = Member::find()->where(['tag_number' => $this->tag_number, 'is_deleted' => 0])->one();
            if($memberModel)
            {
                $this->addError($attribute, "این کارت قبلا در سیستم ثبت شده است");
            }
            $tagModel->status = 1;
            $tagModel->type = 1;
            $tagModel->save();
        }
    }
    
    public function tagValidateedit($attribute)
    {
        $tagModel = $this->getTag();
        if(!isset($tagModel->id))
        {
            $this->addError($attribute, "کارتی با این شناسه وجود ندارد");
        }else
        {
            $memberModel = Member::find()->where(['tag_number' => $this->tag_number, 'is_deleted' => 0])->one();
            if($memberModel)
            {
                $this->addError($attribute, "این کارت قبلا در سیستم ثبت شده است");
            }
            $tagModel->status = 1;
            $tagModel->save();
        }
    }
    
    
//    public function tagValidateedit($attribute)
//    {
//        $tagModel = $this->getTag();
//        if(!isset($tagModel->id))
//        {
//            $this->addError($attribute, "کارتی با این شناسه وجود ندارد");
//        }else
//        {
//            $memberModel = Tag::find()->where(['tag_number' => $this->tag_number, 'is_deleted' => 0, 'status' => 1])->one();
//            if($memberModel)
//            {
//                $this->addError($attribute, "این کارت قبلا در سیستم ثبت شده است");
//            }
//            $tagModel->status = 1;
//            $tagModel->save();
//        }
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام *',
            'family' => 'نام خانوادگي *',
            'nt_code' => 'شماره ملي *',
            'gender' => 'جنسيت *',
            'job' => 'شغل *',
            'date_birth' => 'تاريخ تولد *',
            'mobile' => 'تلفن همراه',
            'telephone' => 'تلفن منزل',
            'email' => 'ايميل',
            'address' => 'آدرس',
            'img' => 'عکس',
            'tag_number' => 'شماره کارت *',
            'is_deleted' => 'حذف',
            'edit_img' => 'ویرایش عکس',
        ];
    }
    
    public function clearValue()
    {
        $this->name = "";
        $this->family = "";
        $this->nt_code = "";
        $this->gender= "";
        $this->job = "";
        $this->date_birth = "";
        $this->mobile = "";
        $this->telephone = "";
        $this->email= "";
        $this->address = "";
        $this->tag_number = "";
}
    
    public function getTag() {
        return $tagModel = Tag::find()->where(['tag_number' => $this->tag_number])->one();
    }
}
