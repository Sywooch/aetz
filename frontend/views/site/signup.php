<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'layout' => 'horizontal', 'action' => Url::toRoute('/site/signup')]); ?>

            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($model, 'firstname') ?>
                    <?= $form->field($model, 'lastname') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'phone') ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>
                </div>
            </div>

        <div class="form-group text-center">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>
</div>
