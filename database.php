<?php
    $server = 'bcar9qzfxonkw8aszeff-mysql.services.clever-cloud.com';
    $username = 'u9grny1symlpg6sj';
    $password = 'rOYcd0IyU5oiIehVS8qI';
    $database = 'bcar9qzfxonkw8aszeff';

    try{
        $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
    }catch(PDOException $e){
        die("conection failed: ".$e->getMessage());
    }

?> 