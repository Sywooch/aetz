<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use common\models\Text;
use yii\helpers\Url;
?>

<header>
    <div class="top_header">
        <div class="cr">
            <div class="search_area">
                <button type="button" class="search"></button>
                <div class="s_part">
                    <form id="search-form" action="/search/index" method="get" role="form">
                        <input type="search" id="search-query" name="Search[query]" class="s_input" placeholder="Поиск...">
                        <input onclick="document.getElementById('search-form').submit()" class="s_submit" type="submit" value="Найти">
                    </form>             
                </div>
            </div>
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
            <nav class="m_menu">
                <ul class="menu">
                    <li class="submenu">
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
                                <li>
                                     <a href="<?= Url::toRoute(['/article/career']) ?>">Карьера</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="submenu">
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
                        <a href="<?= Url::toRoute(['/article/contacts']) ?>">Контакты</a>
                        <span>Обратная связь</span>
                    </li>
                </ul>
                <div class="mob_start"></div>
                <div class="mob_close"></div>
            </nav>
        </div>
    </div>
</header>