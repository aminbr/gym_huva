<?php
namespace app\controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\web\Controller;
use app\models\Tag;
use app\models\TagType;
use yii\helpers\ArrayHelper;
use Yii;
/**
 * Description of TagController
 *
 * @author Amin
 */
class TagController extends Controller{
    
    public $layout = '//admin';
    /**
     * @inheritdoc
     */
    public function actionTagCreate() {
        $tagModel = new Tag();
        $tagTypeModel = TagType::find()->all();
        $tagTypeArray = ArrayHelper::map($tagTypeModel, 'id', 'name');
        if($tagModel->load(\Yii::$app->request->post()) && $tagModel->validate())
        {
            $tagModel->created_at = "".time();
            $tagModel->status = "0";
            $tagModel->save();
            $tagModel->clearValue();
        }
        $numberTag = Tag::find()->count();
        return $this->render('create', [
            'tagModel' => $tagModel,
            'tagTypeArray' => $tagTypeArray,
            'numberTag' => $numberTag,
        ]);
    }
}
