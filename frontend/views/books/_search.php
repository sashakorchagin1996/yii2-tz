<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
$autor = \frontend\models\Autor::find()->all();
$autor_list = ArrayHelper::map($autor, 'id', 'name');
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <table class="table table-bordred">
        <tr>
            <td style="width: 100px">
                <?= $form->field($model, 'id') ?>
            </td>
            <td>
                <?= $form->field($model, 'name') ?>
            </td>
           
            <td style="width: 150px">
                <?= $form->field($model, 'autor_id')->widget(Select2::classname(), [
                    'data' => $autor_list,
                    'options' => ['placeholder' => 'выбор автора ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </td>
            <td>
                <?= $form->field($model, 'edition') ?>
            </td>
            <td>
                <?= $form->field($model, 'genre_id') ?>
            </td>

        </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
