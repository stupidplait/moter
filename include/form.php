<?
    $flag = true;
    $errorsArray = ['<p class="form__error">не менее 3 символов</p>',
                    '<p class="form__error">не более 50 символов</p>',
                    '<p class="form__error">не более 256 символов</p>',
                    '<p class="form__error">не менее 6 символов</p>',
                    '<p class="form__error">не менее 30 символов</p>',
                    '<p class="form__error">не более 350 символов</p>',
                    '<p class="form__error">не более 8 символов</p>',
                    '<p class="form__error">введи имя</p>',
                    '<p class="form__error">введи логин</p>',
                    '<p class="form__error">логин занят</p>',
                    '<p class="form__error">введи почту</p>',
                    '<p class="form__error">неверный формат почты</p>',
                    '<p class="form__error">почта занята</p>',
                    '<p class="form__error">введи пароль</p>',
                    '<p class="form__error">введи пароль повторно</p>',
                    '<p class="form__error">пароли не совпадают</p>',
                    '<p class="form__error">регистрация успешна</p>',
                    '<p class="form__error">введи логин/почту</p>',
                    '<p class="form__error">неверный логин/почта</p>',
                    '<p class="form__error">неверный пароль</p>',
                    '<p class="form__error">напиши что-то о себе</p>',
                    '<p class="form__error">выбери услугу</p>',
                    '<p class="form__error">введи стоимость</p>',
                    '<p class="form__error">введи число</p>',
                    '<p class="form__error">введи старый пароль</p>',
                    '<p class="form__error">данные обновлены</p>',
                    '<p class="form__error">введи название</p>',
                    '<p class="form__error">введи описание</p>',
                    '<p class="form__error">загрузи фото</p>',
                    '<p class="form__error">заказ создан</p>',
                    '<p class="form__error">успешно отправлено</p>',
                    '<p class="form__error">неверный формат фото</p>'];

    $imageExtensions = ['image/jpeg', 'image/gif', 'image/svg+xml', 'image/png', 'image/webp', 'image/pjpeg'];

    if($_GET['page'] == 'signup') {
        if(isset($_POST['signup'])) {
            $name = $_POST['name'];
            $login = $_POST['login'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $rPass = $_POST['rPass'];

            $sql = "SELECT email FROM users WHERE email = '$email'";
            $userEmail = $connect->query($sql)->fetchAll();

            $sql = "SELECT login FROM users WHERE login = '$login'";
            $userLogin = $connect->query($sql)->fetchAll();
        }?>
        <form action="#" method="post" name="signup">
            <input type="text" class="form__input" name="name" placeholder="твое имя/организация" value="<? if(isset($name)) echo $name; ?>">
            <?
                if(isset($_POST['signup'])) {
                    if(empty($name)) {
                        $flag = false;
                        echo $errorsArray[7];
                    } elseif(iconv_strlen($name) < 3) {
                        $flag = false;
                        echo $errorsArray[0];
                    } elseif(iconv_strlen($name) > 50) {
                        $flag = false;
                        echo $errorsArray[1];
                    }
                }
            ?>
            <input type="text" class="form__input" name="login" placeholder="твой логин" value="<? if(isset($login)) echo $login; ?>">
            <?
                if(isset($_POST['signup'])) {
                    if(empty($login)) {
                        $flag = false;
                        echo $errorsArray[8];
                    } elseif(iconv_strlen($login) < 3) {
                        $flag = false;
                        echo $errorsArray[0];
                    } elseif(iconv_strlen($login) > 50) {
                        $flag = false;
                        echo $errorsArray[1];
                    } elseif(!empty($userLogin)) {
                        $flag = false;
                        echo $errorsArray[9];
                    }
                }
            ?>
            <input type="text" class="form__input" name="email" placeholder="твоя почта" value="<? if(isset($email)) echo $email; ?>">
            <?
                if(isset($_POST['signup'])) {
                    if(empty($email)) {
                        $flag = false;
                        echo $errorsArray[10];
                    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $flag = false;
                        echo $errorsArray[11];
                    } elseif(iconv_strlen($email) > 256) {
                        $flag = false;
                        echo $errorsArray[2];
                    } elseif(!empty($userEmail)) {
                        $flag = false;
                        echo $errorsArray[12];
                    }
                }
            ?>
            <input type="password" class="form__input" name="pass" placeholder="твой пароль">
            <?
                if(isset($_POST['signup'])) {
                    if(empty($pass)) {
                        $flag = false;
                        echo $errorsArray[13];
                    } elseif(iconv_strlen($pass) < 6) {
                        $flag = false;
                        echo $errorsArray[3];
                    }
                }
            ?>
            <input type="password" class="form__input" name="rPass" placeholder="подтверждение пароля">
            <?
                if(isset($_POST['signup'])) {
                    if(empty($rPass)) {
                        $flag = false;
                        echo $errorsArray[14];
                    } elseif($pass != $rPass) {
                        $flag = false;
                        echo $errorsArray[15];
                    }
                }
            ?>
            <input type="submit" name="signup" class="form__btn btn gradient-bg" value="зарегистрироваться">
            <?
                if(isset($_POST['signup']) && $flag) {
                    $sql = "INSERT INTO users (name, login, email, pass) VALUES ('".trim($name)."', '".trim($login)."', '".trim($email)."', '".password_hash($pass, PASSWORD_DEFAULT)."')";
                    $connect->query($sql);
                    echo $errorsArray[16];?>

                    <script>setTimeout(() => document.location.href="?page=signin", 2000)</script>
                <?}
            ?>
        </form>
    <?} elseif($_GET['page'] == 'signin') {
            if(isset($_POST['signin'])) {
                $loginEmail = $_POST['loginEmail'];
                $pass = $_POST['pass'];

                $sql = "SELECT * FROM users WHERE email = '$loginEmail' OR login = '$loginEmail'";
                $correctUser = $connect->query($sql)->fetch();
            }?>
        <form action="#" method="post" name="signin">
            <input type="text" class="form__input" name="loginEmail" placeholder="логин/почта" value="<? if(isset($loginEmail)) echo $loginEmail; ?>">
            <?
                if(isset($_POST['signin'])) {
                    if(empty($loginEmail)) {
                        $flag = false;
                        echo $errorsArray[17];
                    } elseif(empty($correctUser)) {
                        $flag = false;
                        echo $errorsArray[18];
                    }
                }
            ?>
            <input type="password" class="form__input" name="pass" placeholder="пароль">
            <?
                if(isset($_POST['signin'])) {
                    if(empty($pass)) {
                        $flag = false;
                        echo $errorsArray[13];
                    } elseif(!password_verify($pass, $correctUser['pass'])) {
                        $flag = false;
                        echo $errorsArray[19];
                    }
                }
            ?>
            <input type="submit" name="signin" class="form__btn btn gradient-bg" value="войти">
            <?
                if(isset($_POST['signin']) && $flag) {
                    $_SESSION['uid'] = $correctUser['id'];?>

                    <script>document.location.href="./"</script>
                <?}
            ?>
        </form>
    <?} elseif($_GET['page'] == 'request') {
            if(isset($_POST['request'])) {
                $about = $_POST['about'];
                $serviceId = $_POST['service'];
                $price = $_POST['price'];
            }?>
        <form action="#" method="post" name="request">
            <textarea class="form__input" name="about" placeholder="расскажи о себе"><? if(isset($about)) echo $about; ?></textarea>
            <?
                if(isset($_POST['request'])) {
                    if(empty($about)) {
                        $flag = false;
                        echo $errorsArray[20];
                    } elseif(iconv_strlen($about) < 30) {
                        $flag = false;
                        echo $errorsArray[4];
                    } elseif(iconv_strlen($about) > 350) {
                        $flag = false;
                        echo $errorsArray[5];
                    }
                }
            ?>
            <div class="form__select">
                <select name="service" id="service" class="form__input">
                    <option <? if($serviceId == 0 || !isset($serviceId)) echo 'selected'; ?> hidden value="0">основная услуга</option>
                    <?
                        $sql = "SELECT * FROM services";
                        $result = $connect->query($sql);

                        foreach($result as $service) {?>
                            <option <? if($serviceId == $service['id']) echo 'selected'; ?> value="<?=$service['id']?>"><?=$service['name']?></option>
                        <?}
                    ?>
                </select>
                <label for="service">
                    <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 4.24219L5.24264 8.48483" stroke="#777777" stroke-linecap="round" />
                        <path d="M5.24268 8.48438L9.48532 4.24173" stroke="#777777"
                            stroke-linecap="round" />
                    </svg>
                </label>
            </div>
            <?
                if(isset($_POST['request'])) {
                    if(!$serviceId) {
                        $flag = false;
                        echo $errorsArray[21];
                    }
                }
            ?>
            <input type="text" class="form__input" name="price" placeholder="стоимость" value="<? if(isset($price)) echo $price; ?>">
            <?
                if(isset($_POST['request'])) {
                    if(empty($price)) {
                        $flag = false;
                        echo $errorsArray[22];
                    } elseif(!filter_var($price, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)))) {
                        $flag = false;
                        echo $errorsArray[23];
                    } elseif(iconv_strlen($price) > 8) {
                        $flag = false;
                        echo $errorsArray[6];
                    }
                }
            ?>
            <div class="form__bottom">
                <input type="submit" name="request" class="form__btn btn gradient-bg" value="отправить">
                <a href="?page=professional" class="form__btn btn gradient-border">отмена</a>
            </div>
            <?
                if(isset($_POST['request']) && $flag) {
                    $sql = "UPDATE users SET status = '1',
                                            about = '".trim($about)."',
                                            price = '".trim($price)."',
                                            date = '".date('d.m.Y')."',
                                            serviceId = '$serviceId'
                                            WHERE id = '".$loggedUser['id']."'";
                    $connect->query($sql);?>

                    <script>document.location.href="?page=professional"</script>
                <?}
            ?>
        </form>
    <?} elseif($_GET['page'] == 'profile') {
        if(isset($_POST['update'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $oldPass = $_POST['oldPass'];
            $about = $_POST['about'];
            $serviceId = $_POST['service'];
            $price = $_POST['price'];

            if($_FILES['image']['name'] == null) {
                $img = $loggedUser['img'];
            } else {
                $img = "assets/img/users/" . time() . $_FILES['image']['name'];
            }
        }?>
        <form action="#" method="post" name="update" enctype="multipart/form-data">
            <div class="profile__top">
                <h1 class="profile__title">профиль</h1>
                <div class="profile__burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <label for="image" class="form__file file">
                <input type="file" name="image" id="image">
                <div class="file__image">
                    <img src="<?=$loggedUser['img']?>" alt="image" id="image-holder">
                </div>
                <p class="file__text">*добавь свое собственное изображение</p>
                <?
                    if(isset($_POST['update'])) {
                        if($_FILES['image']['type'] != NULL && !in_array($_FILES['image']['type'], $imageExtensions)) {
                            $flag = false;
                            echo $errorsArray[31];
                        }
                    }
                ?>
            </label>
            <div class="form__column">
                <h5 class="profile__label">личные данные</h5>
                <input type="text" class="form__input" name="name" placeholder="мое имя"
                        value="<?
                            if(isset($name)) echo $name;
                            else echo $loggedUser['name'];
                        ?>">
                <?
                    if(isset($_POST['update'])) {
                        if(empty($name)) {
                            $flag = false;
                            echo $errorsArray[7];
                        } elseif(iconv_strlen($name) < 3) {
                            $flag = false;
                            echo $errorsArray[0];
                        } elseif(iconv_strlen($name) > 50) {
                            $flag = false;
                            echo $errorsArray[1];
                        }
                    }
                ?>
                <input type="text" class="form__input" name="email" placeholder="моя почта"
                        value="<?
                            if(isset($email)) echo $email;
                            else echo $loggedUser['email'];
                        ?>">
                <?
                    if(isset($_POST['update'])) {
                        if(empty($email)) {
                            $flag = false;
                            echo $errorsArray[10];
                        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $flag = false;
                            echo $errorsArray[11];
                        } elseif(iconv_strlen($email) > 256) {
                            $flag = false;
                            echo $errorsArray[2];
                        } elseif(!empty($userEmail) && ($email != $loggedUser['email'])) {
                            $flag = false;
                            echo $errorsArray[12];
                        }
                    }

                    if($loggedUser['status'] == 2) {?>
                        <h5 class="profile__label">специалист</h5>
                        <textarea class="form__input" name="about" placeholder="расскажи о себе"><?
                            if(isset($about)) echo $about;
                            else echo $loggedUser['about'];
                        ?></textarea>
                        <?
                            if(isset($_POST['update'])) {
                                if(empty($about)) {
                                    $flag = false;
                                    echo $errorsArray[20];
                                } elseif(iconv_strlen($about) < 30) {
                                    $flag = false;
                                    echo $errorsArray[4];
                                } elseif(iconv_strlen($about) > 350) {
                                    $flag = false;
                                    echo $errorsArray[5];
                                }
                            }
                        ?>
                        <div class="form__select">
                            <select name="service" id="service" class="form__input">
                                <?
                                    $sql = "SELECT * FROM services";
                                    $result = $connect->query($sql);

                                    foreach($result as $service) { ?>
                                        <option <? if($loggedUser['serviceId'] == $service['id']) echo 'selected'; ?> value="<?=$service['id']?>"><?=$service['name']?></option>
                                    <?}
                                ?>
                            </select>
                            <label for="service">
                                <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 4.24219L5.24264 8.48483" stroke="#777777" stroke-linecap="round" />
                                    <path d="M5.24268 8.48438L9.48532 4.24173" stroke="#777777"
                                        stroke-linecap="round" />
                                </svg>
                            </label>
                        </div>
                        <input type="text" class="form__input" name="price" placeholder="стоимость услуги"
                                value="<?
                                    if(isset($price)) echo $price;
                                    else echo $loggedUser['price'];
                                ?>">
                        <?
                            if(isset($_POST['update'])) {
                                if(empty($price)) {
                                    $flag = false;
                                    echo $errorsArray[22];
                                } elseif(!filter_var($price, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)))) {
                                    $flag = false;
                                    echo $errorsArray[23];
                                } elseif(iconv_strlen($price) > 8) {
                                    $flag = false;
                                    echo $errorsArray[6];
                                }
                            }
                        }
                    ?>
                <h5 class="profile__label">пароль</h5>
                <input type="password" class="form__input" name="pass" placeholder="новый пароль">
                <?
                    if(isset($_POST['update'])) {
                        if(empty($pass) && !empty($oldPass)) {
                            $flag = false;
                            echo $errorsArray[13];
                        } elseif(!empty($oldPass) && iconv_strlen($pass) < 6) {
                            $flag = false;
                            echo $errorsArray[3];
                        }
                    }
                ?>
                <input type="password" class="form__input" name="oldPass" placeholder="старый пароль">
                <?
                    if(isset($_POST['update'])) {
                        if(empty($oldPass) && !empty($pass)) {
                            $flag = false;
                            echo $errorsArray[24];
                        } elseif(!empty($oldPass) && !password_verify($oldPass, $loggedUser['pass'])) {
                            $flag = false;
                            echo $errorsArray[19];
                        }
                    }
                ?>
                <input type="submit" name="update" class="form__btn btn gradient-bg"
                    value="подтвердить изменения">
                <?
                    if(isset($_POST['update']) && $flag) {
                        if(($_FILES['image']['name'] != null)) {
                            move_uploaded_file($_FILES['image']['tmp_name'], $img);

                            if($loggedUser['img'] != 'assets/img/users/default.svg') unlink($loggedUser['img']);
                        }

                        $sql = "UPDATE users SET name = '".trim($name)."',"
                                            . (($loggedUser['status'] > 1) ? " about = '".trim($about)."',
                                            price = '".trim($price)."',
                                            serviceId = '$serviceId'," : " ") .
                                            ((!empty($oldPass)) ? " pass = '".password_hash($pass, PASSWORD_DEFAULT)."', " : " ") .
                                            "email = '".trim($email)."',
                                            img = '$img'
                                            WHERE id = '".$loggedUser['id']."'";

                        $connect->query($sql);
                        echo $errorsArray[25];?>

                        <script>setTimeout(() => document.location.href="?page=profile", 2000)</script>
                    <?}
                ?>
            </div>
        </form>
    <?} elseif($_GET['page'] == 'add') {
        if(isset($_POST['add'])) {
            $name = $_POST['name'];
            $about = $_POST['about'];
            $price = $_POST['price'];
            $serviceId = $_POST['service'];

            $img = "assets/img/orders/" . time() . $_FILES['image']['name'];
        }?>
        <form action="#" method="post" name="add" enctype="multipart/form-data">
            <input type="text" class="form__input" name="name" placeholder="название" value="<? if(isset($name)) echo $name; ?>">
            <?
                if(isset($_POST['add'])) {
                    if(empty($name)) {
                        $flag = false;
                        echo $errorsArray[26];
                    } elseif(iconv_strlen($name) < 3) {
                        $flag = false;
                        echo $errorsArray[0];
                    } elseif(iconv_strlen($name) > 50) {
                        $flag = false;
                        echo $errorsArray[1];
                    }
                }
            ?>
            <textarea class="form__input" name="about" placeholder="описание"><? if(isset($about)) echo $about; ?></textarea>
            <?
                if(isset($_POST['add'])) {
                    if(empty($about)) {
                        $flag = false;
                        echo $errorsArray[27];
                    } elseif(iconv_strlen($about) < 30) {
                        $flag = false;
                        echo $errorsArray[4];
                    } elseif(iconv_strlen($about) > 350) {
                        $flag = false;
                        echo $errorsArray[5];
                    }
                }
            ?>
            <input type="text" class="form__input" name="price" placeholder="стоимость" value="<? if(isset($price)) echo $price; ?>">
            <?
                if(isset($_POST['add'])) {
                    if(empty($price)) {
                        $flag = false;
                        echo $errorsArray[22];
                    } elseif(!filter_var($price, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)))) {
                        $flag = false;
                        echo $errorsArray[23];
                    } elseif(iconv_strlen($price) > 8) {
                        $flag = false;
                        echo $errorsArray[6];
                    }
                }
            ?>
            <div class="form__select">
                <select name="service" id="service" class="form__input">
                    <option <? if($serviceId == 0 || !isset($serviceId)) echo 'selected'; ?> hidden value="0">основная услуга</option>
                    <?
                        $sql = "SELECT * FROM services";
                        $result = $connect->query($sql);

                        foreach($result as $service) {?>
                            <option <? if($serviceId == $service['id']) echo 'selected'; ?> value="<?=$service['id']?>"><?=$service['name']?></option>
                        <?}
                    ?>
                </select>
                <label for="service">
                    <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 4.24219L5.24264 8.48483" stroke="#777777" stroke-linecap="round" />
                        <path d="M5.24268 8.48438L9.48532 4.24173" stroke="#777777"
                            stroke-linecap="round" />
                    </svg>
                </label>
            </div>
            <?
                if(isset($_POST['add'])) {
                    if(!$serviceId) {
                        $flag = false;
                        echo $errorsArray[21];
                    }
                }
            ?>
            <label for="image" class="form__file file">
                <input type="file" name="image" id="image">
                <p class="file__btn btn gradient-border">выбор файла</p>
                <p class="file__text">прикрепи<span> фото</span></p>
            </label>
            <?
                if(isset($_POST['add'])) {
                    if($_FILES['image']['name'] == null) {
                        $flag = false;
                        echo $errorsArray[28];
                    } elseif(!in_array($_FILES['image']['type'], $imageExtensions)) {
                        $flag = false;
                        echo $errorsArray[31];
                    }
                }
            ?>
            <div class="form__bottom">
                <input type="submit" name="add" class="form__btn btn gradient-bg" value="создать">
                <a href="?page=catalog" class="form__btn btn gradient-border">отмена</a>
            </div>
            <?
                if(isset($_POST['add']) && $flag) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $img);

                    $sql = "INSERT INTO orders (name, about, price, img, date, serviceId, userId) VALUES ('".trim($name)."', '".trim($about)."', '".trim($price)."', '$img', '".date('d.m.Y')."', '$serviceId', '".$loggedUser['id']."')";
                    $connect->query($sql);
                    echo $errorsArray[29];?>

                    <script>setTimeout(() => document.location.href="?page=profile&orders", 2000)</script>
                <?}
            ?>
        </form>
    <?} elseif($_GET['page'] == 'update') {
        $sql = "SELECT * FROM orders WHERE id = '".$_GET['id']."'";
        $selectedOrder = $connect->query($sql)->fetch();

        if(isset($_POST['update'])) {
            $name = $_POST['name'];
            $about = $_POST['about'];
            $price = $_POST['price'];
            $serviceId = $_POST['service'];

            if($_FILES['image']['name'] == null) {
                $img = $selectedOrder['img'];
            } else {
                $img = "assets/img/orders/" . time() . $_FILES['image']['name'];
            }
        }?>
        <form action="#" method="post" name="update" enctype="multipart/form-data">
            <input type="text" class="form__input" name="name" placeholder="название"
                    value="<?
                        if(isset($name)) echo $name;
                        else echo $selectedOrder['name'];
                    ?>">
            <?
                if(isset($_POST['update'])) {
                    if(empty($name)) {
                        $flag = false;
                        echo $errorsArray[7];
                    } elseif(iconv_strlen($name) < 3) {
                        $flag = false;
                        echo $errorsArray[0];
                    } elseif(iconv_strlen($name) > 50) {
                        $flag = false;
                        echo $errorsArray[1];
                    }
                }
            ?>
            <textarea class="form__input" name="about" placeholder="описание"><?
                if(isset($about)) echo $about;
                else echo $selectedOrder['about'];
            ?></textarea>
            <?
                if(isset($_POST['update'])) {
                    if(empty($about)) {
                        $flag = false;
                        echo $errorsArray[27];
                    } elseif(iconv_strlen($about) < 30) {
                        $flag = false;
                        echo $errorsArray[4];
                    } elseif(iconv_strlen($about) > 350) {
                        $flag = false;
                        echo $errorsArray[5];
                    }
                }
            ?>
            <input type="text" class="form__input" name="price" placeholder="стоимость"
                    value="<?
                        if(isset($price)) echo $price;
                        else echo $selectedOrder['price'];
                    ?>">
            <?
                if(isset($_POST['update'])) {
                    if(empty($price)) {
                        $flag = false;
                        echo $errorsArray[22];
                    } elseif(!filter_var($price, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)))) {
                        $flag = false;
                        echo $errorsArray[23];
                    } elseif(iconv_strlen($price) > 8) {
                        $flag = false;
                        echo $errorsArray[6];
                    }
                }
            ?>
            <div class="form__select">
                <select name="service" id="service" class="form__input">
                    <?
                        $sql = "SELECT * FROM services";
                        $result = $connect->query($sql);

                        foreach($result as $service) { ?>
                            <option <? if($selectedOrder['serviceId'] == $service['id']) echo 'selected'; ?> value="<?=$service['id']?>"><?=$service['name']?></option>
                        <?}
                    ?>
                </select>
                <label for="service">
                    <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 4.24219L5.24264 8.48483" stroke="#777777" stroke-linecap="round" />
                        <path d="M5.24268 8.48438L9.48532 4.24173" stroke="#777777"
                            stroke-linecap="round" />
                    </svg>
                </label>
            </div>
            <label for="image" class="form__file file">
                <input type="file" class="file__image" name="image" id="image">
                <p class="file__btn btn gradient-border">выбор файла</p>
                <p class="file__text">прикрепи<span> фото</span></p>
            </label>
            <?
                if(isset($_POST['update'])) {
                    if($_FILES['image']['type'] != NULL && !in_array($_FILES['image']['type'], $imageExtensions)) {
                        $flag = false;
                        echo $errorsArray[31];
                    }
                }
            ?>
            <div class="form__bottom">
                <input type="submit" name="update" class="form__btn btn gradient-bg" value="отправить">
                <a href="?page=item&id=<?=$selectedOrder['id']?>" class="form__btn btn gradient-border">отмена</a>
            </div>
            <?
                if(isset($_POST['update']) && $flag) {
                    if($_FILES['image']['name'] != null) {
                        unlink($selectedOrder['img']);
                        move_uploaded_file($_FILES['image']['tmp_name'], $img);
                    }

                    $sql = "UPDATE orders SET name = '".trim($name)."',
                                                about = '".trim($about)."',
                                                price = '".trim($price)."',
                                                img = '$img',
                                                date = '".date('d.m.Y')."',
                                                status = '1',
                                                serviceId = '$serviceId'
                                                WHERE id = '".$selectedOrder['id']."'";
                    $connect->query($sql);
                    echo $errorsArray[25];?>

                    <script>setTimeout(() => document.location.href="?page=profile&orders", 2000)</script>
                <?}
            ?>
        </form>
    <?} elseif($_GET['page'] == 'delete') {
        $sql = "SELECT * FROM orders WHERE id = '".$_GET['id']."'";
        $result = $connect->query($sql)->fetch();

        if(isset($_POST['delete'])) {
            unlink($result['img']);
            $sql = "DELETE FROM orders WHERE id = '".$result['id']."'";
            $connect->query($sql);?>

            <script>document.location.href="?page=profile&orders"</script>
        <?}?>
        <form action="#" method="post" name="delete">
            <h5 class="form__text">
                ты уверен, что хочешь удалить свой заказ ‘<?=$result['name']?>’ со стоимостью в <?=number_format($result['price'], 0, '', '.')?> руб.?
            </h5>
            <div class="form__bottom">
                <input type="submit" name="delete" class="form__btn btn gradient-bg" value="удалить">
                <a href="?page=item&id=<?=$result['id']?>" class="form__btn btn gradient-border">отмена</a>
            </div>
        </form>
    <?} elseif($_GET['page'] == 'appeal') {
        $sql = "SELECT users.*, services.name AS serviceName FROM users INNER JOIN services ON users.serviceId = services.id HAVING id = '".$_GET['id']."'";
        $result = $connect->query($sql)->fetch();
        
        if(isset($_POST['appeal'])) {
            $name = $_POST['name'];
            $about = $_POST['about'];
            $price = $result['price'];
            $serviceId = $result['serviceId'];
            $professionalId = $result['id'];

            $img = "assets/img/orders/" . time() . $_FILES['image']['name'];
        }?>
        <form action="#" method="post" name="appeal" enctype="multipart/form-data">
            <input type="text" class="form__input" name="name" placeholder="название" value="<? if(isset($name)) echo $name; ?>">
            <?
                if(isset($_POST['appeal'])) {
                    if(empty($name)) {
                        $flag = false;
                        echo $errorsArray[26];
                    } elseif(iconv_strlen($name) < 3) {
                        $flag = false;
                        echo $errorsArray[0];
                    } elseif(iconv_strlen($name) > 50) {
                        $flag = false;
                        echo $errorsArray[1];
                    }
                }
            ?>
            <textarea class="form__input" name="about" placeholder="описание"><? if(isset($about)) echo $about; ?></textarea>
            <?
                if(isset($_POST['appeal'])) {
                    if(empty($about)) {
                        $flag = false;
                        echo $errorsArray[27];
                    } elseif(iconv_strlen($about) < 30) {
                        $flag = false;
                        echo $errorsArray[4];
                    } elseif(iconv_strlen($about) > 350) {
                        $flag = false;
                        echo $errorsArray[5];
                    }
                }
            ?>
            <input readonly type="text" class="form__input" placeholder="стоимость" value="<?=number_format($result['price'], 0, '', '.')?> ₽">
            <div class="form__select">
                <select name="service" id="service" class="form__input">
                    <option value="<?=$result['serviceId']?>"><?=$result['serviceName']?></option>
                </select>
                <label for="service">
                    <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 4.24219L5.24264 8.48483" stroke="#777777" stroke-linecap="round" />
                        <path d="M5.24268 8.48438L9.48532 4.24173" stroke="#777777"
                            stroke-linecap="round" />
                    </svg>
                </label>
            </div>
            <label for="image" class="form__file file">
                <input type="file" name="image" id="image">
                <p class="file__btn btn gradient-border">выбор файла</p>
                <p class="file__text">прикрепи<span> фото</span></p>
            </label>
            <?
                if(isset($_POST['appeal'])) {
                    if($_FILES['image']['name'] == null) {
                        $flag = false;
                        echo $errorsArray[28];
                    } elseif(!in_array($_FILES['image']['type'], $imageExtensions)) {
                        $flag = false;
                        echo $errorsArray[31];
                    }
                }
            ?>
            <div class="form__bottom">
                <input type="submit" name="appeal" class="form__btn btn gradient-bg" value="создать">
                <a href="?page=catalog" class="form__btn btn gradient-border">отмена</a>
            </div>
            <?
                if(isset($_POST['appeal']) && $flag) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $img);

                    $sql = "INSERT INTO orders (name, about, price, img, date, status, serviceId, userId, professionalId) VALUES ('".trim($name)."', '".trim($about)."', '$price', '$img', '".date('d.m.Y')."', '2', '$serviceId', '".$loggedUser['id']."', '$professionalId')";
                    $connect->query($sql);
                    echo $errorsArray[30]?>

                    <script>setTimeout(() => document.location.href="?page=catalog", 2000)</script>
                <?}
            ?>
        </form>
    <?} elseif($_GET['page'] == 'catalog') {
        if(isset($_GET['filter'])) {
            $text = $_GET['text'];
            $services = $_GET['service'];

            if(!empty($text)) {
                $sql .= " AND name LIKE '%$text%'";
            }

            if(!empty($services)) {
                for($i = 0; $i < count($services); $i++) {
                    if(!$i) {
                        $sql .= " AND (serviceId = '".$services[$i]."'";
                    } else {
                        $sql .= " OR serviceId = '".$services[$i]."'";
                    }

                    if($i == count($services) - 1) {
                        $sql .= ")";
                    }
                }
            }
        }?>
        <form action="#" method="get" name="filter" class="catalog__filter">
            <input hidden type="text" name="page" value="catalog">
            <?
                if(isset($_GET['services'])) {?>
                    <input hidden type="text" name="services">
                <?}
            ?>
            <div class="catalog__search">
                <input placeholder="введи текст..." type="text" name="text" value="<? if(isset($_GET['filter'])) echo $text; ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M23.6556 22.5653C21.6989 20.6454 19.7505 18.7196 17.7903 16.8032C17.6134 16.6309 17.6286 16.5418 17.7786 16.3637C19.8477 13.9163 20.6175 11.0998 19.9953 7.9597C19.4658 5.29082 17.9895 3.20213 15.7317 1.69949C13.5115 0.220298 11.0569 -0.283707 8.42534 0.149972C5.83015 0.576617 3.70712 1.83897 2.1008 3.9136C0.117198 6.47347 -0.455737 9.36271 0.357386 12.4864C1.03225 15.0779 2.59289 17.0435 4.8776 18.4289C7.05452 19.7487 9.41421 20.1425 11.9051 19.7182C13.5068 19.4463 14.9655 18.8028 16.2566 17.8065C16.4031 17.6929 16.4851 17.68 16.6316 17.8253C18.5671 19.744 20.512 21.6534 22.4523 23.5663C22.6234 23.735 22.7944 23.8991 23.0159 23.9999H23.3908C23.6813 23.9085 23.8782 23.7128 24 23.4385V23.0165C23.8911 22.8618 23.7938 22.7013 23.6556 22.5653ZM15.8161 16.1703C14.6644 17.2111 13.3146 17.8945 11.795 18.1687C8.99242 18.6751 6.47924 18.0187 4.3363 16.1093C2.94321 14.8681 2.05627 13.3162 1.73173 11.4772C1.25604 8.77783 1.93794 6.38556 3.76805 4.33907C5.01234 2.94778 6.57883 2.09566 8.39605 1.71473C9.4189 1.50141 10.4558 1.48617 11.4892 1.65847C13.1904 1.94095 14.6831 2.65827 15.9497 3.83272C17.2068 4.99779 18.0293 6.41838 18.423 8.08512C18.5659 8.69227 18.6374 9.31114 18.6316 9.93938C18.5894 12.4196 17.6603 14.5047 15.8161 16.1703Z"
                        fill="#777777" />
                </svg>
            </div>
            <div class="catalog__checkboxes">
                <?
                    $serviceSql = "SELECT * FROM services";
                    $result = $connect->query($serviceSql)->fetchAll();

                    for($i = 0; $i < count($result); $i++) {
                        if(isset($_GET['services'])) {
                            $serviceSql = "SELECT COUNT(*) AS quantity FROM orders WHERE status = '3' AND serviceId = '".$result[$i]['id']."' AND userId != '".$loggedUser['id']."'" . ((!empty($text)) ? " AND name LIKE '%$text%'" : "");
                        } else {
                            $serviceSql = "SELECT COUNT(*) AS quantity FROM users WHERE status ='2' AND serviceId = '".$result[$i]['id']."'" . ((!empty($text)) ? " AND name LIKE '%$text%'" : "") . ((isset($_SESSION['uid'])) ? " AND id != '".$loggedUser['id']."'" : "");
                        }

                        $serviceCount = $connect->query($serviceSql)->fetch();?>
                        <label class="catalog__checkbox" for="service<?=$i?>">
                            <input <? if(isset($_GET['service']) && in_array($result[$i]['id'], $_GET['service'])) echo 'checked'; ?> type="checkbox" name="service[]" id="service<?=$i?>" value="<?=$result[$i]['id']?>">
                            <p class="catalog__category"><?=$result[$i]['name']?> (<? if($serviceCount == null) {
                                                                                            echo '0';
                                                                                        } else {
                                                                                            echo $serviceCount['quantity'];
                                                                                        }?>)</p>
                        </label>
                    <?}
                ?>
            </div>
            <div class="catalog__buttons">
                <input type="submit" class="catalog__btn gradient-bg btn" value="подтвердить" name="filter">
                <a href="?page=catalog" class="catalog__btn gradient-border btn">сбросить</a>
            </div>
        </form>
    <?}
?>