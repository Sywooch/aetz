<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => Yii::t('banner', 'Banner'),
]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="banner-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>