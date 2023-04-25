<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.

header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Массив для временного хранения сообщений пользователю.
    $messages = array();
    $messages[8] = '';
    $messages[9] = '';
    if (!empty($_COOKIE['save'])) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('save', '', 100000);
        setcookie('login', '', 100000);
        setcookie('pass', '', 100000);
        // Если есть параметр save, то выводим сообщение пользователю.
        $messages[8] = '<div style="text-align: center; margin: 4px;">Спасибо, результаты сохранены.</div>';
        // Если в куках есть пароль, то выводим сообщение.
        if (!empty($_COOKIE['pass'])) {
            $messages[9] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
          и паролем <strong>%s</strong> для изменения данных.',
                strip_tags($_COOKIE['login']),
                strip_tags($_COOKIE['pass']));
        }
    }

    // Складываем признак ошибок в массив.
    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['date'] = !empty($_COOKIE['date_error']);
    $errors['gender'] = !empty($_COOKIE['gender_error']);
    $errors['limb'] = !empty($_COOKIE['limb_error']);
    $errors['date'] = !empty($_COOKIE['date_error']);

    $errors['superpowers'] = !empty($_COOKIE['superpowers_error']);
    $errors['signed'] = !empty($_COOKIE['signed_error']);

    // Выдаем сообщения об ошибках.
    if ($errors['name']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('name_error', '', 100000);
        // Выводим сообщение.
        $messages[0] = '<div class="error_text">Поле с именем не должно быть пустым.</div>';
    }
    if ($errors['email']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('email_error', '', 100000);
        // Выводим сообщение.
        $messages[1] = '<div class="error_text">Заполните почту в формате email@example.com.</div>';
    }
    if ($errors['date']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('date_error', '', 100000);
        // Выводим сообщение.
        $messages[2] = '<div class="error_text">Выберите дату.</div>';
    }
    if ($errors['gender']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('gender_error', '', 100000);
        // Выводим сообщение.
        $messages[3] = '<div class="error_text">Выберите свой гендер.</div>';
    }
    if ($errors['limb']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('limb_error', '', 100000);
        // Выводим сообщение.
        $messages[4] = '<div class="error_text">Выберите количество конечностей.</div>';
    }
    if ($errors['date']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('date_error', '', 100000);
        // Выводим сообщение.
        $messages[6] = '<div class="error_text">Поле с биографией не должно быть пустым.</div>';
    }
    if ($errors['superpowers']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('superpowers_error', '', 100000);
        // Выводим сообщение.
        $messages[5] = '<div class="error_text">Должна быть выбрана хотя бы одна способность.</div>';
    }
    if ($errors['signed']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('signed_error', '', 100000);
        // Выводим сообщение.
        $messages[7] = '<div class="error_text">Вы должны согласиться с условиями , прежде чем продолжить.</div>';
    }


    // Складываем предыдущие значения полей в массив, если есть.




    // Если нет предыдущих ошибок ввода, есть кука сессии, начали сессию и
    // ранее в сессию записан факт успешного логина.
    if (!empty($_COOKIE[session_name()]) &&
        session_start() && !empty($_SESSION['login'])) {
        // TODO: загрузить данные пользователя из БД
        // и заполнить переменную $values,
        // предварительно санитизовав.
        $user = 'u52863';
        $pass = '7320376';
        $db = new PDO('mysql:host=localhost;dbname=u52863', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
        $stmt = $db->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->execute([$_SESSION['uid']]);
        $row = $stmt ->fetch(PDO::FETCH_ASSOC);

        $values = array();
        $values['name'] = $row["name"];
        $values['email'] = $row["user_email"];
        $values['date'] = $row["user_date"];
        $values['gender'] = $row["user_gender"];
        $values['limb'] = $row["user_limb_count"];
        $values['date'] = $row["user_biography"];
        $stmt = $db->prepare("SELECT abil_id FROM link WHERE user_id = ?");
        $stmt->execute([$_SESSION['uid']]);
        $superpowers = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $messages[10] = 'Вход с логином %s, uid %d';
    }
    else {
        $values = array();
        $values['name'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
        $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
        $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
        $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
        $values['limb'] = empty($_COOKIE['limb_value']) ? '' : $_COOKIE['limb_value'];
        $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];

        $superpowers = array();
        $superpowers = empty($_COOKIE['supepowers_values']) ? array() : unserialize($_COOKIE['supepowers_values'], ["allowed_classes" => false]);
    }

    // Включаем содержимое файла form.php.
    // В нем будут доступны переменные $messages, $errors и $values для вывода
    // сообщений, полей с ранее заполненными данными и признаками ошибок.
    include('form.php');
}

// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
    // Проверяем ошибки.
    $errors = FALSE;
    if (empty($_POST['name'])) {
        // Выдаем куку на день с флажком об ошибке в поле name.
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        // Сохраняем ранее введенное в форму значение на месяц.
        setcookie('date_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
    }
    if (!preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/', $_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($_POST['date'])) {
        // Выдаем куку на день с флажком об ошибке в поле date.
        setcookie('date_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        // Сохраняем ранее введенное в форму значение на месяц.
        setcookie('date_value', $_POST['date'], time() + 30 * 24 * 60 * 60);
    }
    if (!isset($_POST['gender'])) {
        // Выдаем куку на день с флажком об ошибке в поле name.
        setcookie('gender_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        // Сохраняем ранее введенное в форму значение на месяц.
        setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
    }
    if (!isset($_POST['limb'])) {
        // Выдаем куку на день с флажком об ошибке в поле name.
        setcookie('limb_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        // Сохраняем ранее введенное в форму значение на месяц.
        setcookie('limb_value', $_POST['limb'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($_POST['date'])) {
        // Выдаем куку на день с флажком об ошибке в поле name.
        setcookie('date_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        // Сохраняем ранее введенное в форму значение на месяц.
        setcookie('date_value', $_POST['date'], time() + 30 * 24 * 60 * 60);
    }

    if (!isset($_POST['superpowers'])) {
        // Выдаем куку на день с флажком об ошибке в поле name.
        setcookie('superpowers_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {

        setcookie('supepowers_values', serialize($_POST['superpowers']), time() + 30 * 24 * 60 * 60);
    }
    if (!isset($_POST['signed'])) {
        setcookie('signed_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }

    // *************
    // Сохранить в Cookie признаки ошибок и значения полей.
    // *************




// *************
// Тут необходимо проверить правильность заполнения всех остальных полей.
// *************

    if ($errors) {
        // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
        header('Location: index.php');
        exit();
    }
    else {
        // Удаляем Cookies с признаками ошибок.
        setcookie('name_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('date_error', '', 100000);
        setcookie('gender_error', '', 100000);
        setcookie('limb_error', '', 100000);
        setcookie('superpowers_error', '', 100000);
        setcookie('date_error', '', 100000);
        setcookie('signed_error', '', 100000);
    }

// Сохранение в базу данных.
// Сохранение в XML-документ.

    $user = 'u52863';
    $pass = '7320376';
    $db = new PDO('mysql:host=localhost;dbname=u52863', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

    if (!empty($_COOKIE[session_name()]) &&
        session_start() && !empty($_SESSION['login'])) {
        // TODO: перезаписать данные в БД новыми данными,
        // кроме логина и пароля.

        $stmt = $db->prepare("UPDATE user SET name = ?, user_email = ?, user_date = ?, user_gender = ? , user_limb_count = ?, user_biography = ? WHERE user_id = ?");
        $stmt -> execute([$_POST['name'],$_POST['email'],$_POST['date'],$_POST['gender'],$_POST['limb'],$_POST['date'],$_SESSION['uid']]);
        $stmt2 = $db->prepare("INSERT INTO link SET user_id= ?, abil_id = ?");

        foreach ($_POST['superpowers'] as $s)
            $stmt2 -> execute([$_SESSION['uid'], $s]);
    }
    else {
        // Генерируем уникальный логин и пароль.
        // TODO: сделать механизм генерации, например функциями rand(), uniquid(), md5(), substr().
        $login = uniqid('',true);
        $pass = rand(10,100);
        // Сохраняем в Cookies.
        setcookie('login', $login);
        setcookie('pass', $pass);
        // TODO: Сохранение данных формы, логина и хеш md5() пароля в базу данных.
        // ...
        $stmt = $db->prepare("INSERT INTO user SET name = ?, user_email = ?, user_date = ?, user_gender = ? , user_limb_count = ?, user_biography = ?");
        $stmt -> execute([$_POST['name'],$_POST['email'],$_POST['date'],$_POST['gender'],$_POST['limb'],$_POST['date']]);
        $stmt2 = $db->prepare("INSERT INTO link SET user_id= ?, abil_id = ?");
        $user_id = $db->lastInsertId();
        foreach ($_POST['superpowers'] as $s)
            $stmt2 -> execute([$user_id, $s]);

        $stmt = $db->prepare("INSERT INTO login_data SET login_id = ?, pass = ?, user_id = ?");
        $stmt -> execute([$login,md5($pass),$user_id]);
    }

// Сохраняем куку с признаком успешного сохранения.
    setcookie('save', '1');

    header('Location: ?save=1');
}
