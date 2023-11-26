<?
    $sql = "SELECT users.*, services.name AS serviceName, ordersQuantity.quantity FROM users INNER JOIN services ON users.serviceId = services.id LEFT JOIN (SELECT orders.professionalId, COUNT(*) AS quantity FROM orders WHERE orders.status = '4' GROUP BY orders.professionalId) ordersQuantity ON users.id = ordersQuantity.professionalId HAVING users.status = '2' AND users.id != '".$loggedUser['id']."' ORDER BY ordersQuantity.quantity DESC LIMIT 0,4";
    $result = $connect->query($sql)->fetchAll();
?>
<section class="banner">
    <div class="banner__content">
        <h1 class="banner__title">
            нужна помощь? найди <span class="blue">своего</span> специалиста
        </h1>
        <p class="banner__text">
            на нашем сайте зарегистрировано более 100 тыс. специалистов с различных сфер, которые готовы
            помочь тебе с <span class="blue">работой по дому, ремонтом, перевозкой вещей, заменой
                комплектующих ПК</span> и др.
        </p>
        <a href="?page=catalog" class="banner__btn gradient-bg big-btn btn">перейти к услугам</a>
    </div>
    <div class="banner__images">
        <div class="banner__img">
            <img src="<?=$result[0]['img']?>" alt="professional">
        </div>
        <div class="banner__img">
            <img src="<?=$result[1]['img']?>" alt="professional">
        </div>
        <div class="banner__img">
            <img src="<?=$result[2]['img']?>" alt="professional">
        </div>
    </div>
</section>
<section class="adjustments">
    <h2 class="adjustments__title">что мы предлагаем?</h2>
    <div class="adjustments__body">
        <div class="adjustments__item">
            <div class="adjustments__icon">
                <img src="assets/img/adjustments/adjustments-1.svg" alt="icon">
            </div>
            <h5 class="adjustments__label">удобный поиск</h5>
            <p class="adjustments__text">
                на нашем сайте ты можешь ознакомиться со всеми видами услуг и найти именно ту, которая
                необходима тебе
            </p>
        </div>
        <div class="adjustments__item">
            <div class="adjustments__icon">
                <img src="assets/img/adjustments/adjustments-2.svg" alt="icon">
            </div>
            <h5 class="adjustments__label">экономия времени</h5>
            <p class="adjustments__text">
                ты можешь лично обратиться к специалисту или выложить свою просьбу, которую смогут увидеть
                все специалисты
            </p>
        </div>
        <div class="adjustments__item">
            <div class="adjustments__icon">
                <img src="assets/img/adjustments/adjustments-3.svg" alt="icon">
            </div>
            <h5 class="adjustments__label">собственные услуги</h5>
            <p class="adjustments__text">
                ты можешь стать специалистом и сам начать предлагать и продвигать собственные услуги
            </p>
        </div>
    </div>
</section>
<section class="catalog" id="mini-catalog">
    <h2 class="catalog__title">они заслуживают внимания</h2>
    <div class="catalog__body">
        <? foreach($result as $user) {?>
            <div class="catalog__item">
                <a href="?page=profile&id=<?=$user['id']?>" class="catalog__img">
                    <img src="<?=$user['img']?>" alt="professional">
                </a>
                <h5 class="catalog__name"><?=$user['name']?></h5>
                <p class="catalog__service"><?=$user['serviceName']?></p>
                <p class="catalog__price"><?=number_format($user['price'], 0, '', '.')?> ₽</p>
                <a href="?page=appeal&id=<?=$user['id']?>" class="catalog__link link">
                    заказать услугу
                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.00001 3.89051V4.12476C7.9338 4.37305 7.74822 4.53357 7.57633 4.70518C6.55642 5.72442 5.537 6.74415 4.51807 7.76454C4.34423 7.93876 4.14136 8.03289 3.89331 7.98949C3.63466 7.94447 3.45217 7.79357 3.36737 7.5461C3.2723 7.26846 3.34976 7.02539 3.55492 6.82017L5.50912 4.86538C5.77771 4.59654 6.04516 4.32672 6.3162 4.06033C6.36317 4.014 6.36839 3.99116 6.318 3.94075C5.39789 3.02412 4.4804 2.10488 3.56177 1.18678C3.36003 0.984984 3.27491 0.749749 3.36281 0.470469C3.43978 0.225447 3.61265 0.0776503 3.8602 0.0154974C3.87211 0.0125611 3.88695 0.0166393 3.892 0H4.09504C4.27394 0.0120717 4.4075 0.103588 4.53128 0.227894C5.61153 1.31255 6.69406 2.39509 7.7779 3.47615C7.89581 3.59361 7.98517 3.72052 8.00001 3.89051Z"
                            fill="#0000FF" />
                        <path
                            d="M4.00223 3.83326C4.00305 4.05153 3.90977 4.22772 3.76299 4.38236C2.9471 5.24108 2.13235 6.10062 1.31678 6.9595C1.2204 7.06097 1.13217 7.17157 1.00676 7.24156C0.62923 7.45216 0.158252 7.2582 0.0372461 6.84074C-0.0465776 6.55102 0.0202856 6.29719 0.226746 6.07941C0.917883 5.35022 1.60902 4.6207 2.30228 3.89362C2.3512 3.8424 2.34973 3.81597 2.30228 3.76605C1.60902 3.03865 0.917557 2.30962 0.226909 1.57978C0.000552833 1.34063 -0.0606025 1.02399 0.0621974 0.753682C0.278769 0.276851 0.825416 0.18305 1.18746 0.563635C1.95345 1.36901 2.71781 2.17602 3.48201 2.98319C3.60546 3.11353 3.73609 3.23735 3.8478 3.37829C3.95347 3.51141 4.00191 3.66426 4.00223 3.83326Z"
                            fill="#0000FF" />
                    </svg>
                </a>
            </div>
        <?}?>
    </div>
    <a href="?page=catalog" class="catalog__btn btn">посмотреть больше</a>
