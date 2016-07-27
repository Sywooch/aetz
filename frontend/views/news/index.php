<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $this yii\web\View */
$this->title = 'Новости || АЭТЗ - Астанинский электротехнический завод';

$this->params['breadcrumbs'][] = 'Новости';
$this->registerMetaTag(['name'=> 'keywords', 'content' =>  '']);
$this->registerMetaTag(['name'=> 'description', 'content' => '']);

?>
<main role="main">
    <div class="bread_part">
        <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
    <div class="cr">
        <ul class="news_ul">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'layout' => "{items}\n<div class='clearfix'></div>{pager}",
            ]) ?>
        </ul>
    </div>
</main>