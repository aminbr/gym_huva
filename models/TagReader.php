<?php
namespace app\models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\base\Model;
use app\models\EnterExit;
use app\models\Tag;
use app\models\Member;
use Yii;
/**
 * Description of CardReader
 *
 * @author Amin
 */
class TagReader extends Model{
    public $tagInput;

    public function rules() {
        return [
            [['tagInput'], 'required'],
            ['tagInput', 'number'],
            ['tagInput', 'cardValidate'],
            ['tagInput', 'classRoomExistValidation', 'skipOnEmpty' => FALSE]
        ];
    }
    
    public function cardValidate($attribute)
    {
        
        $tagModel = $this->getTag();
        if(!isset($tagModel->id))
        {
            $res = '{"status":"3",'
                . '"data":"کارتی با این شناسه وجود ندارد"}';
            $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
            fwrite($myfile, $res);
            fclose($myfile);
            exit();
        }
        else {
            $tagStatus = Tag::find()->where(['tag_number' => $this->tagInput])->andWhere(['status' => 0])->andWhere(['type' => 2])->one();
            if(isset($tagStatus))
            {
                $memberTemporary = MemberTemporary::find()->where(['tag_number' => $this->tagInput])->one();
                if(!isset($memberTemporary))
                {
                    $res = '{"status":"3",'
                        . '"data":"این کارت برای شخصی تخصیص داده نشده است"}';
                    $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                    fwrite($myfile, $res);
                    fclose($myfile);
                }
            }
            $tagStatus = Tag::find()->where(['tag_number' => $this->tagInput])->andWhere(['status' => 1])->andWhere(['type' => 1])->one();
            if(!isset($tagStatus))
            {
                $res = '{"status":"3",'
                    . '"data":"این کارت برای شخصی یییتخصیص داده نشده است"}';
                $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                fwrite($myfile, $res);
                fclose($myfile);
            }
        }
    }

    
    
