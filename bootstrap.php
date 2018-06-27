<?php

$client_id = $_POST['client_id'];
$secret_id = $_POST['secret_id'];

$profile = $_POST['profile'];

try {
    $pdo = new PDO('pgsql:dbname=ddjk8l068qhb2b;host=ec2-184-73-240-228.compute-1.amazonaws.com;port=5432', 'kexqphckcunebh', '7e6f04b2f11e260e837440caa554b3ab5fb494d1c29070b91460425c45b4cdef', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
}
catch (PDOException $e) {
    echo $e->getMessage();
}