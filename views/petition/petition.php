<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;

$this->title = 'Обращения:';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
   
    <? foreach($models as $m) {?>
    <?=Html::encode($m->name)?>
    Статус: <?=Html::encode($m->info)?>
        <p><?=Html::encode($m->questionText) ?>
        <p><?=Html::encode($m->answerText) ?><hr>
    <? } ?>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <? if(Yii::$app->session->getFlash('warning')) { ?>
            <div class="col-lg-offset-1 col-lg-11">
                <? Yii::$app->session->getFlash('warning'); ?>
            </div>
        <? } else if(Yii::$app->session->getFlash('success')) { ?>
            <div class="col-lg-offset-1 col-lg-11">
                <? Yii::$app->session->getFlash('success'); ?>
            </div>
        <? } else {?>
 
        <?= $form->field($model, 'text')->textarea(['rows' => 5, 'cols' => 5]); ?> <hr>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <? } ?>

    <?php ActiveForm::end(); ?>
</div>
