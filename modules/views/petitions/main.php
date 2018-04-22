<?php
use yii\helpers\Html; 
use yii\helpers\Url;

$this->title = 'Обращения:'; ?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <? foreach($models as $m) {?>
        <p><?=Html::encode($m->name)?>
        <p><?=Html::encode($m->questionTextEng) ?>
        <p><?= Html::a('Ответить', Url::to(['answer', 'id' => $m->id]), ['class'=>'btn btn-primary']) ?>
    <? } ?>
</div>
