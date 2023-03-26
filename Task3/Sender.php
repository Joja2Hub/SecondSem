<?php
    try
    {
        $user = 'u52863';
        $password = '7320376';
        $database = new PDO('mysql:host=localhost;dbname=u52863',
        $user,$password,[PDO::ATTR_PERSISTENT => true]);


        $statement = $database->prepare("INSERT INTO Person (name,email,date,gender,limb,biography,signed) VALUES (:name,:email,:date,:gender,:limb,:biography,:signed)");
        $statement -> execute(['name'=>$_POST['name'], 'email'=>$_POST['email'], 'date'=>$_POST['date'], 'gender'=>$_POST['gender'], 'limb'=>$_POST['limb'], 'biography'=>$_POST['biography'], 'signed'=>$_POST['signed']]);
        $send_id = $database->lastInsertId();
        $statement = $database->prepare("INSERT INTO Conection (superpowers,task_id) VALUES (:superpowers,:task_id)");
    }

    catch (PDOException $e){
        print('Error: ' .$e -> getMessage());
        exit();
    }

?>