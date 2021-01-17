<?php
use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kouosl\notetaking\components\MemberCountWidget;
use kouosl\notetaking\Module;
?>

<div class="notetaking-notes-form">

<?php

if (!Yii::$app->user->can('seeAllNotes')) $model->user_id=Yii::$app->user->getId();
 
?>

    <?php $form = ActiveForm::begin();

    
    if (!Yii::$app->user->can('seeAllNotes')) 
    echo $form->field($model, 'user_id')->hiddenInput()->label(false); 
    else 
    {
        echo $form->field($model, 'user_id')->textInput(); 
    }
    ?>
  

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'status')->dropDownList(
			[0 => Module::t('notetaking','Private'), 1=> Module::t('notetaking','Public')]
			)->label(Module::t('notetaking','Status'));
?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <div class="sub_div" style=" position: absolute; bottom: 50px; ">  
                <p><?=Html::encode(MemberCountWidget::widget())?></p> 
            </div> 
</div>
