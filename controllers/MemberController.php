<?php
namespace app\controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\models\Member;
use app\models\Job;
use app\models\MemberSearch;
use app\models\Tag;
use app\models\MemberTemporary;
use Yii;
use app\models\EnterExit;
use app\models\MemberCash;
use app\models\ClassRoom;
/**
 * Description of MemberController
 *
 * @author Amin
 */
class MemberController extends Controller{
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['member-create', 'member-delete', 'member-detail','member-update', 'member-list', 'member-editcard', 'save-image'],
                'rules' =>[
                    [
                        'actions' => ['member-create', 'member-delete', 'member-detail','member-update', 'member-list', 'member-editcard', 'save-image'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function(){
                            $level = Yii::$app->user->identity->level;
                            if($level == 1){
                                return TRUE;
                            }else if($level == 2){
                                return FALSE;
                            }else if($level == 3){
                                return TRUE;
                            }else if($level == 6){
                                return FALSE;
                            }else if($level == 8){
                                return FALSE; // \Yii::$app->controller->redirect(['card/createcard'])
                            }
                        },
                    ]
                ]
            ]
        ];
    }
    public $layout = '//admin';
    
    public function actionMemberCreate()
    {
        $jobModel = Job::find()->all();
        $jobArray = ArrayHelper::map($jobModel, 'id', 'name');
        $memberModel = new Member;
        $memberModel->setScenario('create');
//        $memberModel->load(\Yii::$app->request->post());
//        $memberModel->validate();
//        return var_dump($memberModel->errors);
        if($memberModel->load(\Yii::$app->request->post()) && $memberModel->validate()){
            // از تاریخ
//            $buffer1 = explode('/', $memberModel->date_birth);
//            $yearFromDate = $buffer1[0];
//            $monthFromDate = $buffer1[1];
//            $dayFromDate = $buffer1[2];
//            $date_j_to_g_fromDate = Yii::$app->utility->jalali_to_gregorian_date($yearFromDate,$monthFromDate,$dayFromDate); // تبدیل به ثانیه
//            
//            $secondFromDate = strtotime($date_j_to_g_fromDate[0].'/'.$date_j_to_g_fromDate[1].'/'.$date_j_to_g_fromDate[2]); // طھط¨ط¯غŒظ„ ظ…غŒظ„ط§ط¯غŒ ط¨ظ‡ ط«ط§ظ†غŒظ‡
//            die(var_dump($secondFromDate));
//            $memberModel->date_birth = ''.$secondFromDate;
            if($result = $memberModel->save())
            {
                $memberModel->clearValue();
                return $this->renderAjax('create', [
                    'memberModel' => $memberModel,
                    'jobArray' => $jobArray,
                ]).\Yii::$app->utility->renderPjax('callbackPjaxMember', [
                    'result' => $result,
                    'message' => 'ثبت شد',
                    'member_id' => $memberModel->id,
                ]);
            }
            else{
                return $this->renderAjax('create', [
                    'memberModel' => $memberModel,
                    'jobArray' => $jobArray,
                ]).\Yii::$app->utility->renderPjax('callbackPjaxMember', [
                    'result' => $result,
                    'message' => 'خطا در ثبت اطلاعات'
                ]);
            }
        }
        return $this->renderAjax('create', [
            'memberModel' => $memberModel,
            'jobArray' => $jobArray,
        ]);
    }
    
    /**
     * 
     * @param type $mid member id
     */
    public function actionSaveImage($mid) // save image member use webcam 
    {
        $memberModel = Member::findOne($mid);
        if(isset($memberModel->id)){
//            die('kjhgfghj');
            $upload_dir = "upload/";
            $img = $_POST['hidden_data'];
            $img = str_replace('data:image/jpeg;base64,', '', $img);
            $img = str_replace('', '+', $img);
            $data = base64_decode($img);
            
            $config = Yii::$app->utility->getSetting();
            $time = time()."_".$mid . ".jpeg";
            $file = $upload_dir . $time;
            $memberModel->setScenario('saveimage');
            $memberModel->img = Yii::$app->urlManager->baseUrl.'/'.$config['advance']['url_member_img'].'/'.$time;
            $memberModel->save();
            $success = file_put_contents($file, $data);

            print $success ? $file : 'Unable to save the file.';
        }
    }
    
    
    public function actionMemberList()
    {
        $memberSearchModel = new MemberSearch();
        $dataProvider = $memberSearchModel->search(Yii::$app->request->queryParams);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'memberSearchModel' => $memberSearchModel,
        ]);
    }
    
    public function actionMemberUpdate($id)
    {
        $jobModel = Job::find()->all();
        $jobArray = ArrayHelper::map($jobModel, 'id', 'name');
        if(isset($id)){
            $memberModel = Member::findOne($id);
            $memberModel->setScenario('edit');
            
            if($memberModel->load(Yii::$app->request->post())){
                $value_edit_img = 1;
                if($memberModel->edit_img == 0)
                {
                    $memberModel->hidden_data = null;
                    $value_edit_img = 0;
                }
                if($result = $memberModel->save())
                {
                    
                    return $this->renderAjax('update', [
                        'memberModel' => $memberModel,
                        'jobArray' => $jobArray,
                        
                    ]).\Yii::$app->utility->renderPjax('callbackPjaxMember', [
                        'result' => $result,
                        'message' => 'ثبت شد',
                        'value_edit_img' => $value_edit_img,
                        'member_id' => $memberModel->id,
                    ]);
                }
                else{
                    return $this->renderAjax('update', [
                        'memberModel' => $memberModel,
                        'jobArray' => $jobArray,
                    ]).\Yii::$app->utility->renderPjax('callbackPjaxMember', [
                        'result' => $result,
                        'message' => 'خطا در ثبت اطلاعات'
                    ]);
                }
            }
            return $this->renderAjax('update',[
                'memberModel' => $memberModel,
                'jobArray' => $jobArray ,
            ]);
        }
    }
    
    public function actionMemberEditcard($id) {
        if(isset($id)){
            $memberModel = Member::findOne($id);
            $memberModel->setScenario('editcard');
            if($memberModel->load(Yii::$app->request->post()) && $memberModel->validate()){
                if($result = $memberModel->save())
                {
                    $memberModel->clearValue();
                    return \Yii::$app->utility->renderPjax('callbackPjaxMember', [
                        'result' => $result,
                        'message' => 'ثبت شد',
                        
                    ]);
                }
                else{
                    return $this->renderAjax('create', [
                        'memberModel' => $memberModel,
                    ]).\Yii::$app->utility->renderPjax('callbackPjaxMember', [
                        'result' => $result,
                        'message' => 'خطا در ثبت اطلاعات'
                    ]);
                }
            }
            return $this->renderAjax('editcard',[
                'memberModel' => $memberModel,
                'title' => 'ویرایش کارت',
            ]);
        }
    }
    
    public function actionMemberDelete($id)
    {
        $memberModel = new Member;
        if(isset($id)){
            $memberModel = Member::find()->where(['id'=> $id])->one();
            $memberModel->setScenario('delete');
            $tagModel = Tag::find()->where(['tag_number' => $memberModel->tag_number])->one(); 
            $memberModel->is_deleted = 1;
            $memberModel->tag_number = 0;
            if($memberModel->save()){
                $tagModel->status = 0; // تغییر فیلد وضعیت در جدول تگ از یک به صفر
                $tagModel->save();
                return $this->redirect(['member-list']);
            }
        }
    }
    
    public function actionMemberDetail($id) {
        //className
        $memberModel = Member::find()->where(['id' => $id])->one();
        $memberCashModel = MemberCash::find()->where(['member_id' => $memberModel->id])->orderBy('id desc')->one();
        $ClassRoomModel = ClassRoom::find()->where(['id' => $memberCashModel->class_id])->one();
        $className = $ClassRoomModel->name;
        //dateUse
        $dateRegisterClass = $memberCashModel->date_register;
        $validDate = time()-$dateRegisterClass;
        $validDate = intval(round($validDate/60/60/24));
        $numberDaysUse = $ClassRoomModel->number_day - $validDate; // تعداد روز باقیمانده
        $numberDaysUse = $numberDaysUse*86400+ time();
        $dateUse = Yii::$app->utility->convertDate([
            'to' => 'persian',
            'time' => $numberDaysUse,
        ]);
        //numberUse
        $numberDayLimit = $ClassRoomModel->day_limit;
        $countEnterExitMember = EnterExit::find()->where(['>=', 'enter_date' , $dateRegisterClass])->andWhere(['member_id' => $memberModel->id])->count();
        $numberUses = $numberDayLimit-$countEnterExitMember;
        
        return $this->renderAjax('detail', [
            'memberModel' => $memberModel,
            'className' => $className,
            'dateUse' => $dateUse,
            'numberUses' => $numberUses,
        ]);
    }

    
    public function actionMemberTemporary() {
        $memberTemporaryModel = new MemberTemporary();
        if($memberTemporaryModel->load(Yii::$app->request->post()) && $memberTemporaryModel->validate()){
            $memberTemporaryModel->date_register = ''.time();
            $memberTemporaryModel->save();
            $memberTemporaryModel->clearValue();
        }
        return $this->render('createmembertemporary', [
            'memberTemporaryModel' => $memberTemporaryModel,
            'title' => 'ثبت عضو موقت',
        ]);
    }
}
