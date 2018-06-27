<?php

exit;

require 'bootstrap.php';

try {
    $pdo->exec("DROP table profiles");
    $pdo->exec("DROP table customers");

    $pdo->exec("CREATE TABLE profiles (
        id SERIAL PRIMARY KEY,
        customer_id int,
        name varchar (200),
        temperature smallint
    )");

    $pdo->exec("CREATE TABLE customers (
        id SERIAL PRIMARY KEY,
        name varchar (200)
    )");

    $pdo->exec("INSERT INTO customers (name) VALUES ('Anacleto Campanela')");
    $pdo->exec("INSERT INTO customers (name) VALUES ('Erico Miranda')");
    $pdo->exec("INSERT INTO customers (name) VALUES ('Josivaldo Prieto')");
}
catch (PDOException $e) {
    echo $e->getMessage();
}