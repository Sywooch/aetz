<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Виджеты';

$this->params['breadcrumbs'][] = 'Виджеты';
$this->registerMetaTag(['name'=> 'keywords', 'content' =>  '']);
$this->registerMetaTag(['name'=> 'description', 'content' => '']);

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?= \yii\widgets\Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h4>Carousel</h4>
            <?= \frontend\widgets\SliderWidget::widget() ?>
        </div>
    </div>
</div>