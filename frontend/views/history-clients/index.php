<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\HistoryClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-clients-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Take book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_name',
            'book_name',
            'autor_name',
            'date',
            'date_end',
            'date_end',
            [
                'attribute' => 'Come Back book',
                'format' => 'raw',
                'value' => function ($data) {
//                    return '<a href="" class="" id="event" >Вернул</a>';
                    return Html::a('Отметит как вернул', '/history-clients/back-book?id=' . $data->id, ['class' => 'btn btn-success btn-xs'])
                    . ' ' . Html::a('отмена', '/history-clients/noback-book?id=' . $data->id, ['class' => 'btn btn-danger btn-xs']);

                },

            ],
            [
                'attribute' => 'status_book',
                'format' => 'raw',
                'value' => function ($data) {

                    if ($data->status_book == 1) {
                        return Html::button('вернул', ['class' => 'btn btn-success btn-xs']);
                    } else {
                        return Html::button('не вернул', ['class' => 'btn btn-danger btn-xs']);
                    }
                },

            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
