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
            <h3><?= $model->title ?></h3>
            <?php $anounce = strip_tags($model->anounce, '<a>'); echo mb_substr($anounce,0, 200, 'UTF-8').' ...'; ?>
            <p>
                <div class="btn btn-default" ><?= Yii::$app->formatter->asDate($model->created, 'dd.MM.yyyy') ?></div>
                <a href="<?= Url::toRoute(['/article/view', 'slug' => $model->slug]) ?>" class="btn btn-primary">Подробнее</a>
            </p>
        </div>
    </div>
</div>


