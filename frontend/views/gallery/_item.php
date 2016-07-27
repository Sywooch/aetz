<?php
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;
?>

<div class="col-xs-12 col-sm-4 col-md-3">
    <div class="thumbnail">
        <?=
        EasyThumbnailImage::thumbnailImg(
            $model->imagePath,
            400,
            300,
            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
            [
                'alt' => $model->title,
                'class' => 'img-responsive'
            ]
        );
        ?>
        <div class="caption">
            <a href="<?= Url::toRoute(['/gallery/view', 'slug' => $model->slug]) ?>">
                <h3><?= $model->title ?></h3>
            </a>

        </div>
    </div>
</div>


