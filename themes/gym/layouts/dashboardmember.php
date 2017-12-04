<?php
use app\assets\MemberAsset;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
MemberAsset::register($this);
?>
<style>
    
</style>
<?php $this->beginPage() ?>
<html>
    <head>
        <title><?= $this->title ?></title>
    <?php $this->head(); ?>
    </head>
    <?php $this->beginBody(); ?>
    <body onload="" style="background-color: #fff;">
        <?= $content; ?>
    <?php $this->endBody() ?>
    </body>
</html>
<?php 
    $this->registerJs('
        
        ',\yii\web\View::POS_END);
?>
<?php $this->endPage() ?>