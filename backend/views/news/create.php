<?php


/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = Yii::t('app', 'Create News');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

    <?= $this->render('_form', [
        'model' => $model,
        'image_tab' => $image_tab,
    ]) ?>

</div>
