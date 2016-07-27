<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = Yii::t('app', 'Update Gallery') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
        'image_tab' => $image_tab,
    ]) ?>

    <?php Modal::begin([
        'id' => 'updateImageTitleModal',
        'header' => 'Название изображении',
        'size' => 'modal-md',
    ]); ?>

    <div class='modalContent'></div>

    <?php Modal::end(); ?>
</div>
