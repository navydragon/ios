@extends('layouts.app')

@section('content')
<div class="container" style="min-height: calc(100vh - 168px);">
    <h3 style="padding-top: 30px;">Контактная информация</h3>

    <!-- FLIP BOXES -->
    <div class="row">

        <div class="col-md-6">

            <div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
                <div class="front">
                    <div class="box1">
                        <span class="box-icon-title">
                            <img class="contacts__item-img" src="/images/logo_cbt_black.png" alt="" />
                        </span>
                    </div>
                </div>

                <div class="back">
                    <div class="box2">
                        <h4>Организатор обучения</h4>
                        <hr style="background-color: #fff;" />
                        <div class="contacts__item-container">

                            <h5 class="contacts__item-name">Зачиняев Антон Геннадьевич</h5>
                            <span class="contacts__item-job">Начальник нормативного отдела</span>
                            <div class="contacts__item-info">
                                <img class="contacts__item-info-img" src="/images/phone-icon.png" alt="">
                                <span class="contacts__item-text">+7 499 262 43 06</span>
                            </div>
                            <div class="contacts__item-info">
                                <img class="contacts__item-info-img" src="/images/email-icon.png" alt="">
                                <span class="contacts__item-text">zachiniaevag@center.rzd.ru, zachiniaevag@center.rzd</span>
                            </div>

                            <span class="contacts__item-separator"></span>

                            <h5 class="contacts__item-name">Прохоров Виктор Сергеевич</h5>
                            <span class="contacts__item-job">Ведущий специалист нормативного отдела</span>
                            <div class="contacts__item-info">
                                <img class="contacts__item-info-img" src="/images/phone-icon.png" alt="">
                                <span class="contacts__item-text">+7 499 262 43 06</span>
                            </div>
                            <div class="contacts__item-info">
                                <img class="contacts__item-info-img" src="/images/email-icon.png" alt="">
                                <span class="contacts__item-text">prohorovvs@center.rzd.ru, prohorovvs@center.rzd</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
                <div class="front">
                    <div class="box1">
                        <span class="box-icon-title">
                            <img class="contacts__item-img" src="/images/logo-rut-black.png" alt="" />
                        </span>
                    </div>
                </div>

                <div class="back">
                    <div class="box2">
                        <h4>Техническая поддержка</h4>
                        <hr style="background-color: #fff;" />
                        <div class="contacts__item-container">

                        <h5 class="contacts__item-name">РОССИЙСКИЙ УНИВЕРСИТЕТ ТРАНСПОРТА РУТ (МИИТ)</h5>
                            <span class="contacts__item-job" style="margin-top: 20px;">Телефон</span>
                            <div class="contacts__item-info">
                                <img class="contacts__item-info-img" src="/images/phone-icon.png" alt="">
                                <span class="contacts__item-text">+7 495 653 55 16</span>
                            </div>

                            <span class="contacts__item-separator"></span>

                            <span class="contacts__item-job">Электронная почта</span>
                            <div class="contacts__item-info">
                                <img class="contacts__item-info-img" src="/images/email-icon.png" alt="">
                                <span class="contacts__item-text">ief07@bk.ru</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /FLIP BOXES -->



</div>
@endsection
