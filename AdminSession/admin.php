<?php
    header('Content-Type: text/html; charset=UTF-8');

    session_start();

    if (!empty($_SESSION['login']))
    {
        session_destroy();
        header('Location: ./');
    }

    $user = 'u52863';
    $password = '7320376';
    $database = new PDO('mysql:host=localhost;dbname=u52863', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        ?>

        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <form action = "" method = "POST">
                <div class = "signup-form" style = "width: 65%;">
                    <h1 style = "color: black;">Данные пользователей</h1>
                    <div name = "Database_text" class = "txtb sf_input" style = "width: 100%; height: 624px; overflow-y: auto;">
                    <?php
                        $result = $database -> query("SELECT * FROM Person");
                    ?>
                        <table>
                            <thead>
                                <tr class = "table">
                                    <th class = "table">id_person</th>
                                    <th class = "table">name</th>
                                    <th class = "table">email</th>
                                    <th class = "table">date</th>
                                    <th class = "table">gender</th>
                                    <th class = "table">limb</th>
                                    <th class = "table">biography</th>
                                    <th class = "table">signed</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = $result -> fetch())
                            {
                                echo "<tr class = 'table'>
                                <td class = 'table'><input value = ".$row['id_person']."></td>
                                <td class = 'table'><input value = ".$row['name']."></td>
                                <td class = 'table'><input value = ".$row['email']."></td>
                                <td class = 'table'><input value = ".$row['date']."></td>
                                <td class = 'table'><input value = ".$row['gender']."></td>
                                <td class = 'table'><input value = ".$row['limb']."></td>
                                <td class = 'table'><input value = ".$row['biography']."></td>
                                <td class = 'table'><input value = ".$row['signed']."></td>
                                <td class = 'table_error'><a style = 'color: red;' href = 'remover.php?id_person=".$row['id_person']."'>Удалить</a></td>
                                </tr>";
                            }
                            echo '</tr>';
                            echo '<p>Статистика пользователей по суперспособностям</p>';
                            echo '<p>↓ ↓ ↓</p>';
                            $result1 = $database -> query("SELECT * FROM Connection WHERE id_abil = 1");
                            $result2 = $database -> query("SELECT * FROM Connection WHERE id_abil = 2");
                            $result3 = $database -> query("SELECT * FROM Connection WHERE id_abil = 3");
                            $result4 = $database -> query("SELECT * FROM Connection");
                            $row1 = 0;
                            $row2 = 0;
                            $row3 = 0;
                            $row4 = 0;
                            while ($roww = $result1 -> fetch()) { if ($roww['id_abil'] == 1) $row1++; }
                            while ($roww = $result2 -> fetch()) { if ($roww['id_abil'] == 2) $row2++; }
                            while ($roww = $result3 -> fetch()) { if ($roww['id_abil'] == 3) $row3++; }
                            while ($roww = $result4 -> fetch()) { $row4++; }
                            echo '<p>Бессмертие - '.$row1.', Прохождение сквозь стены - '.$row2.', Левитация - '.$row3.', Всего пользователей с суперспособностями - '.$row4.'</p>';
                            echo '<p>Данные пользователей из таблицы Person</p>';
                            echo '<p>↓ ↓ ↓</p>';
                            ?>
                    </table>
                    <input name = "User_Record" type = "text" placeholder = "ID пользователя (число слева от имени)" class = "txtb sf_input">
                    <input type = "submit" value = "Редактировать" class = "signup-btn sf_input">
                    </div>
                </div>
            </form>
        </body>

        <?php
        if (!empty($_GET['none']))
        {
            $message = "Неверные данные!";
            print($message);
        }
    }

    else
    {
        $user_record = $_POST['User_Record'];
        $_SESSION['login'] = 'Admin';
        $_SESSION['uid'] = $user_record;
        header('Location: ./');
    }
?>