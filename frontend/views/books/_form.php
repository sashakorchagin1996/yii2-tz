<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model frontend\models\Books */
/* @var $form yii\widgets\ActiveForm */
$autors = \frontend\models\Autor::find()->all();
$autors_list = ArrayHelper::map($autors, 'id', 'name');
$genres = \frontend\models\Genre::find()->all();
$genres_list = ArrayHelper::map($genres, 'id', 'name');

?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'autor_id')->textInput() ?>
    <?= $form->field($model, 'autor_id')->widget(Select2::classname(), [
        'data' => $autors_list,
//        'language' => 'de',
        'options' => ['placeholder' => 'выбор автора ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'edition')->textInput() ?>

    <?= $form->field($model, 'genre_id')->widget(Select2::classname(), [
        'data' => $genres_list,
//        'language' => 'de',
        'options' => ['placeholder' => 'выбор автора ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
<!--    --><?//= $form->field($model, 'genre_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
