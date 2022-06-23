<?php

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'testeprojeto';

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    