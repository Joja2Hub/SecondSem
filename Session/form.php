<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Задание 5</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */
        .error {
            border: 2px solid red;
        }
        .error_text {
            margin: 4px;
            text-decoration-line: underline;
            text-decoration-color: red;
        }
    </style>
</head>
<body>


<header>
    <p class="header-text">Session</p>
</header>
<main>
    <div>
        <form class="formula" action="form.php" method="POST">
            <label>
                Имя<br />
                <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>"/>
            </label><br />
            <?php if ($errors['name']) {print $messages[0];} ?>

            <label>
                E-mail:<br />
                <input name="email"
                    <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>"
                       type="email" />
            </label><br />
            <?php if ($errors['email']) {print $messages[1];} ?>

            <label>
                Дата рождения:<br />
                <input name="date"
                    <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>"
                       type="date" min="1900-01-01" max="2022-12-31">
            </label><br />
            <?php if ($errors['date']) {print $messages[2];} ?>
            Гендер:<br />
            <?php if ($errors['gender']) {print '<div class="error">';} ?>
            <label><input type="radio"
                          name="gender" value="Male" <?php if($values['gender']=='Male') print "checked";else print ""; ?> />
                мужской
            </label>
            <label><input type="radio"
                          name="gender" value="Female" <?php echo ($values['gender']=='Female') ?  "checked" : "" ;  ?> />
                женский
            </label>
            <label><input type="radio"
                          name="gender" value="Other" <?php echo ($values['gender']=='Other') ?  "checked" : "" ;  ?> />
                другое
            </label>
            <br />
            <?php if ($errors['gender']) {print '</div>';print $messages[3];} ?>


            Количество конечностей:<br />
            <?php if ($errors['limb']) {print '<div class="error">';} ?>
            <label><input type="radio"
                          name="limb" value="0" <?php echo ($values['limb']=='0') ?  "checked" : "" ;  ?>/>
                0
            </label>
            <label><input type="radio"
                          name="limb" value="1" <?php echo ($values['limb']=='1') ?  "checked" : "" ;  ?>/>
                1
            </label>
            <label><input type="radio"
                          name="limb" value="2" <?php echo ($values['limb']=='2') ?  "checked" : "" ;  ?>/>
                2
            </label>
            <label><input type="radio"
                          name="limb" value="3" <?php echo ($values['limb']=='3') ?  "checked" : "" ;  ?>/>
                3
            </label>
            <label><input type="radio"
                          name="limb" value="4" <?php echo ($values['limb']=='4') ?  "checked" : "" ;  ?>/>
                4
            </label>
            <label><input type="radio"
                          name="limb" value="5+" <?php echo ($values['limb']=='5+') ?  "checked" : "" ;  ?>/>
                5+
            </label>
            <br />
            <?php if ($errors['limb']) {print '</div>';print $messages[4];} ?>
            <?php echo (in_array("0",$superpowers)) ?  "selected" : ""  ; ?>
            <label>
                Сверхспособности:
                <br />
                <select name="superpowers[]"
                        multiple="multiple" <?php if ($errors['superpowers']) {print 'class="error"';} ?>>
                    <option value="0" <?php echo (in_array("0",$superpowers)) ?  "selected" : ""  ; ?>>Бессмертие</option>
                    <option value="1" <?php echo (in_array('1',$superpowers)) ?  "selected" : ""  ; ?>>Прохождение сквозь стены</option>
                    <option value="2" <?php echo (in_array('2',$superpowers)) ?  "selected" : ""  ; ?>>Левитация</option>
                </select>
            </label><br />
            <?php if ($errors['superpowers']) {print $messages[5];} ?>

            <label>
                Биография:<br />
                <textarea name="biography" <?php if ($errors['biography']) {print 'class="error"';} ?>><?php echo $values['biography'] ;  ?></textarea>
            </label><br/>
            <?php if ($errors['biography']) {print $messages[6];} ?>
            <br />
            <label><input type="checkbox"
                          name="signed" <?php if ($errors['signed']) {print 'class="error"';} ?>/>
                С контрактом ознакомлен
            </label><br />
            <?php if ($errors['signed']) {print $messages[7];} ?>

            <input id="submit" type="submit" value="ok" />
        </form>
    </div>

    <a href="login.php">logout/login</a>
</main>
<?php


if (!empty($messages)) {
    print $messages[8];
    print $messages[9];
    if(!empty($_SESSION['login']))
        printf($messages[10], $_SESSION['login'], $_SESSION['uid']);
}
?>
</body>

</html>