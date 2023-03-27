<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['save'])){
        echo'<script>alert("Результаты сохранены!");</script>';
    }
    include('Index.php');
    exit();
}

$errors = FALSE;
if(empty($_POST['name'])){
    print('Заполните поле имя.<br/>');
    $errors = TRUE;
}
if(empty($_POST['email'])){
    print('Заполните поле E-mail.<br/>');
    $errors = TRUE;
}
if(empty($_POST['date'])){
    print('Выберите дату рождения.<br/>');
    $errors = TRUE;
}
if(empty($_POST['gender'])){
    print('Выберите пол.<br/>');
    $errors = TRUE;
}
if(empty($_POST['limb'])){
    print('Выберите количество конечностей.<br/>');
    $errors = TRUE;
}
if(empty($_POST['superpowers'])){
    print('Выберите сверхспособности.<br/>');
    $errors = TRUE;
}
if(empty($_POST['biography'])){
    $_POST['biography']=" ";
}
if($errors){
    print('Попробуйте ещё раз.');
    exit();
}

$user = 'u52863';
$pass = '7320376';

try {
    //$db = new mysqli("localhost", "u52863", "7320376", "u52863");
    $database = new PDO('mysql:host=localhost;dbname=u52863', $user, $pass, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die($e->getMessage());
}

/*
$name = $_POST['username'];
$email = $_POST['email'];
$date = $_POST['date'];
$gender = $_POST['gender'];
$limb = $_POST['limb'];
$biography = $_POST['biography'];
$superpowers = $_POST['superpowers'];
$signed = $_POST['signed']
*/



//$db->query("SET NAMES 'utf8'");
//$db->query("INSERT INTO `Person` (`name`, `email`, `date`, `gender`, `limb`, `biography`, `signed`) VALUES ('$name', '$email', '$date', '$gender', '$limb', '$biography' , $signed)");
//$db->query("INSERT INTO `Connection` (`superpowers`) VALUES ('$superpowers')");
//$db->close();

$statement = $database -> prepare("INSERT INTO Person (name, email, date, gender, limb, biography, signed) VALUES (:name, :email, :date, :gender, :limb, :biography, :signed)");
        $statement -> execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'date' => $_POST['date'], 'gender' => $_POST['gender'], 'limb' => $_POST['limb'], 'biography' => $_POST['biography'], 'signed' => $_POST['signed']]);
        $id_connection = $database -> lastInsertId();
if ($database->connect_error){
    echo "Error Number: ".$database->connect_errno."<br>";
    echo "Error: ".$database->connect_error;
}

header('Location: ?save=1');
?>