    public function save() 
    {
        $tagModel = $this->getTag();
        $typeCard = $tagModel->type;
        // جک کردن عضویت موفت
        if($typeCard == 2){
            $exist = EnterExit::find()->where(['tag_number' => $this->tagInput])
                    ->andWhere(['!=', 'enter_date',''])
                    ->andWhere(['=', 'exit_date',''])->orderBy('id desc')->one(); // ورود خورده ولی خروج نخورده است
            if(($exist)){
                $setting = Yii::$app->utility->getSetting();
                $limitTimeExit = $setting['advance']['delay_exit'];
                $timeDelay = $limitTimeExit*60; // تبدیل به دقیقه
                $timeEnter = $exist->enter_date + $timeDelay;
                if($timeEnter < time()){
                    $memberInfo = MemberTemporary::find()->where(['tag_number' => $this->tagInput])->one();
                    $exist->exit_date = ''.time();
                    //  ازاد سازی کمد
                    $numberDresser = $exist->number_dresser;
                    $relayModel = Relay::find()->where(['id' => intval($numberDresser)])->one();
                    $relayModel->alocation = '0';
                    $relayModel->save();
                    $exist->number_dresser = '0';
                    $timeEnterMember = $exist->enter_date;
                    $timeExitMember = $exist->exit_date;
                    // محاسبه اعتبار استفاده مشتری از باشگاه
                    $memberModel = MemberTemporary::find()->where(['tag_number' => $this->tagInput])->one();
                    $countEnterExitMember = EnterExit::find()->where(['!=', 'exit_date' , ''])->andWhere(['tag_number' => $memberModel->tag_number])->count();
                    $numberUses = $memberModel->day_limit - $countEnterExitMember-1;
                    if($exist->save())
                    {
                        $dateEnter = Yii::$app->utility->convertDate([
                            'to' => 'persian',
                            'time' => $timeEnterMember,
                        ]);
                        $dateExit = Yii::$app->utility->convertDate([
                            'to' => 'persian',
                            'time' => $timeExitMember,
                        ]);
                        //گرفتن تنظیمات
                        $config = Yii::$app->utility->getSetting();

                        $memberInfo = '{"status":"1",'
                                . '"name":"'.$memberInfo->name.'",'
                                . '"family":"",'
                                . '"timeEnter":"'.$dateEnter['hour'].' : '.$dateEnter['minute'].' : '.$dateEnter['second'].'",'
                                . '"timeExit":"'.$dateExit['hour'].' : '.$dateExit['minute'].' : '.$dateExit['second'].'",'
                                . '"numberDaysUse":"--",'
                                . '"numberDresser":"--",'
                                . '"dayLimit":"'.$numberUses.'",'
                                .'"img":"img/images.jpg",'
                                . '"credit":"مجاز"}';
                        $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                        fwrite($myfile, $memberInfo);
                        fclose($myfile);
                        $result['result'] = true;
                        $result['memberInfo'] = $memberInfo;
                    }
                    else{
                        $result['result'] = false;
                        $result['memberInfo'] = $memberInfo;
                    }
                }
                else
                {
                    $res = '{"status":"3",'
                            . '"data":"محدودیت در زمان خروج"}';
                    $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                    fwrite($myfile, $res);
                    fclose($myfile);
                    exit();
                }
            }          
            else // هنوز ورود نخورده است
            {
                $findDresser = Relay::find()->where(['alocation' => '0'])->andWhere(['damage' => '0'])->one();
                if(empty($findDresser)){
                    $res = '{"status":"3",'
                            . '"data":"ظرفیت کمدها تکمیل است"}';
                    $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                    fwrite($myfile, $res);
                    fclose($myfile);
                    exit();
                }
                
                $memberModel = MemberTemporary::find()->where(['tag_number' => $this->tagInput])->one();
                $countEnterExitMember = EnterExit::find()->where(['!=', 'exit_date' , ''])->andWhere(['tag_number' => $memberModel->tag_number])->count();
                $numberUses = $memberModel->day_limit - $countEnterExitMember;
                if($numberUses == 0){ // اعتبار ندارد
                    $res = '{"status":"3",'
                            . '"data":"کارت عضو موقت اعتبار ندارد"}';
                    $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                    fwrite($myfile, $res);
                    fclose($myfile);
                    exit();
                }
                else
                {
                    $myfile = fopen(Yii::$app->basePath."/config/user_id.dat", "r");// ذخیره کردن آی دی کاربر
                    $user_id = fgets($myfile);
                    fclose($myfile);
                    $memberModel = MemberTemporary::find()->where(['tag_number' => $this->tagInput])->one();
                    $memberId = $memberModel->id;
                    
                    // ثبت ورود جدید به باشگاه
                    $enterExitModel = new EnterExit();
                    $enterExitModel->tag_number = $this->tagInput;
                    $enterExitModel->member_id = $memberId;
                    $enterExitModel->enter_date = time()."";
                    $enterExitModel->user_id = $user_id;
                    $enterExitModel->exit_date = '';
                    if($enterExitModel->save())
                    {
                        
                        //  انتخاب کمد به صورت تصادفی
                        $select = Relay::find()->where(['alocation' => '0'])
                                ->andWhere(['damage' => '0'])
                                ->orderBy('RAND()')->limit(1)->one();            //->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql;
                        $numberDresser = $select->id;
//                        if(isset($select)){
                            $select->alocation = '1';
                            $enterExitModel->number_dresser = (string)$select->id;
                            $select->save();
                            $enterExitModel->save();
//                        }
                        
                        $timeEnterMember = $enterExitModel->enter_date;
                        $memberInfo = MemberTemporary::find()->where(['tag_number' => $enterExitModel->tag_number])->one();
                        $data = Yii::$app->utility->convertDate([
                            'to' => 'persian',
                            'time' => $timeEnterMember,
                        ]);
                        
                        $memberInfo = '{"status":"1",'
                                . '"name":"'.$memberInfo->name.'",'
                                . '"family":"",'
                                . '"timeEnter":"'.$data['hour'].' : '.$data['minute'].' : '.$data['second'].'",'
                                . '"timeExit":"--:--:--",'
                                . '"numberDaysUse":"--",'
                                . '"dayLimit":"'.$numberUses.'",'
                                . '"numberDresser":"'.$select->number.'",'
                                .'"img":"img/images.jpg",'
                                . '"credit":"مجاز"}';
                        $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                        fwrite($myfile, $memberInfo);
                        fclose($myfile);
                        $result['result'] = true;
                        $result['memberInfo'] = $memberInfo;
                    }
                    else
                    {
                        $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                        fwrite($myfile, json_encode($memberInfo));
                        fclose($myfile);
                    }
                }
            }
        }
        else{
            $result = [
                'result' => false,
            ];
            $exist = EnterExit::find()->where(['tag_number' => $this->tagInput])
                    ->andWhere(['!=', 'enter_date',''])
                    ->andWhere(['=', 'exit_date',''])->orderBy('id desc')->one(); // ورود خورده ولی خروج نخورده است


            if(($exist)){
                $setting = Yii::$app->utility->getSetting();
                $limitTimeExit = $setting['advance']['delay_exit'];
                $timeDelay = $limitTimeExit*60; // تبدیل به دقیقه
                $timeEnter = $exist->enter_date + $timeDelay;
                if($timeEnter < time()){
                    $memberInfo = Member::find()->where(['tag_number' => $this->tagInput])->one();
                    $exist->exit_date = ''.time();
                    //  ازاد سازی کمد
                    $numberDresser = $exist->number_dresser;
                    $relayModel = Relay::find()->where(['id' => intval($numberDresser)])->one();
                    $relayModel->alocation = '0';
                    $relayModel->save();
                    $exist->number_dresser = '0';
                    $exist->save();
                    $timeEnterMember = $exist->enter_date;
                    $timeExitMember = $exist->exit_date;
                    // محاسبه اعتبار استفاده مشتری از باشگاه
                    $memberModel = Member::find()->where(['tag_number' => $this->tagInput])->one();
                    $memberCashModel = MemberCash::find()->where(['member_id' => $memberModel->id])->orderBy('id desc')->one();
                    $dateRegisterClass = $memberCashModel->date_register;
                    $ClassRoomModel = ClassRoom::find()->where(['id' => $memberCashModel->class_id])->one();
                    $countEnterExitMember = EnterExit::find()->where(['>=', 'enter_date' , $dateRegisterClass])->andWhere(['member_id' => $memberModel->id])->count();
                    $numberDayLimit = $ClassRoomModel->day_limit;
                    $numberUses = $numberDayLimit-$countEnterExitMember; // تعداد دفعات قابل استفاده
                    $validDate = time()-$dateRegisterClass;
                    $validDate = intval(round($validDate/60/60/24));
                    $numberDaysUse = $ClassRoomModel->number_day - $validDate; // تعداد روز باقیمانده
                    $numberDaysUse = $numberDaysUse*86400+  time();
                    $dateUse = Yii::$app->utility->convertDate([
                        'to' => 'persian',
                        'time' => $numberDaysUse,
                    ]);
                    if($exist->save())
                    {
                        $dateEnter = Yii::$app->utility->convertDate([
                            'to' => 'persian',
                            'time' => $timeEnterMember,
                        ]);
                        $dateExit = Yii::$app->utility->convertDate([
                            'to' => 'persian',
                            'time' => $timeExitMember,
                        ]);
                        //گرفتن تنظیمات
                        $config = Yii::$app->utility->getSetting();

                        $memberInfo = '{"status":"1",'
                                . '"name":"'.$memberInfo->name.'",'
                                . '"family":"'.$memberInfo->family.'",'
                                . '"timeEnter":"'.$dateEnter['hour'].' : '.$dateEnter['minute'].' : '.$dateEnter['second'].'",'
                                . '"timeExit":"'.$dateExit['hour'].' : '.$dateExit['minute'].' : '.$dateExit['second'].'",'
                                . '"numberDaysUse":"'.$dateUse['year'].' / '.$dateUse['month_num'].' / '.$dateUse['day'].'",'
                                . '"numberDresser":"--",'
                                . '"dayLimit":"'.$numberUses.'",'
                                .'"img":"'.$memberInfo->img.'",'
                                . '"credit":"مجاز"}';
                        $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                        fwrite($myfile, $memberInfo);
                        fclose($myfile);
                        $result['result'] = true;
                        $result['memberInfo'] = $memberInfo;
                    }
                    else{
                        $result['result'] = false;
                        $result['memberInfo'] = $memberInfo;
                    }
                }
                else
                {
                    $res = '{"status":"3",'
                            . '"data":"محدودیت در زمان خروج"}';
                    $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                    fwrite($myfile, $res);
                    fclose($myfile);
                    exit();
                }
            }
            else
            {
                $findDresser = Relay::find()->where(['alocation' => '0'])->andWhere(['damage' => '0'])->one();
                if(empty($findDresser)){
                    $res = '{"status":"3",'
                            . '"data":"ظرفیت کمدها تکمیل است"}';
                    $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                    fwrite($myfile, $res);
                    fclose($myfile);
                    exit();
                }
                $memberModel = Member::find()->where(['tag_number' => $this->tagInput])->one();
                $memberCashModel = MemberCash::find()->where(['member_id' => $memberModel->id])->orderBy('id desc')->one();
                if(!empty($memberCashModel)){
                    $dateRegisterClass = $memberCashModel->date_register;
                    $ClassRoomModel = ClassRoom::find()->where(['id' => $memberCashModel->class_id])->one();
                    $numberDayLimit = $ClassRoomModel->day_limit;
                    $countEnterExitMember = EnterExit::find()->where(['>=', 'enter_date' , $dateRegisterClass])->andWhere(['member_id' => $memberModel->id])->count();
                    $numberUses = $numberDayLimit-$countEnterExitMember; // تعداد دفعات قابل استفاده
                    $validDate = time()-$dateRegisterClass;
                    $validDate = intval(round($validDate/60/60/24));
                    $numberDaysUse = $ClassRoomModel->number_day - $validDate; // تعداد روز باقیمانده
                    $numberDaysUse = $numberDaysUse*86400+ time();
                    $dateUse = Yii::$app->utility->convertDate([
                        'to' => 'persian',
                        'time' => $numberDaysUse,
                    ]);
                    $dayWeek = "";
                    if(date("l")=="Saturday" || date("l")=="Monday" || date("l")=="Wednesday")
                        $dayWeek = "1"; // زوج
                    else if(date("l")=="Sunday" || date("l")=="Tuesday" || date("l")=="Thursday")
                        $dayWeek = "2"; // فرد
                    else
                        $dayWeek = "0"; // جمعه
                    $pairedOdd = $ClassRoomModel->paired_odd;// 3 = هرروز, 2 = فرد, 1 = زوج
                    if($pairedOdd == $dayWeek || $pairedOdd == 3 || $dayWeek == 0){// چک کردن روزهای زوج یا فرد -- $pairedOdd = 3 -> هرروز-- $fsyWeek = 0 -> yy
                        if($validDate < $ClassRoomModel->number_day){// چک کردن تعداد روزهای باقیمانده
                            if($countEnterExitMember < $numberDayLimit){ // چک کردن دفعات قابل استفاده
                                $myfile = fopen(Yii::$app->basePath."/config/user_id.dat", "r");// ذخیره کردن آی دی کاربر
                                $user_id = fgets($myfile);
                                fclose($myfile);

                                // ثبت ورود جدید به باشگاه
                                $enterExitModel = new EnterExit();
                                $enterExitModel->tag_number = $this->tagInput;
                                $enterExitModel->member_id = $this->getId();
                                $enterExitModel->enter_date = time()."";
                                $enterExitModel->user_id = $user_id;
                                $enterExitModel->exit_date = '';
                                if($enterExitModel->save())
                                {
                                    //  انتخاب کمد به صورت تصادفی
                                    $select = Relay::find()->where(['alocation' => '0'])->andWhere(['damage' => '0'])->orderBy('RAND()')->limit(1)->one();            //->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql;
                                    $numberDresser = $select->id;
                                    if(isset($select)){
                                        $select->alocation = '1';
                                        $enterExitModel->number_dresser = (string)$select->id;
                                        $select->save();
                                        $enterExitModel->save();
                                    }

                                    $timeEnterMember = $enterExitModel->enter_date;
                                    $memberInfo = Member::find()->where(['tag_number' => $enterExitModel->tag_number])->one();
                                    $data = Yii::$app->utility->convertDate([
                                        'to' => 'persian',
                                        'time' => $timeEnterMember,
                                    ]);

    //                                    $res = 'test';
    //                                    $myfile = fopen(Yii::$app->basePath."/config/yyyyyyyyyyyyyyyyyyyyyyyyyyyyy.dat", "w");
    //                                    fwrite($myfile, json_encode($res));
    //                                    fclose($myfile);
                                    $memberInfo = '{"status":"1",'
                                            . '"name":"'.$memberInfo->name.'",'
                                            . '"family":"'.$memberInfo->family.'",'
                                            . '"timeEnter":"'.$data['hour'].' : '.$data['minute'].' : '.$data['second'].'",'
                                            . '"timeExit":"--:--:--",'
                                            . '"numberDaysUse":"'.$dateUse['year'].' / '.$dateUse['month_num'].' / '.$dateUse['day'].'",'
                                            . '"dayLimit":"'.$numberUses.'",'
                                            . '"numberDresser":"'.$select->number.'",'
                                            .'"img":"'.$memberInfo->img.'",'
                                            . '"credit":"مجاز"}';
                                    $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                                    fwrite($myfile, $memberInfo);
                                    fclose($myfile);
                                    $result['result'] = true;
                                    $result['memberInfo'] = $memberInfo;
                                }
                                else
                                {
                                    $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                                    fwrite($myfile, json_encode($memberInfo));
                                    fclose($myfile);
                                }
                            }
                            else
                            {
                                // اعتبار تعداد استفاده از کلاس تمام شده است
                                $memberInfo = '{"status":"0",'
                                        . '"name":"'.$memberModel->name.'",'
                                        . '"family":"'.$memberModel->family.'",'
                                        . '"timeEnter":"--:--:--",'
                                        . '"timeExit":"--:--:--",'
                                        . '"numberDaysUse":"'.$dateUse['year'].' / '.$dateUse['month_num'].' / '.$dateUse['day'].'",'
                                        . '"dayLimit":"0",'
                                        . '"numberDresser":"--",'
                                        . '"credit":"غیر مجاز"}';
                                $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                                fwrite($myfile, $memberInfo);
                                fclose($myfile);
                                exit();
                            }
                        }
                        else
                        {
                            // زمان استفاده از کلاس تمام شده است
                            $memberInfo = '{"status":"0",'
                                    . '"name":"'.$memberModel->name.'",'
                                    . '"family":"'.$memberModel->family.'",'
                                    . '"timeEnter":"--:--:--",'
                                    . '"timeExit":"--:--:--",'
                                    . '"dayLimit":"0",'
                                    . '"numberDaysUse":"'.$dateUse['year'].' / '.$dateUse['month_num'].' / '.$dateUse['day'].'",'
                                    . '"numberDresser":"--",'
                                    . '"credit":"غیر مجاز"}';
                            $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                            fwrite($myfile, $memberInfo);
                            fclose($myfile);
                            exit();
                        }
                    }else{
                        if($dayWeek == 1){
                            $pairedOdd = "فرد";
                        } 
                        else if($dayWeek == 2)
                        {
                            $pairedOdd = "زوج";
                        }
                        $res = '{"status":"3",'
                        . '"data":"این کارت مخصوص روزهای '.$pairedOdd.' میباشد"}';
                        $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                        fwrite($myfile, $res);
                        fclose($myfile);
                        exit();
                    }
                }
                else{
                    $result['result'] = false;
                    $result['memberInfo'] = $memberInfo;
                }
            }
            
            // check kardan komodhaei k azad nistand !!! //////////////////////
            $enterExitVacant = EnterExit::find()->where(['!=', 'exit_date', ''])
                    ->andWhere(['!=', 'number_dresser', '0'])
                    ->orderBy('id desc')->one();
            if(!empty($enterExitVacant))
            {
//                $res = '{"status":"3",'
//                    . '"data":"'.$enterExitVacant->number_dresser.'+'.$enterExitVacant->id.'"}';
//                $myfile = fopen(Yii::$app->basePath."/config/mmmmmmmmmmmmmmmmmmmmmmmmember_info.dat", "w");
//                fwrite($myfile, $res);
//                fclose($myfile);
                $emptyReleyDresser = Relay::find()->where(['id' => intval($enterExitVacant->number_dresser)])->one();
                $emptyReleyDresser->alocation = '0';
                $res = $emptyReleyDresser->save();
                if($res)
                {
                    $enterExitVacant->number_dresser = '0';
                    $res2 = $enterExitVacant->save();
                    if(!$res2)
                    {
                        $res = '{"status":"3",'
                            . '"data":"شماره کمد '.$emptyReleyDresser->number.'  ازاد نشد"}';
                        $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                        fwrite($myfile, $res);
                        fclose($myfile);
                    }
//                    else
//                    {
//                        $res = '{"status":"3",'
//                            . '"data":"شماره کمد '.$emptyReleyDresser->number.'  ازاد شد"}';
//                        $myfile = fopen(Yii::$app->basePath."/config/nnnnnnnnnnnmember_info.dat", "w");
//                        fwrite($myfile, $res);
//                        fclose($myfile);
//                    }
                }
            }
            
            return $result;
        }
    }
      
    
    public function getTag() {
        return $tagModel = Tag::find()->where(['tag_number' => $this->tagInput])->one();
    }
    
