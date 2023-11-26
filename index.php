<?
    // connect to database
    require('include/connect.php');

    // user session
    session_start();

    // last info about user
    if(isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        $sql = "SELECT * FROM users WHERE id = '$uid'";
        $loggedUser = $connect->query($sql)->fetch();
    }

    // session restart
    if(isset($_GET['exit'])) {
        session_unset(); ?>
        <script>document.location.href="./"</script>
    <?}

    // current page
    $currentPage = "?" . http_build_query($_GET);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>moter</title>
</head>

<body>
    <div class="container">
        <!-- header -->
        <? require('include/header.php'); ?>
        <!-- content -->
        <main>
            <?
                if(isset($_GET['page'])) {
                    if($_GET['page'] == 'catalog') {
                        if(!isset($_GET['services'])) require('include/pages/catalog.php');
                        elseif(isset($_GET['services']) && ($loggedUser['status'] == 2)) require('include/pages/catalog.php');
                        else {?>
                            <section class="error">
                                <h1 class="error__title">у тебя нет доступа</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                        <?}
                    } elseif($_GET['page'] == 'signup' || $_GET['page'] == 'signin') {
                        if(!isset($_SESSION['uid'])) require('include/pages/'.$_GET['page'].'.php');
                        else {?>
                            <section class="error">
                                <h1 class="error__title">ты уже авторизован</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="./", 2000)</script>
                        <?}
                    } elseif($_GET['page'] == 'professional') {
                        if(isset($_SESSION['uid'])) require('include/pages/professional.php');
                        else {?>
                            <section class="error">
                                <h1 class="error__title">у тебя нет доступа</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                        <?}
                    } elseif($_GET['page'] == 'request') {
                        if(isset($_SESSION['uid'])) {
                            if(!$loggedUser['status']) require('include/pages/request.php');
                            else {?>
                                <section class="error">
                                    <h1 class="error__title">у тебя нет доступа</h1>
                                </section>
                                <script>setTimeout(() => document.location.href="?page=professional", 2000)</script>
                            <?}
                        }
                        else {?>
                            <section class="error">
                                <h1 class="error__title">у тебя нет доступа</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                        <?}
                    } elseif($_GET['page'] == 'add') {
                        if(isset($_SESSION['uid'])) require('include/pages/add.php');
                        else {?>
                            <section class="error">
                                <h1 class="error__title">у тебя нет доступа</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                        <?}
                    } elseif($_GET['page'] == 'update') {
                        if(isset($_SESSION['uid'])) {
                            if(isset($_GET['id']) && !empty($_GET['id'])) {
                                $sql = "SELECT * FROM orders WHERE id = '".$_GET['id']."'";
                                $result = $connect->query($sql)->fetch();

                                if($result == null) {?>
                                    <section class="error">
                                        <h1 class="error__title">неизвестный идентификатор</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="?page=profile&orders", 2000)</script>
                                <?} elseif($loggedUser['id'] == $result['userId'] && $result['status'] != 4) require('include/pages/update.php');
                                else {?>
                                    <section class="error">
                                        <h1 class="error__title">у тебя нет доступа</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="?page=profile&orders", 2000)</script>
                                <?}
                            } else {?>
                                <section class="error">
                                    <h1 class="error__title">не выбран идентификатор</h1>
                                </section>
                                <script>setTimeout(() => document.location.href="?page=profile&orders", 2000)</script>
                            <?}
                        } else {?>
                            <section class="error">
                                <h1 class="error__title">у тебя нет доступа</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                        <?}
                    } elseif($_GET['page'] == 'delete') {
                        if(isset($_SESSION['uid'])) {
                            if(isset($_GET['id']) && !empty($_GET['id'])) {
                                $sql = "SELECT * FROM orders WHERE id = '".$_GET['id']."'";
                                $result = $connect->query($sql)->fetch();

                                if($result == null) {?>
                                    <section class="error">
                                        <h1 class="error__title">неизвестный идентификатор</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="?page=profile&orders", 2000)</script>
                                <?} elseif($loggedUser['id'] == $result['userId'] && ($result['status'] >= 1 && $result['status'] <= 3)) require('include/pages/update.php');
                                else {?>
                                    <section class="error">
                                        <h1 class="error__title">у тебя нет доступа</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="?page=profile&orders", 2000)</script>
                                <?}
                            } else {?>
                                <section class="error">
                                    <h1 class="error__title">не выбран идентификатор</h1>
                                </section>
                                <script>setTimeout(() => document.location.href="?page=profile&orders", 2000)</script>
                            <?}
                        } else {?>
                            <section class="error">
                                <h1 class="error__title">у тебя нет доступа</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                        <?}
                    } elseif($_GET['page'] == 'profile') {
                        if(isset($_SESSION['uid'])) {
                            if(isset($_GET['admin'])) {
                                if($loggedUser['roleId'] == '2') require('include/pages/profile.php');
                                else {?>
                                    <section class="error">
                                        <h1 class="error__title">у тебя нет доступа</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="./", 2000)</script>
                                <?}
                            } elseif(isset($_GET['orders'])) require('include/pages/profile.php');
                            elseif(isset($_GET['services'])) {
                                if($loggedUser['status'] == '2') require('include/pages/profile.php');
                                else {?>
                                    <section class="error">
                                        <h1 class="error__title">у тебя нет доступа</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="./", 2000)</script>
                                <?}
                            } elseif(isset($_GET['id'])) {
                                if(!empty($_GET['id'])) {
                                    $sql = "SELECT * FROM users WHERE id = '".$_GET['id']."'";
                                    $result = $connect->query($sql)->fetch();

                                    if($result == null) {?>
                                        <section class="error">
                                            <h1 class="error__title">неизвестный идентификатор</h1>
                                        </section>
                                        <script>setTimeout(() => document.location.href="?page=profile", 2000)</script>
                                    <?} elseif(($loggedUser['roleId'] == '2' && $result['status'] > 0) || $result['status'] == '2') require('include/pages/profile.php');
                                    else {?>
                                        <section class="error">
                                            <h1 class="error__title">у тебя нет доступа</h1>
                                        </section>
                                        <script>setTimeout(() => document.location.href="?page=profile", 2000)</script>
                                    <?}
                                } else {?>
                                    <section class="error">
                                        <h1 class="error__title">не выбран идентификатор</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="?page=profile", 2000)</script>
                                <?}
                            } else require('include/pages/profile.php');
                        } else {?>
                            <section class="error">
                                <h1 class="error__title">у тебя нет доступа</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                        <?}
                    } elseif($_GET['page'] == 'appeal') {
                        if(isset($_SESSION['uid'])) {
                            if(isset($_GET['id']) && !empty($_GET['id'])) {
                                $sql = "SELECT * FROM users WHERE id = '".$_GET['id']."' AND status = '2'";
                                $result = $connect->query($sql)->fetch();

                                if($result == null) {?>
                                    <section class="error">
                                        <h1 class="error__title">неизвестный идентификатор</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="?page=catalog", 2000)</script>
                                <?} elseif($result['id'] == $loggedUser['id']) {?>
                                    <section class="error">
                                        <h1 class="error__title">у тебя нет доступа</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="?page=catalog", 2000)</script>
                                <?} else require('include/pages/appeal.php');
                            } else {?>
                                <section class="error">
                                    <h1 class="error__title">не выбран идентификатор</h1>
                                </section>
                                <script>setTimeout(() => document.location.href="?page=catalog", 2000)</script>
                            <?}
                        } else {?>
                            <section class="error">
                                <h1 class="error__title">у тебя нет доступа</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                        <?}
                    } elseif($_GET['page'] == 'item') {
                        if(isset($_SESSION['uid'])) {
                            if(isset($_GET['id']) && !empty($_GET['id'])) {
                                $sql = "SELECT * FROM orders WHERE id = '".$_GET['id']."'";
                                $result = $connect->query($sql)->fetch();

                                if($result == null) {?>
                                    <section class="error">
                                        <h1 class="error__title">неизвестный идентификатор</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="?page=catalog&services", 2000)</script>
                                <?} elseif($loggedUser['id'] == $result['userId']) require('include/pages/item.php');
                                elseif(($result['status'] == 2 || $result['status'] == 4) && $loggedUser['id'] == $result['professionalId']) require('include/pages/item.php');
                                elseif($result['status'] == 1 && $loggedUser['roleId'] == 2) require('include/pages/item.php');
                                elseif($result['status'] == 3 && $loggedUser['status'] == 2) require('include/pages/item.php');
                                else {?>
                                    <section class="error">
                                        <h1 class="error__title">у тебя нет доступа</h1>
                                    </section>
                                    <script>setTimeout(() => document.location.href="?page=catalog&services", 2000)</script>
                                <?}
                            } else {?>
                                <section class="error">
                                    <h1 class="error__title">не выбран идентификатор</h1>
                                </section>
                                <script>setTimeout(() => document.location.href="?page=catalog&services", 2000)</script>
                            <?}
                        } else {?>
                            <section class="error">
                                <h1 class="error__title">у тебя нет доступа</h1>
                            </section>
                            <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                        <?}
                    } else {?>
                        <section class="error">
                            <h1 class="error__title">неизвестная страница</h1>
                        </section>
                        <script>setTimeout(() => document.location.href="./", 2000)</script>
                    <?}
                } else require('include/pages/main.php');
            ?>
        </main>
        <!-- footer -->
        <? require('include/footer.php'); ?>
    </div>
    <script>
        document.getElementById('image').onchange = function () {
            document.querySelector('.file__text').textContent = this.files[0].name;
            document.getElementById('image-holder').src = window.URL.createObjectURL(this.files[0]);
        }
    </script>
</body>

</html>