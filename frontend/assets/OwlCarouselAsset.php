<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;


class OwlCarouselAsset extends AssetBundle
{
    public $sourcePath = '@bower/owlcarousel/owl-carousel';
    public $css = [
        'owl.carousel.css',
        'owl.theme.css',
    ];
    public $js = [
        'owl.carousel.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
