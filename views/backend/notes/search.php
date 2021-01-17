<?php

use yii\helpers\Html;
use kouosl\notetaking\Module;
use yii\grid\GridView;
use kouosl\notetaking\components\SearchWidget;  
use kouosl\notetaking\models\User;
use kouosl\notetaking\components\MemberCountWidget;
use kouosl\notetaking\models\NotetakingKeywords;
use kouosl\notetaking\models\NotetakingKeywordsSearch;
$searchModel = new NotetakingKeywordsSearch();
$dataProvider = $searchModel->search3(Yii::$app->request->queryParams,$model->id);
$this->title =  Module::t('notetaking', 'Search');
$this->params['breadcrumbs'][] = ['label'=>Module::t('notetaking', 'Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notetaking-notes-create">

    <h1><?= Html::encode($this->title)
    
    
    ?></h1>
 
<?=GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'columns' => [
      ['class' => 'yii\grid\SerialColumn'],
      [
          'attribute' => 'key',
          'label' => Module::t('notetaking', 'Keyword'),
          'encodeLabel' => false,
],
[
    'attribute' => 'title',
    'label' => Module::t('notetaking', 'Note Title'),
    'encodeLabel' => false,
],
[
    'attribute' => 'not_id',
    'visible'=>'0',
],


      ['class' => 'yii\grid\ActionColumn',
      'template' => '{view2}',
      'buttons' => [
          'view2' => function ($url, $model,$key) {     
           
              return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['view','id' => $model['not_id'],'user_id'=>$model['user_id']], [

                  'title' => Module::t('notetaking', 'Edit Note'),

              ]);                                

          }
      ]
  ],
]
]);
?>

 
    <div class="sub_div" style=" position: absolute; bottom: 50px; ">  
                <p><?=Html::encode(MemberCountWidget::widget())?></p> 
            </div> 
</div>
