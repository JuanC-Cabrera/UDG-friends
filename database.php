<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'UDG-friends';

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
    } catch (PDOException $e) {
        die('Connected fail: '.$e->getMessage());
    }
?>