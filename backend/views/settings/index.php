<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Create Settings'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'key',
            'value',
            'comment',
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
