<?php
use yii\helpers\Html; 
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

Html::encode($quest->name)?>
<p><?=Html::encode($quest->questionText) ?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

<? if(Yii::$app->session->getFlash('success')) { ?>
    <div class="col-lg-offset-1 col-lg-11">
        <? Yii::$app->session->getFlash('success'); ?>
    </div>
<? }?>

<?= $form->field($answer, 'text')->textarea(['rows' => 5, 'cols' => 5]); ?> <hr>
<?= $form->field($answer, 'question_id')->hiddenInput(['value' => $quest->id])->label(false); ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Ответить и закрыть', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
</div>
