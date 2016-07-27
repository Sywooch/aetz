<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\widgets\BannerWidget;
use himiklab\thumbnail\EasyThumbnailImage;
use frontend\models\Filter;
use frontend\widgets\Hotdeals;
use yii\widgets\ListView;

/* @var $this yii\web\View */
$this->title = 'Кондитерский дом "Ваниль"';
?>
<div class="def-border"></div>
<div class="breadcrumbs"><a href="">главная</a> <span>--></span> <a href="">кондитерская</a></div>
<h1>кондитерская</h1>
<div class="container">
    <div class="row">
        <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_product',
            'layout' => "{items}\n<div class='clearfix'></div><div class='col-xs-12'><div class='wrap-page'><div class='col-xs-4 wrap-page-left'>{summary}</div><div class='col-xs-8 text-right'>{pager}</div><div class='clearfix'></div></div></div>",
            'emptyTextOptions' => ['class' => 'empty col-xs-12']
        ])
        ?>
    </div>

</div>