<?php
namespace app\controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Yii;
use app\models\EnterExitSearch;
use yii\web\Controller;
use app\models\EnterExit;
use app\models\MemberCash;
use app\models\Relay;
use app\models\Member;
use app\models\ClassRoom;
/**
 * Description of ReportController
 *
 * @author Amin
 */
class ReportController extends Controller{
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['report-fund','report-gym'],
                'rules' =>[
                    [
                        'actions' => ['report-fund','report-gym'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function(){
                            $level = Yii::$app->user->identity->level;
                            if($level == 1){
                                return FALSE;
                            }else if($level == 2){
                                return TRUE;
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
    //put your code here
    public $layout = '//admin';
    /**
    * @inheritdoc
    */
    public function actionReportGym() {
        $enterExitModel = new EnterExitSearch();
        $dataProvider = $enterExitModel->gym(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        
        return $this->render('gym', [
            'dataProvider' => $dataProvider,
            'enterExitModel' => $enterExitModel,
        ]);
    }
    
    public function actionReportFund() {
        $financialReportModel = new \app\models\FinancialReport();
        $dataProvider = $financialReportModel->search(Yii::$app->request->post());
        $models = $dataProvider->getModels();
        $price = 0;
        for($i=0; $i<count($models); $i++)
        {
            $price+= $models[$i]['price_class'];
        }
        return $this->render('removalcash', [
            'dataProvider' => $dataProvider,
            'financialReportModel' => $financialReportModel,
            'price' => $price,
        ]);
    }
    
    public function actionReportDelete($id) {
        if(isset($id))
        {
            $enterExitModel = EnterExit::find()->where(['member_id'=> $id , 'exit_date' => ''])->one();
            $enterExitModel->exit_date = ''.time();
            $numberDresser = $enterExitModel->number_dresser;
            $relayModel = Relay::find()->where(['id' => intval($numberDresser)])->one();
            $relayModel->alocation = '0';
            $relayModel->save();
            if($relayModel->save())
            {
                $enterExitModel->number_dresser = '0';
                $enterExitModel->save();
            }
            return $this->redirect(['report/report-gym']);
        }
    }
    
    
    public function actionUpdateRelay($id,$number) {
        die(var_dump($number));
        return $this->goBack();
    }
    
    
    public function actionCalculationCredituse($memberid) {
        $memberModel = Member::find()->where(['id' => $memberid])->one();
        $memberCashModel = MemberCash::find()->where(['member_id' => $memberModel->id])->orderBy('id desc')->one();
        $dateRegisterClass = $memberCashModel->date_register;
        $ClassRoomModel = ClassRoom::find()->where(['id' => $memberCashModel->class_id])->one();
        $numberDayLimit = $ClassRoomModel->day_limit;
        $countEnterExitMember = EnterExit::find()->where(['>=', 'enter_date' , $dateRegisterClass])->andWhere(['member_id' => $memberModel->id])->count();
        $numberUses = $numberDayLimit-$countEnterExitMember;
        
        return $numberUses;
    }
    
    
    public function actionNameClass($memberid) {
        $memberModel = Member::find()->where(['id' => $memberid])->one();
        $memberCashModel = MemberCash::find()->where(['member_id' => $memberModel->id])->orderBy('id desc')->one();
        $ClassRoomModel = ClassRoom::find()->where(['id' => $memberCashModel->class_id])->one();
        return $ClassRoomModel->name;
    }
    
    
    public function actionCalculationCreditdate($memberid) {
        $memberModel = Member::find()->where(['id' => $memberid])->one();
        $memberCashModel = MemberCash::find()->where(['member_id' => $memberModel->id])->orderBy('id desc')->one();
        $dateRegisterClass = $memberCashModel->date_register;
        $ClassRoomModel = ClassRoom::find()->where(['id' => $memberCashModel->class_id])->one();
        $validDate = time()-$dateRegisterClass;
        $validDate = intval(round($validDate/60/60/24));
        $numberDaysUse = $ClassRoomModel->number_day - $validDate; // تعداد روز باقیمانده
        $numberDaysUse = $numberDaysUse*86400+ time();
        $dateUse = Yii::$app->utility->convertDate([
            'to' => 'persian',
            'time' => $numberDaysUse,
        ]);
        return $dateUse;
    }
    
    
    public function actionNumberDresser($numDresser) {
        $relayModel = Relay::find()->where(['id' => $numDresser])->one();
        $numberDresser = $relayModel->number;
        return $numberDresser;
    }
    
}
