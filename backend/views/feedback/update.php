<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Feedback */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Feedback'),
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="feedback-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
