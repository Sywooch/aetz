<?php
use frontend\widgets\ShareLinksAssets;

use frontend\widgets\ShareLinks;
use \yii\helpers\Html;

/**
 * @var yii\base\View $this
 */
ShareLinksAssets::register($this);

?>
<nav class="share-social">

    <?= Html::a('', $this->context->shareUrl(ShareLinks::SOCIAL_VKONTAKTE), ['title' => 'Share to Facebook', 'class' => 'social-icon social-vk']) ?>
    <?= Html::a('', $this->context->shareUrl(ShareLinks::SOCIAL_FACEBOOK), ['title' => 'Share to Facebook', 'class' => 'social-icon social-fb']) ?>
    <?= Html::a('', $this->context->shareUrl(ShareLinks::SOCIAL_TWITTER), ['title' => 'Share to Facebook', 'class' => 'social-icon social-tw']) ?>
</nav>
