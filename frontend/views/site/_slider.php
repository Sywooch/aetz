<?php
/**
 * Created by PhpStorm.
 * User: Astana Creative
 * Date: 13.07.2016
 * Time: 17:38
 */
use yii\helpers\Url;
?>

<div class="slider">
    <div class="single-item">
        <?php $i=0; foreach($slides as $slide) {?>
        <div>
            <?php
            echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                $slide->imagePath, 1600, 400, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                [
                    'class' => ''
                ]
            );
            ?>
            <div class="slider_part">
                <div class="cr">
                    <div class="slider_text">
                        <h3><?= $slide->title ?></h3>
                        <p><?php $anounce = strip_tags($slide->anounce, '<a>'); echo mb_substr($anounce,0, 250, 'UTF-8').' ...'; ?></p>
                        <a href="<?= $slide->link ?>">Читать полностью</a>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; } ?>
    </div>
</div>
