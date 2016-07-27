<?php


/* @var $this yii\web\View */
/* @var $model common\models\Example */

$this->title = Yii::t('app', 'Create Category');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category'), 'url' => ['index', 'model_name' => $model_name]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="example-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_name' => $model_name,
        'categories' => $categories,
    ]) ?>

</div>
