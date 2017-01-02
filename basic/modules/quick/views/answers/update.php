<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\quick\models\Answers */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Answers',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Answers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="answers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
