<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\search\UserSearch $searchModel
 */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Create {modelClass}', [
          'modelClass' => Yii::t('app', 'User'),
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'firstname',
            'lastname',
            //'secondname',
//            'phone',
            // 'city_id',
//            'birthday:date',
            // 'image',
            // 'about:ntext',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email',
            [
                'attribute' => 'role',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Роль',
                'value' => function ($data) {
                    return Yii::$app->params['user_roles'][$data->role];
                },
                'filter' => Yii::$app->params['user_roles']
            ],
            [
                'attribute' => 'status',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Статус',
                'value' => function ($data) {
                    return Yii::$app->params['userStatus'][$data->status];
                },
                'filter' => Yii::$app->params['userStatus']
            ],
            // 'status',
            // 'created',
            // 'updated',
            // 'deleted',
            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
