<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use common\models\Text;
use yii\helpers\Url;
?>

<header>
    <div class="top_header">
        <div class="cr">
            <button onclick="document.location='/search/index'" type="button"></button>
            <span class="h_mail"><?= Text::getValue('email')?></span>
            <span class="h_phone"><?= Text::getValue('phone')?></span>
            <span class="h_adress"><?= Text::getValue('address')?></span>
        </div>
    </div>
    <div class="center_header">
        <div class="cr">
            <a href="/">
                <figure class="h_figure">
                    <img src="/img/logo.jpg"  alt="Астанинский электротехнический завод" title="Логотип">
                    <figcaption><span>Астанинский</span> электротехнический завод</figcaption>
                </figure>
            </a>
            <nav>
                <ul class="menu">
                    <li>
                        <a href="javascript:void(0);">О компании </a>
                        <span>Инфо о нас</span>
                        <div class="under_li">
                            <ul class="under_ul">
                                <li>
                                    <a href="<?= Url::toRoute(['/article/istoriya']) ?>">Истории</a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute(['/article/o-kompanii']) ?>">О Компании</a>
                                </li>
                                <li>
                                    <a href="<?= Url::toRoute(['/article/partnery']) ?>">Партнеры</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Услуги</a>
                        <span>Перечень услуг</span>
                        <div class="under_li">
                            <ul class="under_ul">
                                <?php $services = \common\models\Article::find()->where(['is_published' => '1', 'category_id' => '2'])->orderBy('created DESC')->all()?>
                                <?php foreach($services as $service){?>
                                    <li><a href="<?= Url::toRoute(['/article/view', 'slug' => $service->slug]) ?>"><?=$service->title?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['/catalog/']) ?>">Каталог</a>
                        <span>Продукции</span>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['/news/index']) ?>">Новости</a>
                        <span>Пресс центр</span>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['/article/our-projects']) ?>">Наши проекты</a>
                        <span>Наши клиенты</span>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['/article/career']) ?>">Карьера</a>
                        <span>Вакансии</span>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['/article/contacts']) ?>">Контакты</a>
                        <span>Обратная связь</span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>