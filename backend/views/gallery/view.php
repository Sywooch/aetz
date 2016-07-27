<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <ul class="action-button-list">
        <li>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> '.Yii::t('app', 'Gallery List'), ['index'], ['class' => 'btn btn-default']) ?>
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
            'title',
            'category_id',
            [
                'attribute'=>'photo',
                'value'=>$model->image,
                'format' => ['image',['width'=>'100','height'=>'75']],
            ],
            'anounce:ntext',
//            'description:ntext',
            'created:datetime',
            'updated:datetime',
            'is_published',
            'meta_keywords:ntext',
            'meta_description:ntext',
            'slug',
            'created_user_id',
            'updated_user_id',
            'sort_index',
        ],
    ]) ?>

</div>
