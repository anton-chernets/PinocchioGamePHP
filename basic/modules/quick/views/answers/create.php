<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\quick\models\Answers */

$this->title = Yii::t('app', 'Create Answers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Answers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
