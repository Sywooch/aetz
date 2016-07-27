<?php
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;
?>
<li>
    <div class="news_mini">
        <figure>
            <a href="<?= Url::toRoute(['/news/view', 'slug' => $model->slug]) ?>">
                <?=
                EasyThumbnailImage::thumbnailImg(
                    $model->imagePath,
                    280,
                    200,
                    EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                    [
                        'alt' => $model->title,
                        'class' => ''
                    ]
                );
                ?>
            </a>
        </figure>
        <div class="news_pad">
            <a class="heading" href="<?= Url::toRoute(['/news/view', 'slug' => $model->slug]) ?>"><?= $model->title ?></a>
            <p><?php $anounce = strip_tags($model->description, '<a>'); echo mb_substr($anounce,0, 200, 'UTF-8').' ...'; ?></p>
            <div class="ov">
                <span class="fl_l"><?= Yii::$app->formatter->asTime($model->created, 'H:i') ?></span>
                <span class="fl_r"><?= Yii::$app->formatter->asDate($model->created, 'dd.MM.yyyy') ?></span>
            </div>
        </div>
    </div>
</li>