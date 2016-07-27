<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\City;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use common\models\User;
use vova07\fileapi\Widget as FileAPI;

?>

<div class="user-form">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_1" data-toggle="tab">Данные</a>
            </li>
            <li>
                <a href="#tab_2" data-toggle="tab">Сменить пароль</a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="tab_1">

                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                            <?= $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>

                            <?= $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>

                            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

                            <?= $form->field($model, 'role')->dropDownList(Yii::$app->params['user_roles']) ?>

                            <?= $form->field($model, 'status')->dropDownList(Yii::$app->params['userStatus']) ?>

                            <?= Html::submitButton('<span class="glyphicon glyphicon-refresh"></span> '.Yii::t('app', 'Update'),['class' => 'btn btn-primary']) ?>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>

            </div><!-- /.tab-pane -->

            <div class="tab-pane " id="tab_2">
                <?php $form = ActiveForm::begin(['action' => '/user/change-password']); ?>

                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <?= $form->field($passwordChangeForm, 'userid')->hiddenInput(['value' => $user->id])->label(false) ?>

                        <?= $form->field($passwordChangeForm, 'password')->passwordInput(['maxlength' => 255]) ?>

                        <?= $form->field($passwordChangeForm, 'passwordRepeat')->passwordInput(['maxlength' => 255])?>

                        <?= Html::submitButton('<span class="glyphicon glyphicon-refresh"></span> '.Yii::t('app', 'Update'),['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div>


</div>


