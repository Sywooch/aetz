<?php
use himiklab\thumbnail\EasyThumbnailImage;
use frontend\widgets\ShareLinks;

/* @var $this yii\web\View */
$this->title = $model->title.' || АЭТЗ - Астанинский электротехнический завод';

$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/news']];
$this->params['breadcrumbs'][] = $model->title;

$this->registerMetaTag(['name'=> 'keywords', 'content' =>  $model->meta_keywords]);
$this->registerMetaTag(['name'=> 'description', 'content' => $model->meta_description]);

?>

<main role="main">
    <div class="bread_part">
        <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
    <div class="cr">
        <article class="content_part">
            <figure>
                <?=
                EasyThumbnailImage::thumbnailImg(
                    $model->imagePath,
                    555,
                    370,
                    EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                    [
                        'alt' => $model->title,
                        'class' => ''
                    ]
                );
                ?>
            </figure>
            <h2><?= $model->title?></h2>
            <p><?= Yii::$app->formatter->asDate($model->created, 'd.MM.Y') ?></p>
            <?= $model->description?>
        </article>
    </div>
</main>