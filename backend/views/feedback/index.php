<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Feedbacks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email',
            'phone',
            'subject',
            // 'body:ntext',
            // 'manager_email:email',
            [
                'attribute' => 'status',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Статус',
                'value' => function ($data) {
                    return ($data->status) ? Yii::$app->params['feedbackStatus'][$data->status] : '';
                },
                'filter' => Yii::$app->params['feedbackStatus']
            ],
            // 'created',
            // 'updated',
            // 'updated_user_id',

            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
