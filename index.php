<?php
header('Location: ' . '/Project/lab2.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/logic.php');
//Шапка
require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/header.php');
?>
<div class="container">
    <h4>Ajax StarterKit Plus white</h4>
    <div>Код 176844</div>
    <div class="row">
        <div class="col-3">
            <img src="/Project/images/250.jpg" alt="">
        </div>
        <div class="col-3">
            <div class="row">Назначение сигнализации</div>
            <div class="row">Постановка и снятие с охраны</div>
            <div class="row">Тип соединения устройств</div>
            <div class="row">Производитель</div>
            <div class="row">Перейти к описанию</div>
            <div class="row">7745 просмотров</div>
            <div class="row">
                <img src="/Project/images/251.jpg" alt="">
            </div>
        </div>
        <div class="col-2">
            <div class="row">Охранная</div>
            <div class="row">брелок</div>
            <div class="row">беспроводное</div>
            <div class="row">Ajax</div>
        </div>
        <div class="col">
            <div class="row">Товар недоступен к заказу</div>
            <div class="row">
                <div>Аналог взамен</div>
                <a href="">
                    <img src="/Project/images/252.jpg" alt="">
                    <div>Hikvision DS-PWA96-KIT-WE</div>
                </a>
            </div>
            <div class="row">
                <div style="margin-left: 20px; margin-bottom: 20px; margin-top: 30px;">
                    <div style="font-size: 14px; margin-left: 15px;">
                        <div style="text-decoration: line-through; color: gray;">25 990</div>
                        <div>21 962</div>
                    </div>
                    <button type="button" class="btn btn-warning" style="width: 160px;">В корзину</button>
                </div>
                <button type="button" class="btn btn-warning" style="width: 360px;">Подобрать аналог</button>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 40px;">
        <nav>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true" tabindex="-1">Похожие
                    товары</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Описание</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false" tabindex="-1">Технические
                    характеристики</button>
                <button class="nav-link" id="nav-other-tab" data-bs-toggle="tab" data-bs-target="#nav-other"
                    type="button" role="tab" aria-controls="nav-other" aria-selected="false"
                    tabindex="-1">Параметры</button>
                <button class="nav-link" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general"
                    type="button" role="tab" aria-controls="nav-general" aria-selected="false"
                    tabindex="-1">Отзывы</button>
            </div>
        </nav>
    </div>
    <div id="sameContent" class="row" style="margin-top: 50px;">
        <div>ПОХОЖИЕ ТОВАРЫ ИЗ КАТЕГОРИИ КОМПЛЕКТЫ БЕСПРОВОДНОЙ GSM-СИГНАЛИЗАЦИИ</div>
        <div class="col">
            <a href="">
                <img src="/Project/images/252.jpg" alt="">
                <div>Hikvision DS-PWA64-KIT-WE</div>
                <div>19 990 руб.</div>
                <button type="button" class="btn btn-warning" style="width: 160px;">В корзину</button>
            </a>
        </div>
        <div class="col">
            <a href="">
                <img src="/Project/images/252.jpg" alt="">
                <div>Hikvision DS-PWA96-KIT-WE</div>
                <div>21 962 руб.</div>
                <button type="button" class="btn btn-warning" style="width: 160px;">В корзину</button>
            </a>
        </div>
        <div class="col">
            <a href="">
                <img src="/Project/images/252.jpg" alt="">
                <div>Satel VERSA</div>
                <div>18 977 руб.</div>
                <button type="button" class="btn btn-warning" style="width: 160px;">В корзину</button>
            </a>
        </div>
        <div class="col">
            <a href="">
                <img src="/Project/images/252.jpg" alt="">
                <div>Dahua DHI-ART</div>
                <div>24 990 руб.</div>
                <button type="button" class="btn btn-warning" style="width: 160px;">В корзину</button>
            </a>
        </div>
        <div style="margin-top: 50px; color: grey ;">*Производитель оставляет за собой право изменять характеристики
            товара, его внешний вид и комплектность без предварительного уведомления продавца. Не является публичной
            офертой согласно Статьи 437 п.2 ГК РФ.</div>
    </div>
    <div class="row" style="margin-top: 50px;">
        <div>ПОХОЖИЕ ТОВАРЫ ИЗ КАТЕГОРИИ КОМПЛЕКТЫ БЕСПРОВОДНОЙ GSM-СИГНАЛИЗАЦИИ</div>
        <div class="col">
            <a href="">
                <img src="/Project/images/252.jpg" alt="">
                <div>Hikvision DS-PWA64-KIT-WE</div>
                <div>19 990 руб.</div>
                <button type="button" class="btn btn-warning" style="width: 160px;">В корзину</button>
            </a>
        </div>
        <div class="col">
            <a href="">
                <img src="/Project/images/252.jpg" alt="">
                <div>Hikvision DS-PWA96-KIT-WE</div>
                <div>21 962 руб.</div>
                <button type="button" class="btn btn-warning" style="width: 160px;">В корзину</button>
            </a>
        </div>
        <div class="col">
            <a href="">
                <img src="/Project/images/252.jpg" alt="">
                <div>Satel VERSA</div>
                <div>18 977 руб.</div>
                <button type="button" class="btn btn-warning" style="width: 160px;">В корзину</button>
            </a>
        </div>
        <div class="col">
            <a href="">
                <img src="/Project/images/252.jpg" alt="">
                <div>Dahua DHI-ART</div>
                <div>24 990 руб.</div>
                <button type="button" class="btn btn-warning" style="width: 160px;">В корзину</button>
            </a>
        </div>
    </div>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/footer.php') ?>