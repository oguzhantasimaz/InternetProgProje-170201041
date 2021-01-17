<?php

use yii\helpers\Html;


$this->title = 'Create Notetaking Keywords';
$this->params['breadcrumbs'][] = ['label' => 'Notetaking Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notetaking-keywords-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
