<?php

    $host = 'localhost';
    $user = 'root';
    $password = 'root1234@';
    $dbname = 'camagru';

    // Set DSN
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;

    // Create a PDO instance
    try {
         $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    catch (PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
    }
?>