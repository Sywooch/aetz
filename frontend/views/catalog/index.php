<?php

use himiklab\thumbnail\EasyThumbnailImage;
use \yii\helpers\Url;
use yii\helpers\Html;
use \yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
$this->title = 'Каталог || АЭТЗ - Астанинский электротехнический завод';
$this->params['breadcrumbs'][] = 'Каталог';
$this->registerMetaTag(['name'=> 'description', 'content' => '']);
?>
<main role="main">
    <div class="bread_part">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
    <div class="cr">
        <?php foreach($categories as $category ) {  ?>
        <div class="h_heading">
            <h2><?= $category->title?></h2>
        </div>
        <ul class="katalog_ul">
            <?php foreach($category->products as $product){ ?>
            <li>
                <a class="wrap_katalog" href="<?= Url::toRoute(['product/index', 'slug' => $product->slug]) ?>">
                    <figure>
                        <?=
                        EasyThumbnailImage::thumbnailImg(
                            $product->imagePath,
                            280,
                            200,
                            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                            [
                                'alt' => $product->title,
                                'class' => ''
                            ]
                        );
                        ?>
                    </figure>
                    <span><?= $product->title?></span>
                </a>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
    </div>
</main>
