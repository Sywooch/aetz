<?php
/* @var $this yii\web\View */
$this->title = 'АЭТЗ - Астанинский электротехнический завод';
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Text;
$this->registerMetaTag(['name'=> 'title', 'content' =>  '']);
$this->registerMetaTag(['name'=> 'keywords', 'content' =>  '']);
$this->registerMetaTag(['name'=> 'description', 'content' => '']);
?>

<main role="main">
    <?= $this->render( '_slider', ['slides' => $slides] )?>
    <div class="line">
        <div class="cr l_bg">
            <span>Перечень предоставляемых услуг</span>
        </div>
    </div>
    <div class="cr">
    <ul class="serv_ul">
        <?php foreach($services as $service) {?>
        <li>
            <div class="serv_text w_r">
                <?php
                echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                    $service->imagePath, 205, 167, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                    [
                        'class' => ''
                    ]
                );
                ?>
                <a class="heading" href="<?= Url::toRoute(['/article/view', 'slug' => $service->slug]) ?>"><?= $service->title ?></a>
                <p><?php $anounce = strip_tags($service->description, '<a>'); echo mb_substr($anounce,0, 200, 'UTF-8').' ...'; ?></p>
                <a class="btn" href="<?= Url::toRoute(['/article/view', 'slug' => $service->slug]) ?>">Подробнее</a>
            </div>
        </li>
        <?php } ?>
    </ul>
    </div>
    <div class="line">
        <div class="cr">
            <div class="line_half l_bg">
                <span>Перечень предоставляемых услуг</span>
            </div>
        </div>
    </div>
    <div class="about_main">
        <div class="cr">
            <div class="about_text">
                <?= Text::getValue('main_article')?>
                <a class="btn" href="<?= Url::toRoute(['/article/o-kompanii']) ?>">Подробнее</a>
            </div>
            <div class="products_sl">
                <div class="wr">
                    <div class="second-item">
                        <?php foreach($products as $product) {?>
                        <div>
                            <a href="<?= Url::toRoute(['/product/index', 'slug' => $product->slug]) ?>"><?= $product->title ?></a>
                            <?php
                            echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                                $product->imagePath, 320, 220, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                [
                                    'class' => ''
                                ]
                            );
                            ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="benefits">
        <div class="setka">
            <div class="cr">
                <span class="heading">Преимущество компании:</span>
                <ul class="benf_ul">
                    <li>
                        <div class="img"><img src="img/ben1.png"></div>
                        <span>Квалифицированный персонал</span>
                    </li>
                    <li>
                        <div class="img"><img src="img/ben2.png"></div>
                        <span>Квалифицированный персонал</span>
                    </li>
                    <li>
                        <div class="img"><img src="img/ben3.png"></div>
                        <span>Квалифицированный персонал</span>
                    </li>
                    <li>
                        <div class="img"><img src="img/ben4.png"></div>
                        <span>Квалифицированный персонал</span>
                    </li>
                    <li>
                        <div class="img"><img src="img/ben5.png"></div>
                        <span>Квалифицированный персонал</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cr clearfix">
        <div class="red_box">
            <div class="w_r">
                <div class="line l_bg">
                    <span>Наши сертификаты</span>
                </div>
                <div class="carousel">
                    <?php foreach($certificates as $certificate) {?>
                    <div>
                        <?php
                        echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                            $certificate->imagePath, 135, 185, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                            [
                                'class' => ''
                            ]
                        );
                        ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="red_box">
            <div class="w_l">
                <div class="line l_bg">
                    <span>Наши партнеры</span>
                </div>
                <div class="carousel car_top">
                    <?php foreach($partners as $partner) {?>
                        <div>
                            <?php
                            echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                                $partner->imagePath, 135, 95, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                [
                                    'class' => ''
                                ]
                            );
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>
