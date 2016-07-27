<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gallery');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Create Gallery'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-th-list"></span> '.Yii::t('app', 'Categories'), ['category/index', 'model_name' => 'gallery'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img($data->image,['width'=>50]);
                },
            ],
            'title',
            'anounce:ntext',
//            'description:ntext',
            //'photo',
            // 'status',
            // 'created',
            // 'updated',
//            'is_published',
            'created:datetime',
            [
                'attribute' => 'is_published',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Опубликован',
                'value' => function ($data) {
                    return ($data->is_published) ? Yii::$app->params['published'][$data->is_published] : '';
                },
                'filter' => Yii::$app->params['published']
            ],
            // 'meta_keywords:ntext',
            // 'meta_description:ntext',
            // 'slug',
            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
