<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = 'Забыли пароль?';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container text-center">

    <div class="row">
        <p>Пожалуйста, введите Ваш адрес электронной почты, на который мы можем выслать Ваш новый пароль.</p>

        <div class="form-recovery">
            <div class="row">
                <div class="col-xs-12">

                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'layout' => 'horizontal', 'action' => '/site/request-password-reset']); ?>
                    <?= $form->field($model, 'email') ?>
                    <div class="text-center">
                        <?= Html::submitButton('Восстановить', ['class' => 'btn btn-info']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
