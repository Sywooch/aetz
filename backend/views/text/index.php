<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TextSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Texts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-index">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Create Text'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'key',
            'value',
//            'created',
            // 'updated',
            // 'created_user_id',
            // 'updated_user_id',

            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