    public function getId()
    {
        $memberModel = Member::find()->where(['tag_number' => $this->tagInput])->one();
        return $memberModel->id;
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tagInput' => 'شماره کارت',
        ];
    }
    
    public function classRoomExistValidation($attribute)
    {
        
        $tagNumber = $this->$attribute;
        $tagModel = $this->getTag();
        $typeCard = $tagModel->type;
        // جک کردن عضویت موفت
        if($typeCard == 2){
            $memberModel = MemberTemporary::find()->where(['tag_number' => $this->tagInput])->one();
            $countEnterExitMember = EnterExit::find()->where(['!=', 'exit_date' , ''])->andWhere(['tag_number' => $memberModel->tag_number])->count();
            $numberUses = $memberModel->day_limit - $countEnterExitMember;
            if($numberUses == 0)
            {
                $res = '{"status":"3",'
                    . '"data":"اعتبار این کارت به پایان رسیده است"}';
                $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                fwrite($myfile, $res);
                fclose($myfile);
            }
        }
        else if($typeCard == 1)
        {
            $memberModel = Member::find()->where(['tag_number' => $this->tagInput])->one();
            if($memberModel)
            {
                $memberCashModel = MemberCash::find()->where(['member_id' => $memberModel->id])->orderBy('id desc')->one();
                if(empty($memberCashModel))
                {
                    $res = '{"status":"3",'
                            . '"data":"کلاسی به این شخص تخصیص داده نشده است"}';
                    $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                    fwrite($myfile, $res);
                    fclose($myfile);
                }
            }
            else
            {
                $res = '{"status":"3",'
                        . '"data":"این کارت برای شخصی صادر نشده است"}';
                $myfile = fopen(Yii::$app->basePath."/config/member_info.dat", "w");
                fwrite($myfile, $res);
                fclose($myfile);
            }
        }
        
        
//        else {
//            $date = $memberCashModel->date_register;
//            $class_id = $memberCashModel->class_id;
//            $classModel = ClassRoom::findOne($class_id);
//            $numberDay = $classModel->number_day;
//            $numberDay = $date + ($numberDay*60*60*24);
//            $newDate = time();// + (1*60*60*24); // pak shavad 20 roz
//            $resTime = $numberDay- $newDate;
//            $day = intval(round($resTime/60/60/24));
////            die(var_dump($day));
//            if($day <= 0)
//            {
//                $memberInfo = '{"data":"اعتبار این کارت به پایان رسیده است"}';
//                $myfile = fopen(Yii::$app->basePath."/config//member_info.dat", "w");
//                fwrite($myfile, $memberInfo);
//                fclose($myfile);
//            }
//        }
//        die(var_dump($day));
    }
}
