<?php
    try
    {
        //подключаемся к базе данных
        $user = 'u52863';
        $password = '7320376';
        $database = new PDO('mysql:host=localhost;dbname=u52863', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        if (empty($_POST['name']) || is_numeric($_POST['name']) || !preg_match('/^([А-ЯЁ]{1}[а-яё])|([A-Z]{1}[a-z])+$/u', $_POST['name'])) exit("Заполните поле Имя корректно.");
        if (empty($_POST['email']) || is_numeric($_POST['email']) || !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-])*@[a-z0-9-]+(\.[a-z0-9-])*(\.[a-z]{2,4})$/', $_POST['email'])) exit("Заполните поле Почта корректно.");
        if ($_POST['date'] == "2023-12-12") exit("Заполните поле Дата корректно.");
        if ($_POST['gender'] != "Male" && $_POST['gender'] != "Female") exit ("Выберите Пол.");
        if ($_POST['limb'] != 3 && $_POST['limb'] != 4 && $_POST['limb'] != 5) exit ("Выберите кол-во Конечностей.");
        $superpowers = (int) $_POST['superpowers'];
        if ($superpowers < 1 || $superpowers > 3)
        {
            $superpowersErr = "Выберите Суперспособность(и)!";
        }
        if ($superpowers == null) exit("Выберите Суперспособность(и)!");
        if (empty($_POST['biography']) || is_numeric($_POST['biography']) || !preg_match('/^[a-zA-Zа-яёА-ЯЁ0-9]/', $_POST['biography'])) exit("Заполните поле Биография корректо.");
        if ($_POST['signed'] == null) exit ("Нажмите кнопку Контракт!");

        $statement = $database -> prepare("INSERT INTO Person (name, email, date, gender, limb, biography, signed) VALUES (:name, :email, :date, :gender, :limb, :biography, :signed)");
        $statement -> execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'date' => $_POST['date'], 'gender' => $_POST['gender'], 'limb' => $_POST['limb'], 'biography' => $_POST['biography'], 'signed' => $_POST['signed']]);
        $id_connection = $database -> lastInsertId();
        $statement = $database -> prepare("INSERT INTO Connection (id_person, id_abil) VALUES (:id_person, :id_abil)");
        foreach($_POST['superpowers'] as $superpowers){
            if($superpowers != false){
                $statement -> execute(['id_person' => $id_connection, 'id_abil' => $superpowers]);
            }
        }
    }

    //проверяем наличие ошибок
    catch (PDOException $e)
    {
        print('Error: ' .$e -> getMessage());
        exit();
    }
?>