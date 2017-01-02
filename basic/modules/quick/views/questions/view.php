<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\quick\models\Questions */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-view">

    <h1><?= Html::encode($this->title) ?></h1>
<div class="blockforimage">
    <ul class="imagesforquestion">
        <?php foreach ($model->images as $img) : ?>
            <li>
                <?= Html::img(Url::to($img->url), ['style' => 'width: 250px;']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'text',
            'category_id',
            'image_url:url',
            'priority',
        ],
    ]) ?>

    <ul>
        <?php foreach ($model->answers as $answer) : ?>
            <li>
                <a style="cursor: pointer;"><?= $answer->text ?></a>
            </li>
        <?php endforeach; ?>
    </ul>

</div>
