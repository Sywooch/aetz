<?php

$this->title = $model->title;

$this->params['breadcrumbs'][] = $model->title;

$this->registerMetaTag(['name'=> 'keywords', 'content' =>  $model->meta_keywords]);
$this->registerMetaTag(['name'=> 'description', 'content' => $model->meta_description]);

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
            <h4 ><?= $model->title?></h4>
        </div>

        <div class="col-xs-12">
            <?= $this->render('_gallery', [
                'model' => $model
            ]) ?>
        </div>


    </div>

</div>