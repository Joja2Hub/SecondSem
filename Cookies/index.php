<?php

//  Отправляем браузеру кодировку
header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, "ru_RU.UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //  Массив для хранения сообщений пользователю
    $messages = array();
    // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', time() + 24 * 60 * 60);
        $messages[] = 'Результаты были сохранены!';
    }
    //  Массив для хранения ошибок
    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['date'] = !empty($_COOKIE['date_error']);
    $errors['gender'] = !empty($_COOKIE['gender_error']);
    $errors['limb'] = !empty($_COOKIE['limb_error']);
    $errors['superpowers'] = !empty($_COOKIE['superpowers_error']);
    $errors['biography'] = !empty($_COOKIE['biography_error']);
    $errors['signed'] = !empty($_COOKIE['signed_error']);

    //  Сообщения об ошибках
    if ($errors['name']) {
        setcookie('name_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Введите ФИО.</div>';
    }
    if ($errors['email']) {
        setcookie('email_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Введите email.</div>';
    }
    if ($errors['date']) {
        setcookie('date_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите дату рождения.</div>';
    }
    if ($errors['gender']) {
        setcookie('gender_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите пол.</div>';
    }
    if ($errors['limb']) {
        setcookie('limb_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите кол-во конечностей.</div>';
    }
    if ($errors['superpowers']) {
        setcookie('superpowers_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите суперсилы.</div>';
    }
    if ($errors['signed']) {
        setcookie('signed_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Согласитесь с условиями.</div>';
    }

    //  Сохраняем значения полей в массив
    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
    $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
    $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
    $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
    $values['limb'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
    $values['superpowers'] = empty($_COOKIE['superpowers_value']) ? '' : $_COOKIE['superpowers_value'];
    $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
    $values['signed'] = empty($_COOKIE['signed_value']) ? '' : $_COOKIE['signed_value'];

    //  Включаем файл form.php
    //  в него передаются переменные $messages, $errors, $values
    include('form.php');
} else {
    //  Если метод был POST
    //  Флаг для отлова ошибок полей
    $errors = FALSE;
    if (empty($_POST['name'])) {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u', $_POST['name'])) {
            setcookie('name_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('name_value', $_POST['name'], time() + 31 * 24 * 60 * 60);
        }
    }
    if (empty($_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $_POST['email'])) {
            setcookie('email_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('email_value', $_POST['email'], time() + 31 * 24 * 60 * 60);
        }
    }
    if (empty($_POST['date'])) {
        setcookie('date_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^[1-2][0|9|8][0-9][0-9]-[0-1][0-9]-[0-3][0-9]+$/', $_POST['date'])) {
            setcookie('date_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('date_value', $_POST['date'], time() + 31 * 24 * 60 * 60);
        }
    }
    if (empty($_POST['gender'])) {
        setcookie('gender_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^\d+$/', $_POST['gender'])) {
            setcookie('gender_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('gender_value', $_POST['gender'], time() + 31 * 24 * 60 * 60);
        }
    }
    if (empty($_POST['limb'])) {
        setcookie('limb_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^\d+$/', $_POST['limb'])) {
            setcookie('limb_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('limb_value', $_POST['limb'], time() + 31 * 24 * 60 * 60);
        }
    }
    if (empty($_POST['superpowers'])) {
        setcookie('superpowers_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^\d+$/', $_POST['superpowers'])) {
            setcookie('superpowers_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            $asup = $_POST['superpowers'];
            setcookie('superpowers_value', $_POST['superpowers'], time() + 31 * 24 * 60 * 60);
        }
    }

    setcookie('biography_value', $_POST['biography'], time() + 31 * 24 * 60 * 60);
    /*
    }
    */
    if (empty($_POST['signed'])) {
        setcookie('signed_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^\d+$/', $_POST['signed'])) {
            setcookie('signed_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('signed_value', $_POST['signed'], time() + 31 * 24 * 60 * 60);
        }
    }


    if ($errors) {
        header('Location: index.php');
        exit();
    } else {
        setcookie('name_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('date_error', '', 100000);
        setcookie('gender_error', '', 100000);
        setcookie('limb_error', '', 100000);
        setcookie('superpowers_error', '', 100000);
        setcookie('biography_error', '', 100000);
        setcookie('signed_error', '', 100000);
    }
     //*************************

    $user = 'u52863';
    $pass = '7320376';

try {
    $database = new PDO('mysql:host=localhost;dbname=u52863', $user, $pass, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die($e->getMessage());
}
        $statement = $database -> prepare("INSERT INTO Person (name, email, date, gender, limb, biography, signed) VALUES (:name, :email, :date, :gender, :limb, :biography, :signed)");
        $statement -> execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'date' => $_POST['date'], 'gender' => $_POST['gender'], 'limb' => $_POST['limb'], 'biography' => $_POST['biography'], 'signed' => $_POST['signed']]);
        $id_connection = $database -> lastInsertId();
        $statement = $database -> prepare("INSERT INTO Connection (id_person, id_abil) VALUES (:id_person, :id_abil)");
        foreach($_POST['superpowers'] as $superpowers){
            if($superpowers != false){
                $statement -> execute(['id_person' => $id_connection, 'id_abil' => $superpowers]);
            }
        }
    if ($database->connect_error){
    echo "Error Number: ".$database->connect_errno."<br>";
    echo "Error: ".$database->connect_error;
    }   
    

    //*************************

    setcookie('save', '1');
    header('Location: index.php');
}
