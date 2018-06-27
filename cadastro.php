<?php
require_once('bootstrap.php');

$validations = isset($_POST['send']);
$content = [];

if (isset($_POST['customer_id'])) {
    $statement = $pdo->prepare("INSERT INTO profiles (name, customer_id, temperature) VALUES (?, ?, ?)");

    $statement->execute([
        $_POST['name'],
        $_POST['customer_id'],
        $_POST['temperature']
    ]);

    header('Location: ./?page=listagem');
    exit;
}
else if (isset($_POST['profile_id'])) {
    $statement = $pdo->prepare("UPDATE profiles
        SET name = ?, temperature = ?
      WHERE customer_id = ?
      LIMIT 1");

    $statement->execute([
        $_POST['name'],
        $_POST['temperature'],
        $_POST['profile_id']
    ]);

    header('Location: ./?page=listagem');
    exit;
}
else if (isset($_GET['profile_id'])) {
    if (isset($_GET['act']) and $_GET['act'] == 'dl') {
        $statement = $pdo->prepare("DELETE FROM profiles WHERE id = ?");
        $statement->execute([$_GET['profile_id']]);

        header('Location: ./?page=listagem');
        exit;
    }

    $statement = $pdo->prepare("SELECT * FROM profiles WHERE id = ? LIMIT 1");
    $statement->execute([$_GET['profile_id']]);
    $content = $statement->fetchAll();
    $content = array_shift($content);
}

$fetch = $pdo->query("SELECT * FROM customers");

if ($validations):
?>
<?php
else:
?>
<div class="row">
<div class="col-sm">
    <h2>Perfis</h2>
    <form action="./cadastro.php" method="post">
      <div class="form-group">
        <label for="name_customer">Name</label>
        <?php if (isset($content['customer_name'])): ?>
            <input type="hidden" name="profile_id" value="<?=$content['customer_id']?>">
            <input class="form-control" type="text" value="<?=$content['customer_name'] ?? ''?>" readonly>
        <?php else: ?>
            <select class="custom-select" name="customer_id">
              <?php foreach ($fetch->fetchAll() as $item): ?>
              <option value="<?=$item['id']?>"><?=$item['name']?></option>
              <?php endforeach; ?>
            </select>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="name_profile">Profile</label>
        <input type="text" class="form-control" id="name_profile" name="name" value="<?=$content['name'] ?? ''?>">
      </div>
      <div class="form-group">
        <label for="name_temp">Temperature</label>
        <input type="text" class="form-control" id="name_temp" name="temperature" value="<?=$content['temperature'] ?? ''?>">
      </div>

      <button type="submit" name="send" class="btn btn-primary">Enviar</button>
    </form>
</div>
</div>
<?php
endif;
?>