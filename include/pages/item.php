<section class="profile">
    <div class="profile__content">
        <?
            $sql = "SELECT orders.*, services.name AS serviceName, users.name as userName FROM orders INNER JOIN services ON orders.serviceId = services.id INNER JOIN users ON orders.userId = users.id HAVING id = '".$_GET['id']."'";
            $result = $connect->query($sql)->fetch();
        ?>
        <div class="profile__image">
            <img src="<?=$result['img']?>" alt="order">
        </div>
        <div class="profile__text">
            <h5 class="profile__label"><?=$result['name']?></h5>
            <p>
                <?
                    if($result['status'] == '1' || $result['status'] == '3') echo 'отправлено: ';
                    elseif($result['status'] == '2') echo 'опубликовано: ';
                    elseif($result['status'] == '4') echo 'выполнено: ';
                    else echo 'отклонено: ';
                    echo $result['date'];
                ?>
            </p>
            <h5 class="profile__label">о заказе:</h5>
            <p>заказчик: <?=$result['userName']?></p>
            <p><?=$result['serviceName']?></p>
            <p class="profile__about"><?=$result['about']?></p>
            <p class="profile__price"><?=number_format($result['price'], 0, '', '.')?> ₽</p>
            <?
                if($loggedUser['roleId'] == '2' && $result['status'] == '1') {
                    if(isset($_GET['accept'])) {
                        $sql = "UPDATE orders SET status = '3' WHERE id = '".$_GET['id']."'";
                        $connect->query($sql);?>

                        <script>document.location.href="?page=profile&admin=orders"</script>
                    <?} elseif(isset($_GET['decline'])) {
                        $sql = "UPDATE orders SET status = '0' WHERE id = '".$_GET['id']."'";
                        $connect->query($sql);?>

                        <script>document.location.href="?page=profile&admin=orders"</script>
                    <?}
                    ?>
                    <div class="profile__buttons">
                        <a href="?page=item&id=<?=$result['id']?>&accept" class="profile__btn btn gradient-bg">одобрить</a>
                        <a href="?page=item&id=<?=$result['id']?>&decline" class="profile__btn btn gradient-border">отклонить</a>
                    </div>
                <?} elseif($loggedUser['id'] == $result['userId']) {
                    if(!$result['status']) {?>
                        <div class="profile__buttons">
                            <p class="profile__btn btn gradient-bg">отклонено</p>
                            <a href="?page=update&id=<?=$result['id']?>" class="profile__btn btn gradient-border">редактировать</a>
                        </div>
                    <?} elseif($order['status'] == '2') {?>
                        <p class="profile__btn btn gradient-bg">в ожидании</p>
                        <a href="?page=delete&id=<?=$result['id']?>" class="profile__btn">удалить</a>
                    <?} elseif($result['status'] == '1') {?>
                        <div class="profile__buttons">
                            <p class="profile__btn btn gradient-bg">на проверке</p>
                            <a href="?page=update&id=<?=$result['id']?>" class="profile__btn btn gradient-border">редактировать</a>
                        </div>
                    <?} elseif($result['status'] == '3') {?>
                        <div class="profile__buttons">
                            <a href="?page=update&id=<?=$result['id']?>" class="profile__btn btn gradient-bg">редактировать</a>
                            <a href="?page=delete&id=<?=$result['id']?>" class="profile__btn btn gradient-border">удалить</a>
                        </div>
                    <?} elseif($result['status'] == '4') {?>
                        <div class="profile__buttons">
                            <p class="profile__btn btn gradient-border">завершено</p>
                            <a href="?page=profile&id=<?=$result['professionalId']?>" class="profile__link link">
                                к исполнителю
                                <svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
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
                } elseif($result['status'] == '3' && $loggedUser['status'] == '2') {
                    if(isset($_GET['accept'])) {
                        $sql = "UPDATE orders SET status = '4',
                                                date = '".date('d.m.Y')."',
                                                professionalId = '".$loggedUser['id']."'
                                                WHERE id = '".$_GET['id']."'";
                        $connect->query($sql);?>
                    
                        <script>document.location.href="?page=profile&services"</script>
                    <?}?>
                    <a href="?page=item&id=<?=$result['id']?>&accept" class="catalog__btn btn gradient-bg">принять</a>
                <?} elseif($result['status'] == '4' && $loggedUser['id'] == $result['professionalId']) {?>
                    <p class="catalog__btn btn gradient-bg">выполнен</p>
                <?} elseif($result['status'] == '2' && $loggedUser['id'] == $result['professionalId'])
            ?>
        </div>
    </div>
</section>