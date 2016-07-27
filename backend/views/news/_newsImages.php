<?php

use yii\helpers\Html;
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<?php foreach($images as $image) { ?>

    <div class="col-xs-6 col-md-3">

        <div class="box box-warning">

            <div class="box-header with-border">
                <h6 class="box-title"><?= $image->title ?></h6>
                <div class="box-tools pull-right img-control">

                    <?= Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        ['#'],
                        ['data-target' => '#updateImageTitleModal',
                            'class' => 'js-popup',
                            'data-url' => Url::toRoute(['/news/update-image-title', 'image_id' => $image->id])
                        ]
                    ) ?>

                    <a href="<?= Url::toRoute(['/news/image-delete', 'id' => $image->id]) ?>"><span class="glyphicon glyphicon-trash"></span></a>

                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->

            <div class="box-body" style="display: block;">
                <?php
                echo EasyThumbnailImage::thumbnailImg(
                    $image->imagePath,
                    200,
                    150,
                    EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                    [
                        'class' => 'img-responsive'
                    ]
                );
                ?>
            </div><!-- /.box-body -->
        </div>

    </div>

<?php } ?>
