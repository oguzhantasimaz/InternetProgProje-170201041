<?php

use yii\helpers\Html;
use kouosl\notetaking\Module;
use kouosl\notetaking\components\MemberCountWidget;
//
$this->title =  Module::t('notetaking', 'Take Note');
$this->params['breadcrumbs'][] = ['label' => Module::t('notetaking', 'Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notetaking-notes-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
  <div class="sub_div" style=" position: absolute; bottom: 50px; ">  
                <p><?=Html::encode(MemberCountWidget::widget())?></p> 
            </div> 
</div>
