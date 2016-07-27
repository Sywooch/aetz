<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Review */

$this->title = Yii::t('app', 'Review').': '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-view">

    <ul class="action-button-list">
        <li>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> '.Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-default']) ?>
        </li>

        <li class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-trash"></span> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </li>
        <li class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> '.Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </li>
        <li class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Add New'), ['create'], ['class' => 'btn btn-success']) ?>
        </li>
    </ul>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'model_name',
            'model_id',
            'rating',
            'is_published',
            'review:ntext',
            'created:datetime',
            'updated:datetime',
        ],
    ]) ?>

</div>
