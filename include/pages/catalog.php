<section class="catalog">
    <?
        $pageNumber = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 1;

        if(isset($_GET['services'])) {
            $sql = "SELECT orders.*, services.name AS serviceName FROM orders INNER JOIN services ON orders.serviceId = services.id HAVING orders.status = '3' AND orders.userId != '".$loggedUser['id']."'";
        } else {
            $sql = "SELECT users.*, services.name AS serviceName FROM users INNER JOIN services ON users.serviceId = services.id HAVING users.status = '2'";

            if(isset($_SESSION['uid'])) {
                $sql .= " AND users.id != '".$loggedUser['id']."'";
            }
        }
    ?>
    <div class="catalog__top">
        <h1 class="catalog__title">каталог</h1>
        <?
            if(!isset($_GET['services']) && isset($_SESSION['uid'])) {?>
                <a href="?page=add" class="catalog__btn gradient-bg btn">
                    <p>создать объявление</p>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="16" height="2" rx="1" transform="matrix(1 0 -0.016428 0.999865 0.032856 7)"
                            fill="#EEEEEE" />
                        <rect width="16" height="2" rx="1" transform="matrix(0 -1 0.999865 -0.0164461 7 16)" fill="#EEEEEE" />
                    </svg>
                </a>
            <?}
        ?>
    </div>
    <input type="checkbox" id="filter">
    <label for="filter">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M23.7583 1.56999C23.3215 0.537479 22.5348 0.00550772 21.461 0.00393616C18.3081 -0.00235006 15.1552 0.00157883 12.0022 0.00157883C8.84929 0.00157883 5.67782 7.27546e-06 2.51524 0.00236461C2.37732 0.00236461 2.23643 0.000793053 2.10147 0.029081C1.12489 0.231812 0.44121 0.823502 0.13348 1.82694C-0.17425 2.83116 0.0608111 3.72774 0.731886 4.50801C3.37763 7.5859 6.01743 10.6685 8.66391 13.7456C8.82112 13.9287 8.89453 14.1094 8.89378 14.3648C8.88489 17.2258 8.89156 20.0868 8.88489 22.9479C8.8834 23.3714 9.0191 23.6912 9.37429 23.8876C9.73467 24.0864 10.0706 24.0118 10.3776 23.7517C11.828 22.5243 13.2776 21.2954 14.7273 20.0672C14.9898 19.8448 15.1077 19.5643 15.1062 19.2005C15.0973 17.5543 15.104 15.9081 15.0996 14.2619C15.0988 14.0961 15.1366 13.9727 15.2456 13.8462C16.1214 12.8365 16.9889 11.8189 17.8587 10.8037C19.6807 8.67971 21.51 6.56282 23.32 4.42865C24.0326 3.58865 24.1965 2.60565 23.7583 1.56999ZM21.9052 3.25313C19.2239 6.37581 16.5537 9.50949 13.8642 12.6243C13.4919 13.0549 13.3006 13.4847 13.3147 14.0843C13.3511 15.5828 13.3273 17.082 13.3266 18.5821C13.3266 18.696 13.3399 18.8013 13.2302 18.894C12.3856 19.6067 11.5484 20.3281 10.6638 21.0848V16.473C10.6638 15.5623 10.6571 14.6508 10.6675 13.7393C10.6712 13.4242 10.5696 13.1728 10.3746 12.9449C8.42292 10.6685 6.47347 8.38975 4.52253 6.11178C3.70834 5.16178 2.89564 4.21099 2.07774 3.26413C1.84342 2.99225 1.70105 2.70072 1.85974 2.33612C2.01546 1.97859 2.30761 1.88037 2.65835 1.88116C8.88118 1.88352 15.1047 1.88352 21.3276 1.88116C21.6798 1.88116 21.9734 1.9841 22.1158 2.34791C22.2515 2.69287 22.1381 2.98125 21.9052 3.25313Z"
                fill="#EEEEEE" />
        </svg>
        <p>фильтр</p>
    </label>
    <div class="catalog__inner">
        <?
            require('include/form.php');

            if(isset($_GET['services'])) {
                $rowCount = $connect->query($sql)->rowCount();
                $sql .= " LIMIT 0," . (6 * $pageNumber);
                $result = $connect->query($sql);?>
                <div class="catalog__body" id="catalog-services">
                    <?
                        if($rowCount > 0) {
                            foreach($result as $order) {?>
                                <div class="catalog__item">
                                    <a href="?page=item&id=<?=$order['id']?>" class="catalog__img">
                                        <img src="<?=$order['img']?>" alt="service">
                                    </a>
                                    <div class="catalog__main">
                                        <h5 class="catalog__name"><?=$order['name']?></h5>
                                        <p class="catalog__service"><?=$order['serviceName']?></p>
                                    </div>
                                    <p class="catalog__price"><?=number_format($order['price'], 0, '', '.')?> ₽</p>
                                    <a href="?page=catalog&services&id=<?=$order['id']?>&accept" class="catalog__btn btn gradient-bg">принять</a>
                                </div>
                            <?}

                            if(isset($_GET['accept'])) {
                                $submitSql = "UPDATE orders SET status = '4',
                                                date = '".date('d.m.Y')."',
                                                professionalId = '".$loggedUser['id']."'
                                                WHERE id = '".$_GET['id']."'";
                                $connect->query($submitSql);?>

                                <script>document.location.href="?page=catalog&services"</script>
                            <?}
                        } else {?>
                            <h5 class="profile__label">результаты не найдены</h5>
                        <?}
                    ?>
                </div>
            <?} else {
                $rowCount = $connect->query($sql)->rowCount();
                $sql .= " LIMIT 0," . (6 * $pageNumber);
                $result = $connect->query($sql);?>
                <div class="catalog__body">
                    <?
                        if($rowCount > 0) {
                            foreach($result as $professional) {?>
                                <div class="catalog__item">
                                    <a href="?page=profile&id=<?=$professional['id']?>" class="catalog__img">
                                        <img src="<?=$professional['img']?>" alt="professional">
                                    </a>
                                    <div class="catalog__main">
                                        <h5 class="catalog__name"><?=$professional['name']?></h5>
                                        <p class="catalog__service"><?=$professional['serviceName']?></p>
                                    </div>
                                    <p class="catalog__price"><?=number_format($professional['price'], 0, '', '.')?> ₽</p>
                                        <a href="?page=appeal&id=<?=$professional['id']?>" class="catalog__link link">
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
                            <?}
                        } else {?>
                            <h5 class="profile__label">результаты не найдены</h5>
                        <?}
                    ?>
                </div>
            <?}
        ?>
    </div>
    <?
        if((6 * $pageNumber) < $rowCount) {?>
            <div class="catalog__bottom">
                <a href="<?=$currentPage?>&pageNumber=<?=++$pageNumber?>" class="catalog__btn btn">прогрузить дальше</a>
            </div>
        <?}
    ?>
</section>