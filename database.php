<?php
    $dsn = 'mysql:host=localhost;dbname=shoppingcart';
    $username = 'root';
    $password = 'password2996';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>