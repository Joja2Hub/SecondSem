<!DOCTYPE html>

<head>
    <!-- Настройка viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Подключение css файла -->
    <link rel="stylesheet" href="style.css">
    <!-- Название веб-страницы во вкладках -->
    <title>NB4</title>
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

<div class="main">
    <form class="formula" action="" method="POST">
        <h2 id="forma" class="undershape">Форма</h2>
        <div class="form_item <?php if ($errors['name']) {
            print 'error';
        } ?>">
            <label class="form_label labe">
                Имя:<br>
                <input type="text" name="name" value="<?php print $values['name']; ?>">
            </label>
        </div>
        <div class="form_item <?php if ($errors['email']) {
            print 'error';
        } ?>">
            <label class="form_label labe">
                E-mail:<br>
                <input type="email" name="email" value="<?php print $values['email']; ?>" <?php if ($errors['email']) {
                    print 'class="error"';
                } ?>>
            </label>
        </div>
        <div class="form_item <?php if ($errors['date']) {
            print 'error';
        } ?>">
            <label class="form_label labe">
                Дата рождения:<br>
                <input type="date" name="date" value="<?php print $values['date']; ?>" <?php if ($errors['date']) {
                    print 'class="error"';
                } ?>>
            </label>
        </div>
        <div class="form_item <?php if ($errors['gender']) {
            print 'error';
        } ?>">
            <br>Пол:
            <label class="form_label labe">
                <input type="radio" name="gender" value= М <?php if ($values['gender'] == 'М') {
                    print 'checked="checked"';
                } ?>>
                женский
            </label>
            <label class="form_label labe">
                <input type="radio" name="gender" value= Ж <?php if ($values['gender'] == 'Ж') {
                    print 'checked="checked"';
                } ?>>
                мужской
            </label>
        </div>
        <div class="form_item <?php if ($errors['limb']) {
            print 'error';
        } ?>">
            <br>Количество конечностей:<br>
            <label class="form_label">
                <input type="radio" name="limb" value=3 <?php if ($values['limb'] == 3) {
                    print 'checked="checked"';
                } ?>> 3
            </label>
            <label class="form_label">
            <input type="radio" name="limb" value=4 <?php if ($values['limb'] == 4 or empty($values['limb'])) {
                    print 'checked="checked"';
                } ?>> 4
            </label>
            <label class="form_label">
                <input type="radio" name="limb" value=5 <?php if ($values['limb'] == 5) {
                    print 'checked="checked"';
                } ?>> 5
            </label>
        </div>

        <div class="form_item <?php if ($errors['superpowers']) {
            print 'error';
        } ?>">
            Сверхспособности:<br>
            <label class="form_label labe">
                <select name="superpowers" multiple="multiple">
                    <option value=1 <?php if ($values['superpowers'] == 1) {
                        print 'selected="selected"';
                    } ?>>Бессмертие</option>
                    <option value=2 <?php if ($values['superpowers'] == 2) {
                        print 'selected="selected"';
                    } ?>>Прохождение сквозь стены</option>
                    <option value=3 <?php if ($values['superpowers'] == 3) {
                        print 'selected="selected"';
                    } ?>>Левитация</option>
                </select>
            </label>
        </div>
        <div class="form_item <?php if ($errors['biography']) {
            print ' error';
        } ?>">
            Биография: <br>
            <label class="form_label labe">
                <textarea name="biography" autofocus><?php print $values['biography']; ?></textarea>
            </label>
        </div>
        <div class="form_item <?php if ($errors['signed']) {
            print 'error';
        } ?>">
            <label>
                <input type="checkbox" name="signed" value=1 <?php if ($values['signed']) {
                    print 'checked="checked"';
                } ?>> с контрактом ознакомлен (а) <br>
            </label>
        </div>
        <div class="form_item btn">
            <input class="form_button" type="submit" «Отправить»>
        </div>
    </form>
</div>
</body>

</html>