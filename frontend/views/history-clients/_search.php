<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\HistoryClientsSearch */
/* @var $form yii\widgets\ActiveForm */
// получаем данные для поле поиска и добавим на widget select2 kartik 
// получаем список клиентов
$users = new \frontend\models\User();
$users = $users->getClients();
$users_list = ArrayHelper::map($users, 'id', 'username');

// получаем список клиентов
$books = \frontend\models\Books::find()->all();
$books_list = ArrayHelper::map($books, 'id', 'name');

// получаем список авторов
$autor = \frontend\models\Autor::find()->all();
$autor_list = ArrayHelper::map($autor, 'id', 'name');
$status = [
    '1' => 'вернул',
    '0' => 'не вернул'
];
?>

<div class="history-clients-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <table class="table table-bordred">
        <tr>
            <td style="width: 100px">    <?= $form->field($model, 'id') ?>
            </td>
            <td style="width: 150px">
                <?= $form->field($model, 'id_client')->widget(Select2::classname(), [
                    'data' => $users_list,
//        'language' => 'de',
                    'options' => ['placeholder' => 'выбор пользователя ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </td>
            <td style="width: 150px">
                <?= $form->field($model, 'id_book')->widget(Select2::classname(), [
                    'data' => $books_list,
//        'language' => 'de',
                    'options' => ['placeholder' => 'выбор книгу ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </td>
            <td style="width: 150px">
                <?= $form->field($model, 'autor_name')->widget(Select2::classname(), [
                    'data' => $autor_list,
                    'options' => ['placeholder' => 'выбор книгу ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </td>

            <td style="width: 100px">
                <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>
            </td>
            <td style="width: 100px">
                <?= $form->field($model, 'date_end')->textInput(['type' => 'date']) ?>

            </td>
            <td style="width: 150px">
                <?= $form->field($model, 'status_book')->widget(Select2::classname(), [
                    'data' => $status,
                    'options' => ['placeholder' => 'выбор книгу ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </td>
            <td>
                <div class="form-group">
                    <br>
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
                </div>
            </td>
        </tr>
    </table>


    <?php ActiveForm::end(); ?>

</div>
