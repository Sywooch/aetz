<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\fileapi\Widget as FileAPI;



/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(Yii::$app->params['typeBanner'],  ['prompt' => '-Выберите тип баннера-']) ?>

    <?= $form->field($model, 'photo')->widget(
        FileAPI::className(),
        [
            'settings' => [
                'url' => ['fileapi-upload'],
                'elements' => [
                    'preview' => [
                        'width' => 160,
                        'height' => 160
                    ]
                ],
                'imageAutoOrientation' => false,
            ],
        ])
    ?>

    <?= $form->field($model, 'link')->textInput() ?>

    <?= $form->field($model, 'is_published')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?  Yii::t('app', 'Create') : Yii::t('app', 'Update'),  ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>