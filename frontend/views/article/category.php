<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name'=> 'keywords', 'content' =>  '']);
$this->registerMetaTag(['name'=> 'description', 'content' => '']);
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="breadcrumbs"><?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                <?= $currentCategory->title; ?>
            </h1>
            <div class="catalog-desc">
                <!--            --><?//= ($currentCategory)? $currentCategory->description : ''?>
            </div>
        </div>
    </div>
    <div class="row">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
            'layout' => "{items}\n<div class='clearfix'></div><div class='wrap-page'><div class='col-xs-8 text-right'>{pager}</div><div class='clearfix'></div></div>",
            'emptyTextOptions' => ['class' => 'empty col-xs-12']
        ]) ?>
    </div>
</div>