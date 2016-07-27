<?php
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

/**
 * <?= $this->render('_gallery', [
'model' => $model
]) ?>
 */
?>

<div class="row">
    <div class="col-xs-12">

        <?php foreach($model->images as $images) {?>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="row">

                    <?php
                    echo newerton\fancybox\FancyBox::widget([
                        'target' => 'a.fancybox',
                        'helpers' => true,
                        'mouse' => true,
                        'config' => [
                            'maxWidth' => '90%',
                            'maxHeight' => '90%',
                            'playSpeed' => 3000,
                            'padding' => 0,
                            'fitToView' => false,
                            // 'width' => '70%',
                            // 'height' => '70%',
                            // 'autoSize' => false,
                            'closeClick' => false,
//                            'openEffect' => 'elastic',
//                            'closeEffect' => 'elastic',
//                            'prevEffect' => 'elastic',
//                            'nextEffect' => 'elastic',
                            'closeBtn' => false,
                            'openOpacity' => true,
                            'helpers' => [
                                'title' => ['type' => 'float'],
                                'buttons' => [],
                                'thumbs' => ['width' => 68, 'height' => 50],
                                'overlay' => [
                                    'css' => [
                                        'background' => 'rgba(0, 0, 0, 0.8)'
                                    ]
                                ]
                            ],
                        ]
                    ]);
                    echo Html::a(
                        EasyThumbnailImage::thumbnailImg(
                            $images->imagePath,
                            150,
                            150,
                            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                            [
                                'class' => 'img-responsive'
                            ]
                        ),
                        $images->image, ['rel' => 'group', 'class' => 'fancybox']);
                    ?>

                </div>
            </div>
        <?php }?>

    </div>
</div>