<?php


/* @var $this yii\web\View */
/* @var $model common\models\Example */

$this->title = Yii::t('app', 'Create Example');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Example'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="example-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
