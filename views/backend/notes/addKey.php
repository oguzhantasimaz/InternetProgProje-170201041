<?php

use yii\helpers\Html;
use kouosl\notetaking\Module;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kouosl\notetaking\models\NotetakingKeywords;
use kouosl\notetaking\models\NotetakingKeywordsSearch;
use kouosl\notetaking\components\MemberCountWidget;

$searchModel = new NotetakingKeywordsSearch();
$dataProvider = $searchModel->search4(Yii::$app->request->queryParams,$model->id);
$this->title = Module::t('notetaking', 'Keywords');
$this->params['breadcrumbs'][] = ['label' => Module::t('notetaking', 'Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) 
    
    ?></h1>

<div class="notetaking-notes-create">




    <?php $form = ActiveForm::begin([

            'action'=> ['addkey','id'=>$model->id,'user_id'=>$model->user_id]
           
    ]);
   
    
    $modelkey->not_id=$model->id;  


    ?>

<?= $form->field($modelkey, 'not_id')->hiddenInput()->label(false) ?>

<?= $form->field($modelkey, 'key')->textInput(['maxlength' => true])->label(Module::t('notetaking', 'New Keyword')) ?>

<div class="form-group">
    <?= Html::submitButton(Module::t('notetaking', 'Add'), ['class' => 'btn btn-success']); 
    
    ?>
    

</div>

<?php ActiveForm::end();

?>
<?php

echo GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'columns' => [
      ['class' => 'yii\grid\SerialColumn'],
      [
          'attribute' => 'key',
          'label' => Module::t('notetaking', 'Keyword'),
          'encodeLabel' => false,
],

      ['class' => 'yii\grid\ActionColumn',
      'template' => '{deletekey}',
      'buttons' => [
          'deletekey' => function ($url, $model) {     

              return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['deletekey','not_id' => $model['not_id'],'key' => $model['key'],'user_id'=>$model['user_id']], [

                  'title' => Module::t('notetaking', 'Delete Keyword'),

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
