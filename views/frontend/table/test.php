<?php
use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use kouosl\notetaking\Module;
use kouosl\notetaking\components\MemberCountWidget;

use kouosl\notetaking\models\NotetakingNotesSearch;
$this->title = Module::t('notetaking', 'Public Notes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notetaking-notes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
      $searchModel = new NotetakingNotesSearch();
      $dataProvider = $searchModel->search2(Yii::$app->request->queryParams);
    ?>
<?php 
// GridView::widget([
//     'dataProvider' => $dataProvider,
//     'columns' => [
//         ['class' => 'yii\grid\SerialColumn'],
//         [
//             'attribute' => 'user_id',
//             'label' => Module::t('notetaking', 'User ID'),
//             'encodeLabel' => false,
// ],
//         [
//             'attribute' => 'title',
//             'label' => Module::t('notetaking', 'Title'),
//             'encodeLabel' => false,
// ],
// [
// 'attribute' => 'content',
// 'label' => Module::t('notetaking', 'Note'),
// 'encodeLabel' => false,
// ],
// ],
// ]); 
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_post',
]);
?>
    <div class="sub_div" style=" position:absolute; bottom: 25px;  ">  
                <p><?=Html::encode(MemberCountWidget::widget())?></p> 
            </div> 
</div>
