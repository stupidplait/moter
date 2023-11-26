<header class="header" id="header">
    <a href="./" class="header__logo">
        <img src="assets/img/common/logo.svg" alt="logo">
    </a>
    <input type="checkbox" id="burger">
    <div class="header__right">
        <nav class="header__nav nav">
            <a href="./" class="nav__link <? if(!isset($_GET['page'])) echo 'active'; ?>">главная</a>
            <a href="?page=catalog" class="nav__link <? if($_GET['page'] == 'catalog' && !isset($_GET['services'])) echo 'active'; ?>">услуги</a>
            <?
                if(isset($_SESSION['uid'])) { ?>
                    <a href="?page=professional" class="nav__link <? if($_GET['page'] == 'professional') echo 'active'; ?>">стать специалистом</a>
                <? }
                if($loggedUser['status'] == '2') { ?>
                    <a href="?page=catalog&services" class="nav__link <? if($_GET['page'] == 'catalog' && isset($_GET['services'])) echo 'active'; ?>">объявления</a>
                <? }
            ?>
        </nav>
        <div class="header__btns">
            <?
                if(!isset($_SESSION['uid'])) { ?>
                    <a href="?page=signup" class="header__btn btn">регистрация</a>
                    <a href="?page=signin" class="header__btn btn">вход</a>
                <? } else { ?>
                    <a href="?page=profile" class="header__btn btn">профиль</a>
                    <a href="?exit" class="header__btn btn">выход</a>
                <? }
            ?>
        </div>
    </div>
    <label for="burger">
        <span></span>
        <span></span>
        <span></span>
    </label>
</header>