<?php
namespace frontend\widgets;

use Yii;
use yii\web\AssetBundle;

class ShareLinksAssets extends AssetBundle
{
	public $sourcePath = '@sharelinks/assets';
	public $basePath = '@webroot/assets';
	public $js = [
		'social.js'
	];
	public $css = [
		'social.css'
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];

	public function init() {
		Yii::setAlias('@sharelinks', __DIR__);
		return parent::init();
	}
}