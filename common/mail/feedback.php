<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
?>

<p>Обратная связь с сайта</p>
<p>Имя: <?= Html::encode($username) ?></p>
<p>Email:<?= Html::encode($email) ?> </p>
<p>Телефон:<?= Html::encode($phone) ?> </p>
<p>Тема:<?= Html::encode($subject) ?> </p>
<p>Сообщение:<?= Html::encode($body) ?> </p>

