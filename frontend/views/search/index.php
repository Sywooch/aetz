<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use frontend\models\Search;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
use \yii\widgets\Breadcrumbs;
use himiklab\thumbnail\EasyThumbnailImage;
/* @var $this yii\web\View */
$this->title = 'Поиск по сайту';
$this->params['breadcrumbs'][] = $this->title;
?>
<main role="main">
    <div class="bread_part">
        <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
    <div class="cr">
        <?php if($query == ''){?>
            <h1 class="query-message"><?= Yii::t('app', 'Enter the search query')?></h1>
        <?php }?>
        <div class="service">
            <div class="search-form-block">

                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'search-form',
                        'action' => Url::toRoute('/search/index'),
                        'method' => 'get',
                    ]
                ); ?>

                <div class="">
                    <div class="">
                        <?= $form->field($model, 'query',['inputOptions' => ['class' => 'form-control search-text']])->textInput(['placeholder' => Yii::t('app', 'Search request'),'maxlength' => 75])->label(false) ?>
                    </div>
                    <div class="">
                        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-default', 'name' => 'search-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <?php if((!$query == '') && !$queryWithTags){?>
                <?php if($resulCount != 0){?>
                    <h4 class="query-message result-message"><?= Yii::t('app', 'Results for:')?></h4>
                    <span class="result-query"><?=$query ?></span>
                <?php } else {?>
                    <h4 class="query-message result-message"><?= Yii::t('app', 'On request')?></h4>
                    <span class="result-query"><?=$query ?></span>
                    <h4 class="query-message result-message"><?= Yii::t('app', 'Nothing found')?> </h4>
                <?php }?>
            <?php } else {?>
                <h4 class="query-message result-message"><?= Yii::t('app', 'Incorrect request')?></h4>
            <?php } ?>

            <div>

                <?php if($articleList){?>
                    <div class="result-item-title"><?= Yii::t('app', 'Articles')?></div>
                    <ul class="news_ul">
                        <?php foreach($articleList as $article){?>
                            <li>
                                <div class="news_mini">
                                    <div class="news_pad">
                                        <a class="heading" href="<?= Url::toRoute(['/article/view', 'slug' => $article->slug]) ?>"><?= $article->title ?></a>
                                        <p><?php $anounce = strip_tags($article->description, '<a>'); echo mb_substr($anounce,0, 100, 'UTF-8').' ...'; ?></p>
                                        <div class="ov">
                                            <span class="fl_l"><?= Yii::$app->formatter->asTime($article->created, 'H:i') ?></span>
                                            <span class="fl_r"><?= Yii::$app->formatter->asDate($article->created, 'dd.MM.yyyy') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php }?>
                    </ul>
                <?php }?>

                <?php if($productList){?>
                    <div class="result-item-title"><?= Yii::t('app', 'Products')?></div>
                    <ul class="news_ul">
                        <?php foreach($productList as $product){?>
                            <li>
                                <div class="news_mini">
                                    <figure>
                                        <a href="<?= Url::toRoute(['/product/view', 'slug' => $product->slug]) ?>">
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
                                        </a>
                                    </figure>
                                    <div class="news_pad">
                                        <a class="heading" href="<?= Url::toRoute(['/product/index', 'slug' => $product->slug]) ?>"><?= $product->title ?></a>
                                        <p><?php $anounce = strip_tags($product->description, '<a>'); echo mb_substr($anounce,0, 100, 'UTF-8').' ...'; ?></p>
                                        <div class="ov">
                                            <span class="fl_l"><?= Yii::$app->formatter->asTime($product->created, 'H:i') ?></span>
                                            <span class="fl_r"><?= Yii::$app->formatter->asDate($product->created, 'dd.MM.yyyy') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php }?>
                    </ul>
                <?php }?>
                
                <?php if($newsList){?>
                    <div class="result-item-title"><?= Yii::t('app', 'News')?></div>
                    <ul class="news_ul">
                    <?php foreach($newsList as $news){?>
                        <li>
                            <div class="news_mini">
                                <figure>
                                    <a href="<?= Url::toRoute(['/news/view', 'slug' => $news->slug]) ?>">
                                        <?=
                                        EasyThumbnailImage::thumbnailImg(
                                            $news->imagePath,
                                            280,
                                            200,
                                            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                            [
                                                'alt' => $news->title,
                                                'class' => ''
                                            ]
                                        );
                                        ?>
                                    </a>
                                </figure>
                                <div class="news_pad">
                                    <a class="heading" href="<?= Url::toRoute(['/news/view', 'slug' => $news->slug]) ?>"><?= $news->title ?></a>
                                    <p><?php $anounce = strip_tags($news->description, '<a>'); echo mb_substr($anounce,0, 100, 'UTF-8').' ...'; ?></p>
                                    <div class="ov">
                                        <span class="fl_l"><?= Yii::$app->formatter->asTime($news->created, 'H:i') ?></span>
                                        <span class="fl_r"><?= Yii::$app->formatter->asDate($news->created, 'dd.MM.yyyy') ?></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php }?>
                    </ul>
                <?php }?>
            </div>
        </div>
    </div>
</main>