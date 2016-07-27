<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('banner', 'Баннеры');



$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '{modelClass}', [
            'modelClass' => Yii::t('banner', 'Добавить баннер'),
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'type_id',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Тип баннера',
                'value' => function ($data) {
                    return Yii::$app->params['typeBanner'][$data->type_id];
                },
                'filter' => Yii::$app->params['typeBanner']
            ],
            [
                'attribute' => 'photo',
                'label' => 'Изображения',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img($data->image,['width'=>100]);
                },
            ],
            'link',
            [
                'attribute' => 'is_published',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Опубликован',
                'value' => function ($data) {
                    return Yii::$app->params['publishStatus'][$data->is_published];
                },
                'filter' => Yii::$app->params['publishStatus']
            ],
            //'sort_index',
            // 'created',
            // 'updated',
            // 'deleted',

            [   'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>