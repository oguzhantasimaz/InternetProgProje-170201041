<?php
use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use kouosl\notetaking\Module;
use kouosl\notetaking\components\MemberCountWidget;
//
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Note</h1>

        <p class="lead"><?=Html::encode(Module::t('Note','You have successfully run the Note module.'))?></p>

        <p><a class="btn btn-lg btn-danger" href="notes"><?=Html::encode(Module::t('Note','Go to notes'))?></a></p>
    </div>
    <div class="sub_div" style=" position: absolute; bottom: 50px; ">  
                <p><?=Html::encode(MemberCountWidget::widget())?></p> 
            </div> 
</div>
