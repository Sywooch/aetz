<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Text */

$this->title = Yii::t('app', 'Update Texts'). ': ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Texts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="text-update">

    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>

</div>
