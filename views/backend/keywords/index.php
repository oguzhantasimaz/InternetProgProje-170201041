<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kouosl\notetaking\components\MemberCountWidget;

$this->title = 'Notetaking Keywords';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notetaking-keywords-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Notetaking Keywords', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'content',
            'key',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
   
</div>
