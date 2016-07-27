<?php

use himiklab\thumbnail\EasyThumbnailImage;
use \yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
$this->title = 'Кондитерская - в Шымкенте "Vаниль"';
$this->params['breadcrumbs'][] = ['label' => 'Кондитерская', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = $category->title;
$this->registerMetaTag(['name'=> 'description', 'content' => $category->meta_description]);
?>
<div class="def-border"></div>
<div class="breadcrumbs"><?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?></div>
<h1></h1>
<div class="container">
    <div class="row catalog-items">
        <?php foreach($products as $product){ ?>
            <div class="col-xs-3 col-sm-4 col-md-4 res">
                <div class="product-item" itemscope itemtype="http://schema.org/Product">
                    <?= Html::a('', [ 'cart/add', 'id' => $product->id], ['class' => 'btn btn-default product-cart']) ?>
                    <?php if($product->is_action){ ?>
                        <div class="stiker">-<?=$product->is_action?>%</div>
                    <?php } ?>
                    <a itemprop="url" href="<?= Url::toRoute(['/product/index', 'slug' => $product->slug]) ?>">
                    <?php
                    echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                        $product->imagePath, 175, 117, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                        [
                            'class' => 'img-responsive',
                            'itemprop' => 'image'
                        ]
                    );
                    ?>
                    <div itemprop="name" class="product-title"><?= $product->title?></div></a>
                    <?php $anounce = strip_tags($product->short_description, '<p><a>'); (strlen($anounce) > 50 ) ? $readmore = ' ...' : $readmore = ''?>
                    <div itemprop="description" class="product-desc"><?php $anounce = strip_tags($product->short_description, '<p><a>'); echo mb_substr($anounce,0, 50, 'UTF-8').$readmore; ?></div>
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="acceptedPaymentMethod" content="CreditCard" />
                        <meta itemprop="priceCurrency" content="KZT" />
                        <div class="product-price"><span itemprop="price"><?= (int)$products->price; ?></span> тг.</div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>