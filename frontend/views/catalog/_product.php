<?php

use yii\helpers\Html;
use yii\helpers\Markdown;
use \yii\helpers\Url;
?>
<?php /** @var $model \common\models\Product */ ?>
<div class="col-xs-3 col-sm-4 col-md-4 res">
    <div class="product-item" itemscope itemtype="http://schema.org/Product">
          <!--<img src="<?/*= $model->image */?>" alt="" class="img-rounded"/>-->
            <?= Html::a('', [ 'cart/add', 'id' => $model->id], ['class' => 'btn btn-default product-cart']) ?>
        <?php if($model->is_action){ ?>
            <div class="stiker">-<?=$model->is_action?>%</div>
        <?php } ?>
        <a itemprop="url" href="<?= Url::toRoute(['/product/index', 'slug' => $model->slug]) ?>">
        <?php
        echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
            $model->imagePath, 175, 117, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
            [
                'class' => 'img-responsive',
                'itemprop' => 'image'
            ]
        );
        ?>
            <div itemprop="name" class="product-title"><?= Html::encode($model->title) ?></div></a>
            <?php $anounce = strip_tags($model->short_description, '<p><a>'); (strlen($anounce) > 50 ) ? $readmore = ' ...' : $readmore = ''?>
            <div itemprop="description" class="product-desc"><?php $anounce = strip_tags($model->short_description, '<p><a>'); echo mb_substr($anounce,0, 50, 'UTF-8').$readmore; ?></div>
            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <meta itemprop="acceptedPaymentMethod" content="CreditCard" />
                <meta itemprop="priceCurrency" content="KZT" />
                <div class="product-price"><span itemprop="price"><?= (int)$model->price; ?></span> тг.</div>
            </div>
    </div>
</div>