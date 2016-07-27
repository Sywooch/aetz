<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */

$this->title = Yii::t('app', 'Update Settings'). ': ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="settings-update">

    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>

</div>
