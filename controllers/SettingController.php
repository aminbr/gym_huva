<?php
namespace app\controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\web\Controller;
use app\models\Config;
use app\models\InfoRelay;
use app\models\Relay;
use Yii;
/**
 * Description of SettingController
 *
 * @author Amin
 */
class SettingController extends Controller{
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['setting-advance', 'setting-basic', 'setting-dresser', 'update-system', 'add-relay'],
                'rules' =>[
                    [
                        'actions' => ['setting-basic', 'setting-dresser', 'update-system'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function(){
                            $level = Yii::$app->user->identity->level;
                            if($level == 1){
                                return FALSE;
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
                    ],
                    [
                        'actions' => ['setting-advance', 'update-system', 'add-relay', 'setting-dresser'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function(){
                            $level = Yii::$app->user->identity->level;
                            if($level == 1){
                                return FALSE;
                            }else if($level == 2){
                                return FALSE;
                            }else if($level == 3){
                                return FALSE;
                            }else if($level == 6){
                                return TRUE;
                            }else if($level == 8){
                                return FALSE; // \Yii::$app->controller->redirect(['card/createcard'])
                            }
                        },
                    ],
                ]
            ]
        ];
    }
    public $layout = '//admin';
    
    public function actionSettingBasic() {
        $configModel = new Config();
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post('Config');
            $configModel->saveConfig($data);
        }
        $setting = Yii::$app->utility->getSetting();
        return $this->render('basicsetting', [
            'setting' => $setting,
            'configModel' => $configModel
        ]);
    }
    
    public function actionUpdateSystem() {
        $res = exec("git pull origin master");
        if($res){
            Yii::$app->session->setFlash("success", 'عملیات به روز رسانی با موفقیت انجام شد');
//            $result = '{"status":"'.$res.'"}';
//            $myfile = fopen(Yii::$app->basePath."/config/member_infooooooooooooooooooo.dat", "w");
//            fwrite($myfile, $result);
//            fclose($myfile);
            $this->redirect(['gym/dashboard']);
        }  else {
            $result = '{"status":"'.$res.'"}';
            $myfile = fopen(Yii::$app->basePath."/config/update_failed.dat", "w");
            fwrite($myfile, $result);
            fclose($myfile);
            $this->redirect(['gym/dashboard']);
        }
    }
    
    public function actionSendMail() {
        set_time_limit(1000);
        $sttings = Yii::$app->utility->setting;
//        $mail = Yii::$app->mail->compose()
//        ->setFrom('webcandoo@gmail.com')
//        ->setTo('aminbalavar93@gmail.com')
//        ->setSubject('yii2')
//        ->setTextBody('Plain text content')
//        ->send();
        
        \Yii::$app->mail->compose()
            ->setFrom(['aminbalavar93@gmail.com' => 'Test Mail'])
            ->setTo('akbar.joody@gmail.com')
            ->setSubject('This is a test mail ' )
            ->send();
//        var_dump($mail);
        
    }
    
    public function actionSettingAdvance() {
        $configModel = new Config();
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post('Config');
            $configModel->saveConfig($data);
        }
        $setting = Yii::$app->utility->getSetting();
        return $this->render('advancesetting', [
            'setting' => $setting,
            'configModel' => $configModel
        ]);
    }
    
    public function actionAddRelay() {
        $dresserModel = new InfoRelay();     
        if($dresserModel->load(\Yii::$app->request->post()) && $dresserModel->validate()){
            $dresserModel->setValues();
        }
        return $this->render('settingdresser', [
            'dresserModel' => $dresserModel,
        ]);
    }
    
    
    public function actionSettingDresser($pid = 0) {
        
//        $relayModel->load(\Yii::$app->request->post());
//        $relayModel->validate();
//        return var_dump($relayModel->errors);
        $relayModel = Relay::findOne($pid);
        if(isset($relayModel)){
            if($relayModel->load(\Yii::$app->request->post()) && $relayModel->validate())
            {
                Yii::$app->session->setFlash('success', 'تغییرات در رله شماره '.$relayModel->number.'انجام شد');
                $relayModel->save();
            }
        }
        $relayModels = Relay::find()->orderBy('number asc')->all();
        return $this->render('dresser', [
            'relayModels' => $relayModels,
        ]);
    }
}
