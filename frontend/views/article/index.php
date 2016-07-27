<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $this yii\web\View */
$this->title = 'Статьи';

$this->params['breadcrumbs'][] = 'Статьи';
$this->registerMetaTag(['name'=> 'keywords', 'content' =>  '']);
$this->registerMetaTag(['name'=> 'description', 'content' => '']);

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
           
            <?= \yii\widgets\Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-xs-12">
            <?php foreach($categories as $category) {?>
                <?= Html::a($category->title, ['article/index', 'slug' => $category->slug],['class' => 'btn btn-default'] )?>
            <?php } ?>
        </div>
    </div>

    <hr/>

    <div class="row">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
            'layout' => "{items}\n<div class='clearfix'></div>{pager}",
        ]) ?>
    </div>
</div>