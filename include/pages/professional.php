<section class="banner" id="banner-professional">
    <div class="banner__content">
        <h1 class="banner__title">
            присоединись к команде <span class="blue">специалистов</span><span> прямо сейчас</span>
        </h1>
        <p class="banner__text">
            начни предоставлять <span class="blue">собственные услуги</span> прямо сейчас! для этого тебе
            достаточно лишь оставить свою <span class="blue">заявку</span> и дождаться ее рассмотрения
            администрацией, после чего ты сможешь начать зарабатывать
        </p>
        <?
            if(isset($_SESSION['uid']) && !$loggedUser['status']) {?>
                <a href="?page=request" class="banner__btn btn big-btn gradient-bg">подать заявку</a>
            <?} elseif($loggedUser['status'] == 1) {?>
                <p class="banner__btn btn big-btn gradient-bg">заявка на рассмотрении</p>
            <?} else {?>
                <p class="banner__btn btn big-btn gradient-bg">заявка одобрена</p>
            <?}
        ?>
    </div>
    <div class="banner__image">
        <img src="assets/img/banner/bg.png" alt="background">
    </div>
</section>
<section class="what">
    <div class="what__icon">
        <img src="assets/img/what/questions.svg" alt="icon">
    </div>
    <div class="what__body">
        <h2 class="what__title">что это даст тебе?</h2>
        <h5 class="what__label">возможность продвигать свои услуги</h5>
        <p class="what__text">
            ты появишься в разделе “услуги”, где любой пользователь сможет найти твою карточку, благодаря
            чему у них будет возможность заказать у тебя услугу
        </p>
        <h5 class="what__label">отзываться на заказы услуг</h5>
        <p class="what__text">
            для тебя станет доступен раздел “заказы”, где пользователи размещают собственные заказы услуг,
            на которые могут отзываться все специалисты на сайте
        </p>
        <h5 class="what__label">иметь собственный рейтинг</h5>
        <p class="what__text">
            по завершении выполнения услуги пользователь сможет оценить качество выполненной вами работы,
            после чего его отзыв будет отображаться в вашем профиле
        </p>
    </div>
</section>