<?php
namespace app\controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\web\Controller;
use app\models\User;
use app\models\Level;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\UserSearch;
use Yii;
/**
 * Description of UserController
 *
 * @author Amin
 */
class UserController extends Controller{
    
    public $layout = '//admin';
    
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['user-create', 'user-delete', 'user-detail','user-update', 'user-list'],
                'rules' =>[
                    [
                        'actions' => ['user-create', 'user-delete', 'user-detail','user-update', 'user-list'],
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
                        'actions' => ['user-list', 'user-update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function(){
                            $level = Yii::$app->user->identity->level;
                            if($level == 1){
                                return FALSE;
                            }else if($level == 2){
                                return FALSE;
                            }else if($level == 3){
                                return true;
                            }else if($level == 6){
                                return true;
                            }else if($level == 8){
                                return FALSE; // \Yii::$app->controller->redirect(['card/createcard'])
                            }
                        },
                    ]
                ]
            ]
        ];
    }
    
    public function actionUserCreate()
    {
        $levelModel = Level::find()->all();
        $levelArray = ArrayHelper::map($levelModel, 'id', 'name');
        $userModel = new User;
        if($userModel->load(\Yii::$app->request->post()) && $userModel->validate()){
            $userModel->password = password_hash($userModel->password, PASSWORD_DEFAULT);
            if($result = $userModel->save())
            {
                return \Yii::$app->utility->renderPjax('callbackPjaxUser', [
                    'result' => $result,
                    'message' => 'ثبت شد'
                ]);
            }
            else{
                return $this->renderAjax('create', [
                    'userModel' => $userModel,
                    'levelArray' => $levelArray,
                ]).\Yii::$app->utility->renderPjax('callbackPjaxUser', [
                    'result' => $result,
                    'message' => 'خطا در ثبت اطلاعات'
                ]);
            }
            
        }
        return $this->renderAjax('create', [
            'userModel' => $userModel,
            'levelArray' => $levelArray,
        ]);
    }
    
    public function actionUserList()
    {
        $userSearchModel = new UserSearch();
        $dataProvider = $userSearchModel->search(Yii::$app->request->queryParams);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'userSearchModel' => $userSearchModel,
        ]);
    }
    
    
    public function actionUserUpdate($id)
    {
        $levelModel = Level::find()->all();
        $levelArray = ArrayHelper::map($levelModel, 'id', 'name');
        if(isset($id)){
            $userModel = User::findOne($id);
            if($userModel->load(Yii::$app->request->post()) && $userModel->validate()){
                if($result = $userModel->save())
                {
                    return \Yii::$app->utility->renderPjax('callbackPjaxUser', [
                        'result' => $result,
                        'message' => 'ثبت شد'
                    ]);
                }
                else{
                    return $this->renderAjax('create', [
                        'userModel' => $userModel,
                        'levelArray' => $levelArray,
                    ]).\Yii::$app->utility->renderPjax('callbackPjaxUser', [
                        'result' => $result,
                        'message' => 'خطا در ثبت اطلاعات'
                    ]);
                }
            }
            return $this->renderAjax('update',[
                'userModel' => $userModel,
                'levelArray' => $levelArray ,
            ]);
        }
    }
    
    public function actionUserDelete($id)
    {
        $userModel = new User;
        if(isset($id)){
            $userModel = User::find()->where(['id'=> $id])->one();
            $userModel->is_deleted = 1;
            $userModel->save();
            return $this->goBack();
        }
    }
    
    public function actionUserDetail($id) {
        $userModel = User::find()->where(['id' => $id])->one();
        return $this->renderAjax('detail', [
            'userModel' => $userModel,
        ]);
    }
}
