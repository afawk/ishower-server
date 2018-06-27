<?php

require_once('bootstrap.php');

$statement = $pdo->prepare("SELECT temperature FROM profiles WHERE id = ? LIMIT 1");
$statement->execute([$profile]);

$fetch = $statement->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode(array_shift($fetch));
exit;