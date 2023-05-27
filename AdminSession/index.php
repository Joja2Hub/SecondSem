<?php
    header('Content-Type: text/html; charset=UTF-8');
    try
    {
        //работа с coockie
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $messages = array();

            if (!empty($_COOKIE['save']))
            {
                setcookie('save', '', time() + 60 * 60 * 24);
                setcookie('login', '', time() + 60 * 60 * 24);
                setcookie('password', '', time() + 60 * 60 * 24);
                $messages[] = '<div style = "margin-left: 30px;">Данные были сохранены!</div>';
                if (!empty($_COOKIE['password']))
                {
                    $messages[] = sprintf('<div style = "margin-left: 30px;">Вы можете войти с этими данными для изменения внесённых ранее:</div>
                    <div style = "margin-left: 30px;">Логин: %s</div>
                    <div style = "margin-left: 30px;">Пароль: %s</div>',
                    strip_tags($_COOKIE['login']),
                    strip_tags($_COOKIE['password'])
                    );
                }
            }

            $errors = array();
            $errors['name'] = !empty($_COOKIE['Name_error']);
            $errors['email'] = !empty($_COOKIE['Email_error']);
            $errors['date'] = !empty($_COOKIE['Date_error']);
            $errors['gender'] = !empty($_COOKIE['Gender_error']);
            $errors['limb'] = !empty($_COOKIE['Limb_error']);
            $errors['superpowers'] = !empty($_COOKIE['Superpowers_error']);
            $errors['biography'] = !empty($_COOKIE['Biography_error']);
            $errors['signed'] = !empty($_COOKIE['Contract_error']);

            if ($errors['name']) { setcookie('Name_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Проверьте поле Имя!</div>'; }
            if ($errors['email']) { setcookie('Email_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Проверьте поле Почта!</div>'; }
            if ($errors['date']) { setcookie('Date_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Проверьте поле Дата!</div>'; }
            if ($errors['gender']) { setcookie('Gender_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Выберите Пол!</div>'; }
            if ($errors['limb']) { setcookie('Limb_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Выберите кол-во Конечностей!</div>'; }
            if ($errors['superpowers']) { setcookie('Superpowers_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Выберите Суперспособность(и)!</div>'; }
            if ($errors['biography']) { setcookie('Biography_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Проверьте поле Биография!</div>'; }
            if ($errors['signed']) { setcookie('Contract_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Поставьте галочку Ознакомления!</div>'; }

            if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login']))
            {
                $user = 'u52863';
                $password = '7320376';
                $database = new PDO('mysql:host=localhost;dbname=u52863', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                $statement = $database -> prepare("SELECT * FROM Person WHERE id_person = ?");
                $statement -> execute([$_SESSION['uid']]);
                $line = $statement -> fetch(PDO::FETCH_ASSOC);

                $values = array();
                $values['name'] = $line['name'];
                $values['email'] = $line['email'];
                $values['date'] = $line['date'];
                $values['gender'] = $line['gender'];
                $values['limb'] = $line['limb'];
                $values['biography'] = $line['biography'];
                $values['signed'] = $line['signed'];
                if ($_SESSION['login'] == 'Admin')
                {
                    $messages[] = '<div style = "margin-left: 30px;">Вы редактируете данные как Администратор:</div>';
                }
                else
                {
                    $messages[] = sprintf('<div style = "margin-left: 30px;">Вы вошли с этими данными:</div>
                        <div style = "margin-left: 30px;">Ваш логин: %s</div>
                        <div style = "margin-left: 30px;">Ваш номер: %s</div>',
                        strip_tags($_SESSION['login']),
                        strip_tags($_SESSION['uid'])
                        );
                }
            }

            else
            {
                $values = array();
                $values['name'] = empty($_COOKIE['Name_value']) ? '' : $_COOKIE['Name_value'];
                $values['email'] = empty($_COOKIE['Email_value']) ? '' : $_COOKIE['Email_value'];
                $values['date'] = empty($_COOKIE['Date_value']) ? '' : $_COOKIE['Date_value'];
                $values['gender'] = empty($_COOKIE['Gender_value']) ? '' : $_COOKIE['Gender_value'];
                $values['limb'] = empty($_COOKIE['Limb_value']) ? '' : $_COOKIE['Limb_value'];
                $values['superpowers'] = empty($_COOKIE['Superpowers_value']) ? '' : $_COOKIE['Superpowers_value'];
                $values['biography'] = empty($_COOKIE['Biography_value']) ? '' : $_COOKIE['Biography_value'];
                $values['signed'] = empty($_COOKIE['Contract_value']) ? '' : $_COOKIE['Contract_value'];
            }

            include('form.php');
        }

        else
        {
            $errors = FALSE;
            if (empty($_POST['name'])) { setcookie('Name_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if (empty($_POST['name']) || is_numeric($_POST['name']) || !preg_match('/^([А-ЯЁ]{1}[а-яё])|([A-Z]{1}[a-z])+$/u', $_POST['name']))
                {
                    setcookie('Name_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Name_value', $_POST['name'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['email'])) { setcookie('Email_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if (empty($_POST['email']) || is_numeric($_POST['email']) || !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-])*@[a-z0-9-]+(\.[a-z0-9-])*(\.[a-z]{2,4})$/', $_POST['email']))
                {
                    setcookie('Email_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Email_value', $_POST['email'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['date'])) { setcookie('Date_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['date'] == "2023-01-01" || empty($_POST['date']))
                {
                    setcookie('Date_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Date_value', $_POST['date'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['gender'])) { setcookie('Gender_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['gender'] != "Male" && $_POST['gender'] != "Female")
                {
                    setcookie('Gender_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Gender_value', $_POST['gender'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['limb'])) { setcookie('Limb_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['limb'] != 3 && $_POST['limb'] != 4 && $_POST['limb'] != 5)
                {
                    setcookie('Limb_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Limb_value', $_POST['limb'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['superpowers'])) { setcookie('Superpowers_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                setcookie("Superpowers_error", "", time() + 24 * 60 * 60);
                setcookie("1", "", time() + 24 * 60 * 60);
                setcookie("2", "", time() + 24 * 60 * 60);
                setcookie("3", "", time() + 24 * 60 * 60);
                $superpowers = $_POST["superpowers"];
                foreach ($superpowers as $cout)
                {
                    if ($cout == "1") setcookie("1", "true");
                    if ($cout == "2") setcookie("2", "true");
                    if ($cout == "3") setcookie("3", "true");
                }
            }
            if (empty($_POST['biography'])) { setcookie('Biography_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if (empty($_POST['biography']) || is_numeric($_POST['biography']) || !preg_match('/^[a-zA-Zа-яёА-ЯЁ0-9]/', $_POST['biography']))
                {
                    setcookie('Biography_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Biography_value', $_POST['biography'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['signed'])) { setcookie('Contract_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['signed'] == null)
                {
                    setcookie('Contract_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Contract_value', $_POST['signed'], time() + 60 * 60 * 24 * 31);
            }

            if ($errors)
            {
                header('Location: index.php');
                exit();
            }
            else
            {
                setcookie('Name_error', '', time() + 24 * 60 * 60);
                setcookie('Email_error', '', time() + 24 * 60 * 60);
                setcookie('Date_error', '', time() + 24 * 60 * 60);
                setcookie('Gender_error', '', time() + 24 * 60 * 60);
                setcookie('Limb_error', '', time() + 24 * 60 * 60);
                setcookie('Superpowers_error', '', time() + 24 * 60 * 60);
                setcookie('Biography_error', '', time() + 24 * 60 * 60);
                setcookie('Contract_error', '', time() + 24 * 60 * 60);
            }

            //подключаемся к базе данных
            $user = 'u52863';
            $password = '7320376';
            $database = new PDO('mysql:host=localhost;dbname=u52863', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login']))
            {
                $id_person = $_SESSION['uid'];
                $statement = $database -> prepare("UPDATE Person SET name = ?, email = ?, date = ?, gender = ?, limb = ?, biography = ?, signed = ? WHERE id_person = ?");
                $statement -> execute([$_POST['name'], $_POST['email'], $_POST['date'], $_POST['gender'], $_POST['limb'], $_POST['biography'], $_POST['signed'], $_SESSION['uid']]);
                $result = $database -> exec("DELETE FROM Connection WHERE id_person = '$id_person'");
                $statement_sup = $database -> prepare("INSERT INTO Connection SET id_person = ?, id_abil = ?");
                foreach($_POST['superpowers'] as $superpowers)
                    $statement_sup -> execute([$_SESSION['uid'], $superpowers]);
            }

            else
            {
                $user_login = uniqid('', true);
                $user_password = rand(100, 999);
                setcookie('login', $user_login);
                setcookie('password', $user_password);

                 //отправка данных в базу
                $statement = $database -> prepare("INSERT INTO Person (name, email, date, gender, limb, biography, signed) VALUES (:name, :email, :date, :gender, :limb, :biography, :signed)");
                $statement -> execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'date' => $_POST['date'], 'gender' => $_POST['gender'], 'limb' => $_POST['limb'], 'biography' => $_POST['biography'], 'signed' => $_POST['signed']]);
                $id_connection = $database -> lastInsertId();
                $statement = $database -> prepare("INSERT INTO Connection (id_person, id_abil) VALUES (:id_person, :id_abil)");
                foreach ($_POST['superpowers'] as $superpowers)
                {
                    if ($superpowers != false)
                    {
                        $statement -> execute(['id_person' => $id_connection, 'id_abil' => $superpowers]);
                    }
                }
                $statement = $database -> prepare("INSERT INTO User_Information SET Id_User = ?, User_Login = ?, User_Password = ?");
                $statement -> execute([$id_connection, $user_login, md5($user_password)]);
            }

            setcookie('save', '1');
            header('Location: index.php');
        }

    }
    //проверяем наличие ошибок
    catch (PDOException $e)
    {
        print('Error: ' .$e -> getMessage());
        exit();
    }

?>