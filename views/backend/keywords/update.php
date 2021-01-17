<?php

use yii\helpers\Html;


$this->title = 'Update Notetaking Keywords: ' . $model->not_id;
$this->params['breadcrumbs'][] = ['label' => 'Notetaking Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->not_id, 'url' => ['view', 'not_id' => $model->not_id, 'key' => $model->key]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notetaking-keywords-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
