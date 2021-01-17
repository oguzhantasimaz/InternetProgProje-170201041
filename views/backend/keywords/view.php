<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->not_id;
$this->params['breadcrumbs'][] = ['label' => 'Notetaking Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notetaking-keywords-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'not_id' => $model->not_id, 'key' => $model->key], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'not_id' => $model->not_id, 'key' => $model->key], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'not_id',
            'key',
        ],
    ]) ?>

</div>
