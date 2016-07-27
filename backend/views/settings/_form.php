<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

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
                <?= Html::submitButton('<span class="glyphicon glyphicon-ok"></span> '.Yii::t('app', 'Create'),['class' => 'btn btn-success']) ?>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="tab_1">

                <div class="row">
                    <div class="col-md-8 col-xs-12">

                        <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>

            </div><!-- /.tab-pane -->

            <div class="tab-pane " id="tab_2">

            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
