<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\quick\models\Questions */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Questions',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="questions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
