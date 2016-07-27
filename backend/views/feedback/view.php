<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Feedback */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view">

    <ul class="action-button-list">
        <li>
            <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span> '.Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-default']) ?>
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
    </ul>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email',
            'phone',
            'subject',
            'body:ntext',
            'manager_email',
            'status',
            'created:datetime',
            'updated:datetime',
            'updated_user_id',
        ],
    ]) ?>

</div>
