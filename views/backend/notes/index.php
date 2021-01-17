<?php
use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use kouosl\notetaking\Module;
use kouosl\notetaking\components\MemberCountWidget;
//
$this->title = Module::t('notetaking', 'Notes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notetaking-notes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('notetaking', 'Create Note'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Module::t('notetaking', 'Search'), ['search'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    
    
    if (Yii::$app->user->can('seeAllNotes')) {
        echo
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'user_id',
                    'label' => Module::t('notetaking', 'User ID'),
                    'encodeLabel' => false,
       ],
                [
                    'attribute' => 'title',
                    'label' => Module::t('notetaking', 'Title'),
                    'encodeLabel' => false,
       ],
       [
        'attribute' => 'content',
        'label' => Module::t('notetaking', 'Note'),
        'encodeLabel' => false,
    ],
    
                ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {addkey}',
                'buttons' => [
                    'addkey' => function ($url, $model) {     
    
                        return Html::a('<span class="glyphicon glyphicon-tag"></span>', $url, [
    
                            'title' => Module::t('notetaking', 'Keywords'),
    
                        ]);                                
    
                    }
                ]
            ],
        ]
        ]);
    }else{
    echo
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'title',
                'label' => Module::t('notetaking', 'Title'),
                'encodeLabel' => false,
   ],
   [
    'attribute' => 'content',
    'label' => Module::t('notetaking', 'Note'),
    'encodeLabel' => false,
],

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {addkey}',
            'buttons' => [
                'addkey' => function ($url, $model) {     

                    return Html::a('<span class="glyphicon glyphicon-tag"></span>', $url, [

                        'title' => Module::t('notetaking', 'Keywords'),

                    ]);                                

                }
            ]
        ],
    ]
    ]);
    
    } ?>

    <div class="sub_div" style=" position: absolute; bottom: 50px; ">  
                <p><?=Html::encode(MemberCountWidget::widget())?></p> 
            </div> 
</div>
