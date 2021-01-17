<?php
use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use kouosl\notetaking\Module;
use kouosl\notetaking\components\MemberCountWidget;

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Notetaking</h1>

        <p class="lead"><?=Html::encode(Module::t('notetaking','You have successfully run the notetaking module.'))?></p>

        <p><a class="btn btn-lg btn-success" href="/notetaking/table"><?=Html::encode(Module::t('notetaking','Go to notes'))?></a></p>
    </div>
    <div class="sub_div" style=" position: absolute; bottom: 50px; ">  
                <p><?=Html::encode(MemberCountWidget::widget())?></p> 
            </div> 
</div>
