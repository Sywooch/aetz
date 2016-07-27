<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Category;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Create Category'), ['category/create', 'model_name' => $model_name], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            [
//                'attribute' => 'photo',
//                'format' => 'html',
//                'value' => function($data) {
//                    return Html::img($data->image,['width'=>50]);
//                },
//            ],
            [
                'attribute' => 'parent_id',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Родительская категория',
                'value' => function ($data) {
                    return ($data->category) ? $data->category->title : '-';
                },
                'filter' => ArrayHelper::map(Category::find()->where(['model_name' => $model_name])->all(), 'id', 'title')
            ],
            'title',
//            'description:ntext',
            //'photo',
            // 'status',
            // 'created',
            // 'updated',
//            'is_published',
//            'created:datetime',
            [
                'attribute' => 'is_published',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Опубликован',
                'value' => function ($data) {
                    return Yii::$app->params['published'][$data->is_published];
                },
                'filter' => Yii::$app->params['published']
            ],
            // 'meta_keywords:ntext',
            // 'meta_description:ntext',
            // 'slug',
//            [
//                'header' => 'Действия',
//                'class' => 'yii\grid\ActionColumn'
//            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil" ></span>',
                            Url::toRoute(['category/update', 'id' => $model->id, 'model_name' => $model->model_name]));
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            Url::toRoute(['category/view', 'id' => $model->id, 'model_name' => $model->model_name]));
                    }

                ],
            ],
        ],
    ]); ?>

</div>
