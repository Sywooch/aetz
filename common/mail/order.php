<?php
/* @var $order common\models\Order */
use yii\helpers\Html;
?>

<h1>New order #<?= $order->id ?></h1>

<h2>Contact</h2>

<ul>
    <li>Phone: <?= Html::encode($order->user_phone) ?></li>
    <li>Email: <?= Html::encode($order->user_email) ?></li>
</ul>

<h2>Address</h2>

<?= Html::encode($order->user_address) ?>

<h2>Items</h2>

<ul>
<?php
$sum = 0;
foreach ($order->orderItems as $item): ?>
    <?php $sum += $item->quantity * $item->price ?>
    <li><?= Html::encode($item->title . ' x ' . $item->quantity . ' x ' . $item->price . '$') ?></li>
<?php endforeach ?>
</ul>

<p><string>Total: </string> <?php echo $sum?>$</p>

