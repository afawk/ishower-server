<?php
require_once('bootstrap.php');

$statement = $pdo->prepare("SELECT * FROM profiles");
$statement->execute();

$items = $statement->fetchAll();

?>

<table class="table">
    <thead>
        <th scope="col">#</th>
        <th scope="col">Nome do perfil</th>
        <th scope="col">Temperatura</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
            <td scope="row"><?=$item['id']?></td>
            <td><?=$item['name']?></td>
            <td><?=$item['temperature']?>ºC</td>
            <td><a href="./?page=cadastro&profile_id=<?=$item['id']?>">Editar</a></td>
            <td><a href="./?page=cadastro&profile_id=<?=$item['id']?>&act=dl">Excluir</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5"><a href="./?page=cadastro">Novo</a></td>
        </tr>
    </tfoot>
</table>