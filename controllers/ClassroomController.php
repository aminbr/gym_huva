<?php
namespace app\controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\web\Controller;
use app\models\ClassRoom;
use app\models\ClassType;
use yii\helpers\ArrayHelper;
use app\models\ClassRoomSearch;

use Yii;
/**
 * Description of ClassroomController
 *
 * @author Amin
 */
class ClassroomController extends Controller{
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['class-create','class-delete', 'class-detail','class-edit', 'class-list'],
                'rules' =>[
                    [
                        'actions' => ['class-create','class-delete', 'class-detail','class-edit', 'class-list'],
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
                    ]
                ]
            ]
        ];
    }
    public $layout = '//admin';
    
    public function actionClassList() {
        $classSearchModel = new ClassRoomSearch();
        $dataProvider = $classSearchModel->search(Yii::$app->request->queryParams);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'classSearchModel' => $classSearchModel,
        ]);
    }
    
    public function actionClassCreate() {
        $classType = ClassType::find()->all();
        $classTypeArray = ArrayHelper::map($classType, 'id', 'name');
        $classModel = new ClassRoom;
        
        if($classModel->load(\Yii::$app->request->post()) && $classModel->validate())
        {
            $classModel->created_at = "".time();
            if($result = $classModel->save())
            {
                $classModel->clearValue();
                return \Yii::$app->utility->renderPjax('callbackPjaxNewClass', [
                    'result' => $result,
                    'message' => 'ثبت شد'
                ]);
            }
            else{
                return $this->renderAjax('create', [
                    'classModel' => $classModel,
                    'classTypeArray' => $classTypeArray,
                ]).\Yii::$app->utility->renderPjax('callbackPjaxNewClass', [
                    'result' => $result,
                    'message' => 'خطا در ثبت اطلاعات'
                ]);
            }
        }
        return $this->renderAjax('create' ,[
            'classModel' => $classModel,
            'classTypeArray' => $classTypeArray,
        ]);
    }
    
    public function actionClassEdit($id) {
        $classTypeModel = ClassType::find()->all();
        $classTypeArray = ArrayHelper::map($classTypeModel, 'id', 'name');
        if(isset($id)){
            $classModel = ClassRoom::findOne($id);
            if($classModel->load(Yii::$app->request->post()) && $classModel->validate()){
                if($result = $classModel->save())
                {
                    $classModel->clearValue();
                    return \Yii::$app->utility->renderPjax('callbackPjaxNewClass', [
                        'result' => $result,
                        'message' => 'ثبت شد'
                    ]);
                }
                else{
                    return $this->renderAjax('create', [
                        'classModel' => $classModel,
                        'classTypeArray' => $classTypeArray,
                    ]).\Yii::$app->utility->renderPjax('callbackPjaxNewClass', [
                        'result' => $result,
                        'message' => 'خطا در ثبت اطلاعات'
                    ]);
                }
            }
            return $this->renderAjax('edit',[
                'classModel' => $classModel,
                'classTypeArray' => $classTypeArray ,
            ]);
        }
    }
    
    public function actionClassDelete($id) {
        $classModel = new ClassRoom;
        if(isset($id)){
            $classModel = ClassRoom::find()->where(['id'=> $id])->one();
            $classModel->is_deleted = 1;
            $classModel->save();
            return $this->goBack();
        }
    }
    
    public function actionClassDetail($id) {
        $classModel = ClassRoom::find()->where(['id' => $id])->one();
        return $this->renderAjax('detail', [
            'classModel' => $classModel,
        ]);
    }
}
