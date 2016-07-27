<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 ">
            <h4 class="text-center">Форма обратной связи</h4>

            <?php $form = ActiveForm::begin(['id' => 'contact-form', 'layout' => 'horizontal']); ?>
            <?= $form->field($model, 'name')->label('Имя: <span class="contact-blue">*</span>') ?>
            <?= $form->field($model, 'email')->label('E-mail: <span class="contact-blue">*</span>') ?>
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(),['mask'=> '7 (999) 999-99-99', 'options' => ['class' => 'form-control']]) ?>
            <?= $form->field($model, 'subject')->label('Тема:') ?>
            <?= $form->field($model, 'body')->textArea(['rows' => 3, 'cols' => 80])->label('Сообщение: <span class="contact-blue">*</span>') ?>


            <div class="form-group text-center">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
