<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\HistoryClients */

$this->title = 'Create History Clients';
$this->params['breadcrumbs'][] = ['label' => 'History Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-clients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
