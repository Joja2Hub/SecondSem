<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Permanent+Marker">
    <title>Admin Session</title>
</head>
<body>
    <?php
    if (!empty($messages)) {
    print('<div id="messages">');
    foreach ($messages as $message) {
        print($message);
    }
    print('</div>');
    }
    ?>
    <div class = "signup-form">
        <form action = "" method = "POST">
            <h1>Форма</h1>
            <input name = "name" type = "text" placeholder = "Имя" <?php if ($errors['name']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?> value="<?php print $values['name']; ?>">
            <input name = "email" type = "text" placeholder = "Почта" <?php if ($errors['email']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?> value="<?php print $values['email']; ?>">
            <input name = "date" type = "date" <?php if ($errors['date']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?> value="<?php print $values['date']; ?>">
            <div <?php if ($errors['gender']) {print 'class = "txtb_error"';} else {print 'class = "txtb"';} ?>><label>Пол</br><input name = "gender" type = "radio" value = "Male" <?php if ($values['gender'] == 'Male') {print 'checked = "checked"';}?>>Мужской</label>
            <label><input name = "gender" type = "radio" value = "Female" <?php if ($values['gender'] == 'Female') {print 'checked = "checked"';}?>>Женский</label></div>
            <div <?php if ($errors['limb']) {print 'class = "txtb_error"';} else {print 'class = "txtb"';} ?>><label></br>Кол-во конечностей</br><input name = "limb" type = "radio" value = 3 <?php if ($values['limb'] == 3) {print 'checked = "checked"';}?>>3</label>
            <label><input name = "limb" type = "radio" value = 4 <?php if ($values['limb'] == 4) {print 'checked = "checked"';}?>>4</label>
            <label><input name = "limb" type = "radio" value = 5 <?php if ($values['limb'] == 5) {print 'checked = "checked"';}?>>5</label></div>
            <select name = "superpowers[]" multiple = "multiple" <?php if ($errors['superpowers']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?>>
                <option value = 1 <?php if (isset($_COOKIE["1"])) if ($_COOKIE["1"] == true) echo "selected" ?>>Бессмертие</option>
                <option value = 2 <?php if (isset($_COOKIE["2"])) if ($_COOKIE["2"] == true) echo "selected" ?>>Прохождение сквозь стены</option>
                <option value = 3 <?php if (isset($_COOKIE["3"])) if ($_COOKIE["3"] == true) echo "selected" ?>>Левитация</option>
            </select>
            <textarea name = "biography" placeholder = "Биография" <?php if ($errors['biography']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?>><?php print $values['biography']; ?></textarea>
            <div <?php if ($errors['signed']) {print 'class = "txtb_error"';} else {print 'class = "txtb"';} ?>><label><input name = "signed" value = "signed" type = "checkbox" <?php if ($values['signed'] == 'signed') {print 'checked="checked"';} ?>>С контрактом ознакомлен(а)</label></div>
            </br>
            <input type = "submit" value = "Отправить данные" class = "signup-btn sf_input">
        </form>
    </div>
    <a class = "txtb sf_input" style = "width: 10%; height: 2%; text-align: center; margin-left: 30px;" href = "login.php">Авторизоваться</a>
</body>
</html>