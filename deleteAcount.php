<?php
    session_start();

    require "database.php";

    if (isset($_SESSION['user_id'])) {
        
        $records = $conn->prepare("DELETE FROM users WHERE id = :id");
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    }

    require "logout.php";
?>