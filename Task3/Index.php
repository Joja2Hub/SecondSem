<!DOCTYPE html>
<html lang="Ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Style.css">
    <title>DATABASE_Form</title>
</head>
<body>
<div class="main">
    <form class="formula" action="Sender.php" method="POST">
        <h2 id="forma" class="undershape">Форма</h2>
        <div class="form_item">
            <label class="form_label labe">
                Имя:<br>
                <input type="text" name="name">
            </label>
        </div>
        <div class="form_item">
            <label class="form_label labe">
                E-mail:<br>
                <input type="email" name="email">
            </label>
        </div>
        <div class="form_item">
            <label class="form_label labe">
                Дата рождения:<br>
                <input type="date" name="date">
            </label>
        </div>
        <div class="form_item">
            <br>Пол:
            <label class="form_label labe">
                <input type="radio" name="gender" value=Ж>
                женский
            </label>
            <label class="form_label labe">
                <input type="radio" name="gender" value=М>
                мужской
            </label>
        </div>
        <div class="form_item">
            <br>Количество конечностей:<br>
            <label class="form_label">
                <input type="radio" name="limb" value=0>
                0
            </label>
            <label class="form_label">
                <input type="radio" name="limb" value=1>
                1
            </label>
            <label class="form_label">
                <input type="radio" name="limb" value=2>
                2
            </label>
            <label class="form_label">
                <input type="radio" name="limb" value=3>
                3
            </label>
            <label class="form_label">
                <input type="radio" checked="checked" name="limb" value=4>
                4
            </label>
        </div>
        <div class="form_item">
            Сверхспособности:<br>
            <label class="form_label labe">
                <select name="superpowers" multiple="multiple">
                    <option value=0 selected="selected">Бессмертие</option>
                    <option value=1>Прохождение сквозь стены</option>
                    <option value=2>Левитация</option>
                </select>
            </label>
        </div>
        <div class="form_item">
            Биография: <br>
            <label class="form_label labe">
                <textarea name="biography" autofocus></textarea>
            </label>
        </div>
        <div class="form_item">
            <label>
                <input type="checkbox" name="signed" value = On> с контрактом ознакомлен (а) <br>
            </label>
        </div>
        <div class="form_item btn">
            <input class="form_button" type="submit" «Отправить»>
        </div>
    </form>
</div>
</body>
</html>