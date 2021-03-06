<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\HistoryClients */

$this->title = 'Update History Clients: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'History Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="history-clients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
