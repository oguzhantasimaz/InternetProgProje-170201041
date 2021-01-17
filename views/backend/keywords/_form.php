<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="notetaking-keywords-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'not_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
