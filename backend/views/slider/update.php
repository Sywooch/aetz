<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Example */

$this->title = Yii::t('app', 'Update Slider') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="slider-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
