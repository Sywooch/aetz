<?php


/* @var $this yii\web\View */
/* @var $model common\models\Example */

$this->title = Yii::t('app', 'Create Slide');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="example-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
