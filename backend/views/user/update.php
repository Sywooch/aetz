<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => Yii::t('app', 'User'),
]) . $user->firstname.' '.$user->lastname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->firstname.' '.$user->lastname, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'passwordChangeForm' => $passwordChangeForm,
        'user' => $user
    ]) ?>

</div>
