<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_1" data-toggle="tab">Данные</a>
            </li>
            <!--            <li>-->
            <!--                <a href="#tab_2" data-toggle="tab">Изображении</a>-->
            <!--            </li>-->
            <li class="pull-right">

                <?php if($model->isNewRecord) {?>
                    <?= Html::submitButton('<span class="glyphicon glyphicon-ok"></span> '.Yii::t('app', 'Create'),['class' => 'btn btn-success']) ?>
                <?php } else {?>
                    <?= Html::submitButton('<span class="glyphicon glyphicon-refresh"></span> '.Yii::t('app', 'Save'),['class' => 'btn btn-primary']) ?>
                <?php } ?>

            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="tab_1">

                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <?= $form->field($model, 'user_id')->textInput(['readonly' => true]) ?>

                        <?= $form->field($model, 'model_name')->hiddenInput(['value' => 'product'])->label(false) ?>

                        <?= $form->field($model, 'model_name')->textInput(['readonly' => true]) ?>

                        <?= $form->field($model, 'model_id')->textInput(['readonly' => true]) ?>

                        <?= $form->field($model, 'rating')->textInput(['readonly' => true]) ?>

                        <?= $form->field($model, 'review')->textarea(['rows' => 6, 'readonly' => true]) ?>

                        <?= $form->field($model, 'is_published')->checkbox() ?>

                    </div>

                </div>

            </div><!-- /.tab-pane -->

            <div class="tab-pane " id="tab_2">

            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
