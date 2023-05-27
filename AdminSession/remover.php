<?php
    $id_person = $_GET['id_person'];
    $user = 'u52863';
    $password = '7320376';
    $database = new PDO('mysql:host=localhost;dbname=u52863', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $result = $database -> exec("DELETE FROM Person WHERE id_person = '$id_person'");
    $result = $database -> exec("DELETE FROM Connection WHERE id_person = '$id_person'");
    header('Location: ./admin.php');
?>