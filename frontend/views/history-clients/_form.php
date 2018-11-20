<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\HistoryClients */
/* @var $form yii\widgets\ActiveForm */

// получаем список клиентов
$users = new \frontend\models\User();
$users = $users->getClients();
$users_list = ArrayHelper::map($users, 'id', 'username');

// получаем список книг
$books = \frontend\models\Books::find()->all();
$books_list = ArrayHelper::map($books, 'id', 'name');
?>

<div class="history-clients-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--    // передаем список клиентов на widget  -->
    <?= $form->field($model, 'id_client')->widget(Select2::classname(), [
        'data' => $users_list,
//        'language' => 'de',
        'options' => ['placeholder' => 'выбор пользователя ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

<!--    // передаем список книг на widget  -->
    <?= $form->field($model, 'id_book')->widget(Select2::classname(), [
        'data' => $books_list,
//        'language' => 'de',
        'options' => ['placeholder' => 'выбор книгу ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'date_end')->textInput(['type' => 'date']) ?>
    <?= $form->field($model, 'status_book')->textInput(['value' => 1, 'class' => 'hidden']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
