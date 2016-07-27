<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($imageModel, 'title')->textInput(['value' => $imageModel->title])->label(false); ?>

    <div class="text-right">

        <?= Html::button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) ?>

        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>

    </div>

<?php ActiveForm::end(); ?>
