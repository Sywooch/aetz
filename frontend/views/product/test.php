<?php

use himiklab\thumbnail\EasyThumbnailImage;
use \yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\widgets\ShareLinks;
use kartik\rating\StarRating;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
$this->title = $model->title.' - в Шымкенте "Vаниль"';
$this->params['breadcrumbs'][] = [
    'label' => $category->title,
    'url' => ['catalog/index'],
    'template' => "<li>{link}</li>\n", // template for this link only
];
$this->params['breadcrumbs'][] = $model->title;
$this->registerMetaTag(['name'=> 'description', 'content' => Yii::t('meta', $model->meta_description)]);
?>

<div class="def-border"></div>
<div class="breadcrumbs"><?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?></div>
<h1><?= $model->title; ?></h1>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
            <div id="products_example">
                <div id="products">
                    <div class="slides_container">
                        <a class="fancybox" rel="gallery1" href="<?= $model->image; ?>"><img src="<?= $model->image; ?>" alt=""/></a>
                        <?php if (count($image_id) > 0) { ?>
                            <?php foreach ($image_id as $images) { ?>
                                <a class="fancybox" rel="gallery1" href="<?= $images->image; ?>" ><img src="<?= $images->image; ?>"  alt=""></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <ul class="pagination">
                        <li><a href=""><img src="<?= $model->image; ?>" width="60" height="50" alt=""></a></li>
                        <?php if (count($image_id) > 0) { ?>
                            <?php foreach ($image_id as $images) { ?>
                                <li>
                                    <a href="">
                                        <img src="<?= $images->image; ?>" width="60" height="50" alt="">
                                    </a>
                                </li>
                            <?php } ?>
                         <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
            <div class="product-desc-title">описание товара</div>
            <div class="product-description"><?= $model->short_description; ?></div>
            <div class="product-description"><?= $model->full_description; ?></div>
            <span class="price"><?= (int)$model->price; ?> тг.</span>
            <?php if($model->feature){ ?>
            <div class="product-weight">Вес - <span><?= $model->feature; ?> кг.</span></div>
            <?php } ?>
            <div class="product-rating">
            </div>
            <?= ShareLinks::widget(); ?>

            <a class="btn btn-default cart"
               href="<?= Url::toRoute(['cart/add', 'id' => $model->id]) ?>">в корзину</a>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-6 col-lg-2">
            <div class="pr-border"></div>
            <div class="product-info">
                <div class="product-info-title">Оплата и доставка</div>
                <div class="product-info-pay">
                    <div class="product-info-desc">Легкая оплата с помощью банковской карты или терминалов</div>
                </div>
                <div class="product-info-delivery">
                    <div class="product-info-desc">Доставка в течение 1-3 дней с момента заказа</div>
                </div>
                <div class="product-info-title">Гарантия качества</div>
                <div class="product-info-guarantee">
                    <div class="product-info-desc">Мы готовим только из натуральных продуктов</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="product-category">похожие товары </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($product as $products) { ?>
        <div class="col-xs-3 col-sm-4 col-md-4 res">
            <div class="product-item" itemscope itemtype="http://schema.org/Product">
                <a class="btn btn-default product-cart" href="<?= Url::toRoute(['cart/add', 'id' => $products->id]) ?>"></a>
                <?php if($products->is_action){ ?>
                    <div class="stiker">-<?=$products->is_action?>%</div>
                <?php } ?>
                <a itemprop="url" href="<?= Url::toRoute(['/product/index', 'slug' => $products->slug]) ?>">
                <?php
                echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                    $products->imagePath, 175, 117, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                    [
                        'class' => 'img-responsive',
                        'itemprop' => 'image'
                    ]
                );
                ?>
                <div itemprop="name" class="product-title"><?= $products->title; ?></div></a>
                <div itemprop="description" class="product-desc"><?php $anounce = strip_tags($products->short_description, '<p><a>'); echo mb_substr($anounce,0, 50, 'UTF-8').' ...'; ?></div>
                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <meta itemprop="acceptedPaymentMethod" content="CreditCard" />
                    <meta itemprop="priceCurrency" content="KZT" />
                    <div class="product-price"><span itemprop="price"><?= (int)$products->price; ?></span> тг.</div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
            <?= \frontend\widgets\Reviews::widget(['model' => $model]) ?>
        </div>
    </div>
</div>