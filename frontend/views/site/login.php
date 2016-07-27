<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">

        <div class="col-xs-12">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="col-xs-12 text-center">
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'layout' => 'horizontal', 'action' => Url::toRoute('/site/login')]); ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group ">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
                </div>

            <a href="<?= Url::toRoute(['site/request-password-reset'])?>" >Забыли?</a> <br/>
            <a href="<?= Url::toRoute(['site/signup'])?>" >Зарегистрироваться</a>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
