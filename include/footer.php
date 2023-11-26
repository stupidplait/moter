<footer class="footer">
    <div class="footer__left">
        <a href="./" class="footer__logo">
            <img src="assets/img/common/logo-white.svg" alt="logo">
            <p>доступные решения</p>
        </a>
        <nav class="footer__nav nav">
            <a href="./" class="nav__link">главная</a>
            <a href="?page=catalog" class="nav__link">услуги</a>
            <?
                if(isset($_SESSION['uid'])) { ?>
                    <a href="?page=professional" class="nav__link">стать специалистом</a>
                <? }
                if($loggedUser['status'] == '2') { ?>
                    <a href="?page=catalog&services" class="nav__link">объявления</a>
                <? }
            ?>
        </nav>
    </div>
    <div class="footer__author">
        <p>© 2023 Kuzmin Ruslan</p>
        <div class="footer__socials">
            <a href="https://web.telegram.org/k/#@stupidplait" target="_blank">telegram</a>
            <a href="https://vk.com/stupidplait" target="_blank">vkontakte</a>
        </div>
    </div>
</footer>