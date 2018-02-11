<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\TagReader;
use yii\web\Controller;
use app\models\ClassRoom;
use yii\helpers\ArrayHelper; 
use app\models\SetClass;
use app\models\EnterExit;
use app\models\Member;
use app\models\OpenDresser;
use app\models\Relay;
use app\models\LockerRoom;
/**
 * Description of GymController
 *
 * @author Amin
 */
class GymController extends Controller{
    
    public $layout = '//admin';
    public $defaultAction='dashboard';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'dashboard'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'dashboard'],
                        'allow' => TRUE,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    
    public function actionDashboard() {
        return $this->render('index', [
            
        ]);
    }
    
//    public function actionIndex()
//    {
//        return $this->render('index');
//    }
    
    public function actionGiveClass() {
        $classModel = ClassRoom::find()->where(['is_deleted' => 0])->all();
        $classArray = ArrayHelper::map($classModel, 'id', 'name');
        $setClassModel = new SetClass;
//        die(var_dump($setClassModel));
        if($setClassModel->load(\Yii::$app->request->post()) && $setClassModel->validate())
        {
//            die(var_dump($setClassModel));
            if($setClassModel->saveClass())
            {
                return \Yii::$app->utility->renderPjax('callbackPjaxClassRoom', [
                    'result' => true,
                    'message' => 'ثبت شد'
                ]);
            }
            else{
                return $this->renderAjax('giveclass', [
                    'setClassModel' => $setClassModel,
                    'classArray' => $classArray,
                ]).\Yii::$app->utility->renderPjax('callbackPjaxClassRoom', [
                    'result' => false,
                    'message' => 'خطا در ثبت اطلاعات'
                ]);
            }
        }
        return $this->renderAjax('giveclass', [
            'setClassModel' => $setClassModel,
            'classArray' => $classArray,
        ]);
    }
    
    public function actionEditMemberClass() {
        $classModel = ClassRoom::find()->where(['is_deleted' => 0])->all();
        $classArray = ArrayHelper::map($classModel, 'id', 'name');
        $setClassModel = new SetClass;
        if($setClassModel->load(\Yii::$app->request->post()) && $setClassModel->validate())
        {
            if($setClassModel->saveEdidtClass())
            {
                return \Yii::$app->utility->renderPjax('callbackPjaxClassRoom', [
                    'result' => true,
                    'message' => 'ثبت شد'
                ]);
            }
            else{
                return $this->renderAjax('giveclass', [
                    'setClassModel' => $setClassModel,
                    'classArray' => $classArray,
                ]).\Yii::$app->utility->renderPjax('callbackPjaxClassRoom', [
                    'result' => false,
                    'message' => 'خطا در ثبت اطلاعات'
                ]);
            }
        }
        return $this->renderAjax('editmemberclass', [
            'setClassModel' => $setClassModel,
            'classArray' => $classArray,
        ]);
    }
    
    
    public function actionOpenDresser() {
        $openDresserModel = new OpenDresser();
        if($openDresserModel->load(\Yii::$app->request->post()) && $openDresserModel->validate())
        {
            $openDresserModel->save();
            return $this->redirect(['dashboard']);
        }
        return $this->renderAjax('opendresser', [
            'openDresserModel' => $openDresserModel,
        ]);
    }


    public function actionOpenDresserGym($id) {
        $enterExitModel = EnterExit::find()->where(['member_id' => $id])->andWhere(['exit_date' => ''])->one();

        $infoRelay = Relay::find()->where(['id' => $enterExitModel->number_dresser])->one();
        $ipRelay = $infoRelay->ip_relay;
        $numberRelay = $infoRelay->number_relay;
        $ch = curl_init('http://'.$ipRelay.'/'.$numberRelay.'n');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_exec($ch);
        curl_close($ch);

        return $this->redirect(['dashboard']);
    }
    
    
    public function actionGymCapacity() 
    {   
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // ظرفیت باشگاه
        $setting = Yii::$app->utility->getSetting();
        $capacity = Relay::find()->where(['type' => 'dresser'])->andWhere(['damage' => '0'])->count();
        $nameGym = $setting['advance']['name'];
        $countMemberEnter = EnterExit::find()->Where(['exit_date' => '',])
            ->andwhere("enter_date != '' ")->count();
        $capacityGym = $capacity - $countMemberEnter; 
        
        // تعداد کلاس ها
        $countClass = ClassRoom::find()->where(['is_deleted' => 0])->count();
        // تعداد افراد ثبت نام شده
        $countMemberRegister = Member::find()->where(['is_deleted' => 0])->count();
        return [
            'capacity' => $capacityGym,
            'countMemberEnter' => (int)$countMemberEnter,
            'nameGym' => $nameGym,
            'countClass' => $countClass,
            'countMemberRegister' => $countMemberRegister,
        ];
    }
    
    public function actionDashboardMember($nTag='')
    {
        $tagReaderModel = new TagReader();
        $tagReaderModel->tagInput = $nTag;
        if($tagReaderModel->validate())
            $tagReaderModel->save();
    }

    public function actionEnterNoCard($id)
    {
        $memberModel = Member::find()->where(['id' => $id])->one();
        $tagReaderModel = new TagReader();
        $tagReaderModel->tagInput = $memberModel->tag_number;
        if($tagReaderModel->validate())
            $tagReaderModel->save();
        return $this->redirect(['dashboard']);
    }
    
    public function actionLockerRoom($nTag='')
    {
        $lockerRoomModel = new LockerRoom();
        $lockerRoomModel->tagNumber = $nTag;
        if($lockerRoomModel->validate())
            $lockerRoomModel->save();
    }
    
    public function actionDashboardMemberpage() {
        $this->layout= "//dashboardmember";
        return $this->render('dashboard_member');
    }
    
    
    public function actionTest() {
//        $s = file_get_contents('http://192.168.1.177/state.json');
//        die(var_dump(json_decode($s)));
//        $number = 10;
//        $name = "relay";
//        $type = "B";
//        for($i=0 ;$i<=$number ;$i++){
//            $sql.="insert into relay(name,number,type) values ('".$name.$i."','".$i."','".$type."')";
//        }
//        Yii::$app->db->createCommand($sql)->execute();
//        $sql="insert into relay(name,number,type) values (".$name.",".$i.",".$type.")";
//        Yii::$app->db->createCommand($sql)->execute();
        
//        $memberCashModel = MemberCash::find()->where(['id' => 18])->one();
//        $dateRegisterClass = $memberCashModel->date_register;
//        $validDate = time()-$dateRegisterClass;
//        $validDate = intval(round($validDate/60/60/24));
//        
//        تست روز
//        $data = "";
//        if(date("l")=="Saturday" || date("l")=="Monday" || date("l")=="Wednesday")
//            $data = "زوج";
//        else if(date("l")=="Sunday" || date("l")=="Tuesday" || date("l")=="Thursday")
//            $data = "فرد";
//        else
//            $data = "جمعه";
////        date_default_timezone_set('Asia/Tehran');
//        $today = date('H:m:s l'); 
//        echo $data."<br>";
//        echo $today;
        var_dump(Yii::$app->urlManager->baseUrl);
        return $this->render('test');
    }
        
    
    public function actionMemberInfo() {
        $this->layout= "//dashboardmember";
        if(Yii::$app->request->isPost){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $data = '';
            $i = 0;
            while (true){
                $i++;
                sleep(3);
                $lines = '';
                $file = fopen(Yii::$app->basePath.'/config/member_info.dat', 'r');
                while($line = fgets($file)) {
                    $lines .=$line;
                }
                fclose($file);
                
                if(!empty($lines))
                {
                    //erase all data from txt file
                    $handle = fopen (Yii::$app->basePath.'/config/member_info.dat', "w+");
                    fclose($handle);
                    return $lines;
                }

                if($i== 7)
                {
                    return false;
                }
            }
        }
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout="\\login";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $myfile = fopen(Yii::$app->basePath."/config/user_id.dat", "w");
            fwrite($myfile, Yii::$app->user->id);
            fclose($myfile);
             
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    public function actionLogin1(){
        return $this->render('login');
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    
    public function actionMusicPlayer() {
        $this->layout = '\\musicplayer';
        return $this->render('music_player');
    }
    
    public function actionCamel(){
        
        return $this->render('camel');
    }
    
    
    public function actionAlarmTime() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $enterExitModel = EnterExit::find()
                ->joinWith('memberCash', 'member')
                ->where(['!=','enter_date', ''])
                ->andWhere(['exit_date' => ''])
                ->all();
        $data=[];
        foreach ($enterExitModel as $enter) {
            $classRoomModel = ClassRoom::findOne($enter->memberCash->class_id);
            $time = time() - $enter->enter_date;
            $hour = $time /60/60;
            if($hour > $classRoomModel->time_limit)
            {
                $data[]= [
                    'id' => $enter->member->id,
                    'nickname' => $enter->member->name,
                    'family' => $enter->member->family,
                ];
            }
        }
        $data['count'] = count($data);
        return $data;
        
    }
    
    public function actionExitMember($id) {
        if(isset($id)){
            $enterExitModle = EnterExit::find()->where(['member_id' => $id])->orderBy('id desc')->one();
            if(isset($enterExitModle)){
                $relayModel = Relay::find()->where(['id' => $enterExitModle->number_dresser])->one();
                $relayModel->alocation = '0';
                $enterExitModle->number_dresser = '0';
                $enterExitModle->exit_date = ''.time();
                $relayModel->save();
                $enterExitModle->save();
                if($enterExitModle->save()){
                    return TRUE;
                }
                else 
                {
                    return FALSE;
                }
            }
        }
    }
}
