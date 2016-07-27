<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = Yii::t('app', 'Update Review') . ': ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('review', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="review-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
