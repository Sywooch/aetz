<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\widgets\HotDeals;
use frontend\widgets\BannerWidget;
use himiklab\thumbnail\EasyThumbnailImage;
use frontend\models\Filter;
use common\models\Category;
use frontend\models\Search;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Поиск');
use yii\widgets\ListView;
$this->registerLinkTag(['rel'=> 'canonical', 'href' =>  Url::toRoute(['/catalog/search'])]);
?>
<div class="def-border"></div>
<div class="breadcrumbs"><a href="/">главная</a> <span>--></span> <a href=""></a> поиск</div>
<h1>Поиск</h1>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'search-form',
                    'action' => Url::toRoute('/catalog/search'),
                    'method' => 'get',
                ]
            ); ?>

            <div class="row">
                <?= $form->field($searchModel, 'query',['inputOptions' => ['class' => 'form-control search-text']])->textInput(['placeholder' => 'Введите ключевое слово ','maxlength' => 75])->label(false) ?>

                <?= Html::submitButton('Найти', ['class' => 'btn btn-default send-commit pull-right', 'name' => 'search-button']) ?>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="row sale-item-wrap">
        <div class="row search-items">

            <?= ListView::widget([
                'dataProvider' => $productDataProvider,
                'itemView' => '/catalog/_product',
                'layout' => "{items}\n<div class='clearfix'></div><div class='wrap-page'><div class='col-xs-4 wrap-page-left'>{summary}</div><div class='col-xs-8 text-right'>{pager}</div><div class='clearfix'></div></div>",
                'emptyTextOptions' => ['class' => 'empty col-xs-12']
            ]) ?>
        </div>
    </div>
</div>