</section>
<section class="how">
    <h2 class="how__title">как стать специалистом?</h2>
    <div class="how__body">
        <div class="how__item">
            <div class="how__stage">1</div>
            <h5 class="how__text">авторизоваться или зарегистрироваться на сайте</h5>
        </div>
        <svg class="how__arrow arrow" width="49" height="24" viewBox="0 0 49 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M48.0437 13.5237C44.8692 16.7872 41.6896 20.0456 38.5163 23.3105C37.9378 23.9061 37.2753 24.1619 36.4801 23.8957C35.7263 23.6438 35.2992 23.0792 35.1903 22.2808C35.0964 21.5908 35.3756 21.0379 35.8465 20.5585C37.8439 18.5172 39.8337 16.4694 41.8261 14.4255C41.9589 14.2898 42.0979 14.1606 42.2544 14.0069C42.0741 13.8841 41.9013 13.9397 41.7422 13.9397C28.86 13.9358 15.9765 13.9268 3.09427 13.9526C1.96096 13.9539 1.17578 13.5818 0.75 12.4862V11.5198C0.778803 11.4836 0.817623 11.4539 0.833903 11.4125C1.20708 10.4655 1.77186 10.0702 2.76618 10.0702C15.7423 10.0689 28.7185 10.0689 41.6946 10.0689H42.1981C42.2068 10.0572 42.2156 10.0443 42.2244 10.0327C42.2381 10.012 42.2532 9.99264 42.2669 9.97197L42.2444 9.95259C42.1254 9.85311 42.0027 9.75879 41.895 9.64768C39.8663 7.57016 37.8364 5.49652 35.8177 3.40996C34.7069 2.26396 35.1039 0.500396 36.5665 0.0779158C37.3079 -0.135263 37.9415 0.102464 38.4813 0.659311C39.8062 2.02624 41.1399 3.38412 42.4673 4.74846C44.3269 6.65673 46.1853 8.56758 48.0425 10.4797C48.9842 11.45 48.9867 12.5547 48.0437 13.5237Z"
                fill="#EEEEEE" fill-opacity="0.4" />
        </svg>
        <div class="how__item">
            <div class="how__stage">2</div>
            <h5 class="how__text">нажать на кнопку “стать специалистом”</h5>
        </div>
        <svg class="how__arrow arrow" width="49" height="24" viewBox="0 0 49 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M48.0437 13.5237C44.8692 16.7872 41.6896 20.0456 38.5163 23.3105C37.9378 23.9061 37.2753 24.1619 36.4801 23.8957C35.7263 23.6438 35.2992 23.0792 35.1903 22.2808C35.0964 21.5908 35.3756 21.0379 35.8465 20.5585C37.8439 18.5172 39.8337 16.4694 41.8261 14.4255C41.9589 14.2898 42.0979 14.1606 42.2544 14.0069C42.0741 13.8841 41.9013 13.9397 41.7422 13.9397C28.86 13.9358 15.9765 13.9268 3.09427 13.9526C1.96096 13.9539 1.17578 13.5818 0.75 12.4862V11.5198C0.778803 11.4836 0.817623 11.4539 0.833903 11.4125C1.20708 10.4655 1.77186 10.0702 2.76618 10.0702C15.7423 10.0689 28.7185 10.0689 41.6946 10.0689H42.1981C42.2068 10.0572 42.2156 10.0443 42.2244 10.0327C42.2381 10.012 42.2532 9.99264 42.2669 9.97197L42.2444 9.95259C42.1254 9.85311 42.0027 9.75879 41.895 9.64768C39.8663 7.57016 37.8364 5.49652 35.8177 3.40996C34.7069 2.26396 35.1039 0.500396 36.5665 0.0779158C37.3079 -0.135263 37.9415 0.102464 38.4813 0.659311C39.8062 2.02624 41.1399 3.38412 42.4673 4.74846C44.3269 6.65673 46.1853 8.56758 48.0425 10.4797C48.9842 11.45 48.9867 12.5547 48.0437 13.5237Z"
                fill="#EEEEEE" fill-opacity="0.4" />
        </svg>
        <div class="how__item">
            <div class="how__stage">3</div>
            <h5 class="how__text">ждать рассмотрения заявки администратором</h5>
        </div>
    </div>
</section>
<section class="advices">
    <div class="advices__body">
        <h2 class="advices__title">советы по выбору специалиста</h2>
        <h5 class="advices__label">изучайте портфолио</h5>
        <p class="advices__description">
            просматривайте фото с примерами работ, сертификаты, грамоты или другие документы,
            подтверждающие квалификацию исполнителя.
        </p>
        <h5 class="advices__label">уточняйте, как формируется цена</h5>
        <p class="advices__description">
            стоимость услуги может рассчитываться по-разному — за час, за день, за услугу и т. п.
            исполнитель может включать в стоимость плату за выезд или покупку материалов. обращайте
            внимание на эти детали, чтобы избежать возможных споров.
        </p>
        <h5 class="advices__label">
            выбирайте исполнителя с подтвержденными паспортными данными
        </h5>
        <p class="advices__description">
            мы стараемся создать надежную среду для взаимодействия заказчиков и исполнителей. Обращайте
            внимание на специалистов со значком, что означает, что паспортные данные в профиле
            специалиста корректны и были проверены модератором.
        </p>
    </div>
    <div class="advices__img">
        <img src="assets/img/advices/advices.svg" alt="icon">
    </div>
</section>