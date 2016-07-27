<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Text */

$this->title = Yii::t('app', 'Create Text');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Texts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
