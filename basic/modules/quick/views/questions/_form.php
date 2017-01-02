<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\quick\models\Images;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\quick\models\Questions */
/* @var $form yii\widgets\ActiveForm */
/* @var $images Images[] */

$images = Images::find()->all();
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <ul>
        <?php foreach ($images as $img) : ?>

                <?= Html::input('radio', 'images[]', $img->id); ?><!--вместо radio checkbox чтоб несколько-->
                <?= Html::img(Url::to($img->url), ['style' => 'width: 100px;']); ?>

        <?php endforeach; ?>
    </ul>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
