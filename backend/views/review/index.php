<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'model_id',
            'review:ntext',
            'created:datetime',
            [
                'attribute' => 'is_published',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Опубликован',
                'value' => function ($data) {
                    return Yii::$app->params['published'][$data->is_published];
                },
                'filter' => Yii::$app->params['published']
            ],
            // 'created',
            // 'updated',

            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
