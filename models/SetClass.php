<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 *
 * @property string $tagMember
 * @property integer $typeClass
 */
class SetClass extends MemberCash
{
    public $tagMember;
    public $typeClass;

    public function rules() {
        return [
            [['tagMember', 'typeClass'], 'required'],
            [['tagMember'], 'number'],
            [['typeClass'], 'number'],
            ['tagMember', 'cardValidate'],
        ];
    }
    
    public function cardValidate($attribute) {
        $tagModel = $this->getTag();
        if(!isset($tagModel->id))
        {
            $this->addError($attribute, "کارتی با این شناسه وجود ندارد");
            $this->clearValue();
        }
        else{
            $enterExitModel = EnterExit::find()->where(['exit_date' => '',])
                    ->andWhere(['tag_number' => $tagModel->tag_number])->one();
            $memberModel = Member::find()->where(['tag_number' => $tagModel->tag_number])->one();
            if(isset($enterExitModel))
            {
                $this->addError($attribute, "این کارت قبلا خروج نخورده است");
                $this->clearValue();
            }
            else if(!isset($memberModel))
            {
                $this->addError($attribute, "این کارت در حال حاظر برای شخصی ثبت نشده است");
            }
        }
    }
    
    public function saveClass()
    {
        $memberModel = $this->getmember();
        $classModel = $this->getPrice();
//        die(var_dump($classModel));
        if(isset($memberModel->id))
        {
            $setClassModel = new MemberCash();
            $setClassModel->date_register = ''.time();
            $setClassModel->member_id = $memberModel->id;
            $setClassModel->user_id = Yii::$app->user->id;
            $setClassModel->class_id = $this->typeClass;
            $setClassModel->price_class = $classModel->price;
            $setClassModel->save();
            $this->clearValue();
            if($setClassModel->save())
            {
                return true;
            }
        }
        else
        {
            die('sss');
        }
        
    }
    
    public function saveEdidtClass()
    {
        $memberModel = $this->getmember();
//        die(var_dump($classModel));
        if(isset($memberModel->id))
        {
            $setClassModel = new MemberCash();
            $setClassModel->date_register = ''.time();
            $setClassModel->member_id = $memberModel->id;
            $setClassModel->user_id = Yii::$app->user->id;
            $setClassModel->class_id = $this->typeClass;
            $setClassModel->price_class = 0;
            $setClassModel->save();
            $this->clearValue();
            if($setClassModel->save())
            {
                return true;
            }
        }
        else
        {
            die('sss');
        }
        
    }


    public function getTag() {
        return $tagModel = Tag::find()->where(['tag_number' => $this->tagMember])->one();
    }
    
    public function getmember() {
        return $memberModel = Member::find()->where(['tag_number' => $this->tagMember])->one();
    }
    
    public function getPrice()
    {
        return $classModel = ClassRoom::find()->where(['id' => $this->typeClass])->one();
    }


    public function clearValue()
    {
        $this->tagMember = "";
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tagMember' => 'تگ را وارد کنید',
            'typeClass' => 'نام کلاس زا انتخاب کنید',
        ];
    }
}
