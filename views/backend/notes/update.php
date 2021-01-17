<?php

use yii\helpers\Html;
use kouosl\notetaking\components\MemberCountWidget;
use kouosl\notetaking\Module;

$this->title = 'Update Notetaking Notes: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('notetaking', 'Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'user_id' => $model->user_id, 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notetaking-notes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
  <div class="sub_div" style=" position: absolute; bottom: 50px; ">  
                <p><?=Html::encode(MemberCountWidget::widget())?></p> 
            </div> 
</div>
