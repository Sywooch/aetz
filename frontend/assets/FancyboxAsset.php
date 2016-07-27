<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;


class FancyboxAsset extends AssetBundle
{
    public $sourcePath = '@bower/fancybox/source';
    public $css = [
        'jquery.fancybox.css',
    ];
    public $js = [
        'jquery.fancybox.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
