<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-th-list"></span> '.Yii::t('app', 'Categories'), ['category/index', 'model_name' => 'product'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img($data->image,['width'=>50]);
                },
            ],
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return empty($model->category_id) ? '-' : $model->category->title;
                },
            ],
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
            // 'description:ntext',
            // 'meta_title',
            // 'meta_keywords',
            // 'meta_description',
            // 'is_published',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
