<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\quick\models\Questions;
use yii\helpers\ArrayHelper;//для списков массивов map ниже
//$form->field($model, 'post_id')->dropDownList(ArrayHelper::map($posts, 'id', 'title')); для получения массива

/* @var $this yii\web\View */
/* @var $model app\modules\quick\models\Answers */
/* @var $form yii\widgets\ActiveForm */

$questions = Questions::find()->all();
?>

<div class="answers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_id')->dropDownList(ArrayHelper::map($questions, 'id', 'text')); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correct_answer_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
